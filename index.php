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
require_once 'Controllers/Security.class.php';
require_once 'Controllers/Toolbox.class.php';
require_once 'Controllers/Check.class.php';

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
            if(Security::blindtestOngoing() === true){
                session_destroy();
            }
            break;
        case "gameconfig": $blindtestController->gameconfig();
            if(Security::blindtestOngoing() === true){
                session_destroy();
            }
            break;
        case "blindtest":
            if(!isset($_POST['genre'], $_POST['type'], $_POST['gamemode'], $_POST['timer'], $_POST['rounds'])){
                Toolbox::addAlertMessage(
                    "Please, define valid value for your blindtest.",
                    Toolbox::RED_COLOR
                );
                header("Location: " . URL . 'gameconfig');
            }else{
                $genre = Security::secureArray($_POST['genre']);
                $type = Security::secureArray($_POST['type']);
                $gamemode = Security::secuteHTML($_POST['gamemode']);
                $rounds = Security::secuteHTML($_POST['rounds']);
                $timer = Security::secuteHTML($_POST['timer']);

                if($checkController->checkConfig($genre, $type, $gamemode, $rounds, $timer) === true){
                    $blindtestController->blindtest();
                }else{
                    header("Location: " . URL . 'gameconfig');
                }
            }
            if(Security::blindtestOngoing() === false){
                header("Location: " . URL . 'gameconfig');
            }
            break;
        default: throw new RuntimeException("The page doesn't exist.");
    }
}catch(Exception $e){
    $mainController->errorPage($e->getMessage());
}