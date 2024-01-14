<?php
    require_once __DIR__ . '/Service/BlindtestService.php';

    use Blindtest\Services\BlindtestService;

    $blindtestservice = new BlindtestService;
    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = json_decode(file_get_contents('php://input'), true);
        // print_r($data);
        // exit;
        switch($data){
            case 'start':
                // if($blindtestservice->checkTimestampLeft() > 0){
                    echo json_encode(['success' => true, 'result' => 'test', 'data' => $data]);
                // }
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
        // echo json_encode(['success' => true, 'result' => 'test', 'data' => $data]);
    }