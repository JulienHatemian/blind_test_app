<?php
use Blindtest\Controllers\MainController;
use Blindtest\Controllers\BlindtestController;
use Blindtest\Controllers\Toolbox;
use Blindtest\Controllers\Security;
use Blindtest\Controllers\Check;

session_start();

define('URL', str_replace('index.php', '', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . 
    '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ));

require_once 'Controllers/MainController.controller.php';
require_once 'Controllers/BlindtestController.controller.php';
require_once 'Controllers/Security.php';
require_once 'Controllers/Toolbox.class.php';
require_once 'Controllers/Check.php';

$mainController = new MainController();
$blindtestController = new BlindtestController();
$checkController = new Check();

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
        case "blindtest":
            if(!isset($_POST['genre'], $_POST['type'], $_POST['gamemode'], $_POST['timer'])){
                Toolbox::addAlertMessage(
                    "Please, define valid value for your blindtest.",
                    Toolbox::RED_COLOR
                );
                header("Location: " . URL . 'gameconfig');
            }elseif($checkController->checkConfig($_POST['genre'], $_POST['type'], $_POST['gamemode']) === true){
                $blindtestController->blindtest();
            }else{
                header("Location: " . URL . 'gameconfig');
            }
            break;
        default: throw new RuntimeException("The page doesn't exist.");
    }
}catch(Exception $e){
    $mainController->errorPage($e->getMessage());
}