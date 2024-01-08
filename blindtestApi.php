<?php
    require_once __DIR__ . '/Service/BlindtestService.php';

    use Blindtest\Services\BlindtestService;

    $blindtestservice = new BlindtestService;

    var_dump($data);
    exit;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $data = json_decode(file_get_contents('php://input'), true);
        var_dump($data);
        // echo json_encode(['success' => true, 'result' => 'test', 'data' => $data]);
    }