<?php
    require_once __DIR__ . '/Service/BlindtestService.php';
    require_once __DIR__ . '/Controllers/MainController.controller.php';

    use Blindtest\Services\BlindtestService;
    use Blindtest\Controllers\MainController;

    $blindtestservice = new BlindtestService;
    $maincontroller = new MainController;
    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = json_decode(file_get_contents('php://input'), true);
        $maincontroller->log($data);

        switch($data['dataParams']){
            case 'start':
                if($blindtestservice->checkTimestamp($data['timeleft']) === true && $_SESSION['blindtest']['timer']['left'] > 0){
                    if($data['timeleft'] === 0){
                        $_SESSION['blindtest']['timer']['left'] = (int) 0;
                        echo json_encode(['success' => false, 'showresult' => true, 'timeleft' => $_SESSION['blindtest']['timer']['left'], 'input' => $data['dataParams']]);
                    }else{
                        $_SESSION['blindtest']['timer']['left'] = $data['timeleft'];
                        echo json_encode(['success' => true, 'showresult' => false, 'timeleft' => $_SESSION['blindtest']['timer']['left'], 'input' => $data['dataParams']]);
                    }
                }else{
                    echo json_encode(['success' => false, 'showresult' => false, 'timeleft' => $_SESSION['blindtest']['timer']['left'], 'input' => $data['dataParams']]);
                }
                break;
            case 'pause':
                echo json_encode(['success' => true, 'result' => 'test', 'data' => $data]);
                break;
            case 'next':
                echo json_encode(['success' => true, 'result' => 'test', 'data' => $data]);
                break;
            case 'result':
                echo json_encode(['success' => true, 'result' => 'test', 'data' => $data]);
                break;
            case 'restart':
                echo json_encode(['success' => true, 'result' => 'test', 'data' => $data]);
                break;
            case 'quit':
                session_destroy();
                echo json_encode(['disconnected' => true]);
                break;
            default: throw new RuntimeException("No valid command.");
        }
    }