<?php
use Blindtest\Controllers\MainController;
use Blindtest\Controllers\Toolbox;
use Blindtest\Controllers\Security;

session_start();

define('URL', str_replace('index.php', '', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . 
    '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ));

require_once 'Controllers/MainController.controller.php';
require_once 'Controllers/Security.php';
require_once 'Controllers/Toolbox.class.php';

$mainController = new MainController();

try{
    if(empty($_GET['page'])){
        $page = 'home';
    }else{
        $url = explode('/', filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }
}catch(Exception $e){
    $mainController->errorPage($e->getMessage());
}