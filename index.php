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
        case "blindtest":
            if(empty($_POST['genre']) || empty($_POST['type'])){
                Toolbox::addAlertMessage(
                    "Please, choose at least 1 genre & 1 type.",
                    Toolbox::RED_COLOR
                );
            }
            elseif(array_search(false, array_map('is_numeric', $_POST['genre'])) != false || array_search(false, array_map('is_numeric', $_POST['type'])) != false){
                Toolbox::addAlertMessage(
                    "Please, choose a valid genre and type.",
                    Toolbox::RED_COLOR
                );
            }

            exit;
            // if(!empty($_POST['genre']) && !empty($_POST['type'])){
            //     $blindtestController->blindtest();
            // } else{
            //     Toolbox::addAlertMessage(
            //         "Please, choose at least 1 genre & 1 type.",
            //         Toolbox::RED_COLOR
            //     );
            //     header("Location: " . URL . 'gameconfig');
            // }
            break;
        default: throw new RuntimeException("The page doesn't exist.");
    }
}catch(Exception $e){
    $mainController->errorPage($e->getMessage());
}