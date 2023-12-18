<?php
use Blindtest\Controllers\MainController;
use Blindtest\Controllers\BlindtestController;
use Blindtest\Controllers\Toolbox;
use Blindtest\Controllers\Security;

session_start();

define('URL', str_replace('index.php', '', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . 
    '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ));

require_once 'Controllers/MainController.controller.php';
require_once 'Controllers/BlindtestController.controller.php';
require_once 'Controllers/Security.php';
require_once 'Controllers/Toolbox.class.php';

$mainController = new MainController();
$blindtestController = new BlindtestController();

try{
    if(empty($_GET['page'])){
        $page = 'homepage';
    }else{
        $url = explode('/', filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    switch($page){
        case "homepage": $mainController->homepage();
            break;
        case "gameconfig": $blindtestController->gameconfig();
            break;
        case "blindtest": $blindtestController->blindtest();
            break;
        default: throw new RuntimeException("La page n'existe pas");
    }
}catch(Exception $e){
    $mainController->errorPage($e->getMessage());
}