<?php
    require_once __DIR__ . '/Service/BlindtestService.php';

    use Blindtest\Services\BlindtestService;

    $blindtestservice = new BlindtestService;
    session_start();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = json_decode(file_get_contents('php://input'), true);
        switch($data){
            case 'start':
                
                break;
            case 'pause':

                break;
            case 'next':
                break;
            case 'response':
                break;
            case 'restart':
                break;
            case 'quit':
                session_destroy();
                echo json_encode(['disconnected' => true]);
                break;
            default: throw new RuntimeException("No valid command.");
        }
        // echo json_encode(['success' => true, 'result' => 'test', 'data' => $data]);
    }