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
        switch($data){
            case 'start':
                if($blindtestservice->checkTimestampLeft(12) > 0){
                    
                }
                echo json_encode(['success' => true, 'result' => 'test', 'data' => $data]);
                break;
            case 'pause':
                echo json_encode(['success' => true, 'result' => 'test', 'data' => $data]);
                break;
            case 'next':
                echo json_encode(['success' => true, 'result' => 'test', 'data' => $data]);
                break;
            case 'response':
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