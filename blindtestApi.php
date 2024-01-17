<?php
    require_once __DIR__ . '/Service/BlindtestService.php';
    require_once __DIR__ . '/Service/MusicService.php';
    require_once __DIR__ . '/Controllers/Security.class.php';
    require_once __DIR__ . '/Controllers/MainController.controller.php';

    use Blindtest\Services\BlindtestService;
    use Blindtest\Services\MusicService;
    use Blindtest\Controllers\Security;
    use Blindtest\Controllers\MainController;

    $blindtestservice = new BlindtestService();
    $musicservice = new MusicService();
    $security = new Security();
    $maincontroller = new MainController();
    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['blindtest']) === true){
        $data = json_decode(file_get_contents('php://input'), true);
        $data = Security::secureArray($data);

        switch($data['dataParams']){
            case 'start':
                if($_SESSION['blindtest']['rounds']['actual'] === 1){
                    $musicstart = $_SESSION['blindtest']['music'][0];
                    $file = $musicstart['file'];
                    $genre = $musicstart['idgenre'];
                    $type = $musicstart['idtype'];
                    $timer = $_SESSION['blindtest']['timer']['config'];

                    $result = $musicservice->getMusicFile($file, $genre, $type, $timer);
                    echo json_encode(['success' => true, 'showresult' => false, 'timeleft' => $_SESSION['blindtest']['timer']['config'], 'input' => $data['dataParams'], 'data' => $_SESSION['blindtest']['music'][0], 'audio' => $result]);
                }else{
                    echo json_encode(['success' => false, 'showresult' => false, 'timeleft' => NULL, 'input' => $data['dataParams'], 'data' => NULL]);
                }
                break;
            case 'play':
                if($_SESSION['blindtest']['timer']['ongoing'] === false && is_int($data['timeleft'])){
                    if($_SESSION['blindtest']['timer']['left'] != $data['timeleft']){
                        $data['timeleft'] = $_SESSION['blindtest']['timer']['left'];
                    }
                    if($blindtestservice->checkTimestamp($data['timeleft']) === true){
                        if($data['timeleft'] === 0){
                            $_SESSION['blindtest']['timer']['left'] = $_SESSION['blindtest']['timer']['config'];
                            $_SESSION['blindtest']['timer']['ongoing'] = true;
                            echo json_encode(['success' => true, 'showresult' => false, 'timeleft' => $_SESSION['blindtest']['timer']['left'], 'input' => $data['dataParams'], 'data' => NULL]);
                        }else{
                            $_SESSION['blindtest']['timer']['left'] = $data['timeleft'];
                            $_SESSION['blindtest']['timer']['ongoing'] = true;
                            echo json_encode(['success' => true, 'showresult' => false, 'timeleft' => $_SESSION['blindtest']['timer']['left'], 'input' => $data['dataParams'], 'data' => NULL]);
                        }
                    }else{
                        echo json_encode(['success' => false, 'showresult' => false, 'timeleft' => $_SESSION['blindtest']['timer']['left'], 'input' => $data['dataParams'], 'data' => NULL]);
                    }
                }else{
                    echo json_encode(['success' => false, 'showresult' => false, 'timeleft' => $_SESSION['blindtest']['timer']['left'], 'input' => $data['dataParams'], 'data' => NULL]);
                }
                break;
            case 'pause':
                if($_SESSION['blindtest']['timer']['ongoing'] === true && is_int($data['timeleft']) === true){
                    if($blindtestservice->checkTimestamp($data['timeleft']) === true && $data['timeleft'] > 0){
                        $_SESSION['blindtest']['timer']['left'] = $data['timeleft'];
                        $_SESSION['blindtest']['timer']['ongoing'] = false;
                        echo json_encode(['success' => true, 'showresult' => false, 'timeleft' => $_SESSION['blindtest']['timer']['left'], 'input' => $data['dataParams'], 'data' => NULL]);
                    }else{
                        echo json_encode(['success' => false, 'showresult' => false, 'timeleft' => $_SESSION['blindtest']['timer']['left'], 'input' => $data['dataParams'], 'data' => NULL]);
                    }
                }else{
                    echo json_encode(['success' => false, 'showresult' => false, 'timeleft' => $_SESSION['blindtest']['timer']['left'], 'input' => $data['dataParams'], 'data' => NULL]);
                }
                break;
            case 'restart':
                $_SESSION['blindtest']['timer']['left'] = $_SESSION['blindtest']['timer']['config'];
                $_SESSION['blindtest']['timer']['ongoing'] = false;
                echo json_encode(['success' => true, 'showresult' => false, 'timeleft' => $_SESSION['blindtest']['timer']['config'], 'input' => $data['dataParams'], 'data' => NULL]);
                break;
            case 'next':
                echo json_encode(['success' => true, 'result' => 'test', 'data' => $data]);
                break;
            case 'result':
                echo json_encode(['success' => true, 'showresult' => true, 'timeleft' => $_SESSION['blindtest']['timer']['left'], 'input' => $data['dataParams'], 'data' => NULL]);
                break;
            case 'endtimer':
                if($data['timeleft'] == 0){
                    $_SESSION['blindtest']['timer']['left'] = $data['timeleft'];
                    $_SESSION['blindtest']['timer']['ongoing'] = false;
                    echo json_encode(['success' => true, 'showresult' => false, 'timeleft' => $_SESSION['blindtest']['timer']['left'], 'input' => $data['dataParams'], 'data' => NULL]);
                }
                break;
            case 'quit':
                session_destroy();
                echo json_encode(['disconnected' => true]);
                break;
            default: throw new RuntimeException("No valid command.");
        }
    }