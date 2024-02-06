<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['blindtest']) === true){
    if($_SESSION['blindtest']['timer']['ongoing'] === true){
        //When play
        echo json_encode(['play' => true, 'previous' => true, 'next' => true, 'restart' => true, 'result' => true]);
    }elseif($_SESSION['blindtest']['rounds']['actual'] == 1){
        //When first round
        echo json_encode(['play' => false, 'previous' => true, 'next' => false, 'restart' => false, 'result' => false]);
    }elseif($_SESSION['blindtest']['rounds']['actual'] == $_SESSION['blindtest']['rounds']['config']){
        //When last round
        echo json_encode(['play' => false, 'previous' => false, 'next' => true, 'restart' => false, 'result' => false]);
    }else{
        echo json_encode(['play' => false, 'previous' => false, 'next' => false, 'restart' => false, 'result' => false]);
    }
}