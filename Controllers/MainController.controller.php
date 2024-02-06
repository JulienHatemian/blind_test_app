<?php
namespace Blindtest\Controllers;

class MainController{
    public function __construct(){
    }

    protected function generatePage($data){
        extract($data);
        ob_start();
        require_once($views);
        $page_content = ob_get_clean();
        require_once($template);
    }

    //Propriety "page_css" : Array to add specific CSS files
    //Propriety "page_javascript" : Array to add specific JS files
    public function homepage(){
        // Toolbox::addAlertMessage("test", Toolbox::GREEN_COLOR);

        $data_page = [
            "page_description" => "Homepage's description",
            "page_title" => "Blindtest - Homepage",
            "views" => "views/homepage.view.php",
            "template" => "views/partials/template.php",
            "page_css" => ['style.css'],
            "page_javascript" => ['script.js']
        ];
        $this->generatePage($data_page);
    }

    public function errorPage($msg){
        $data_page = [
            "page_description" => "Error Page",
            "page_title" => "Error Page",
            "msg" => $msg,
            "views" => "views/error.view.php",
            "template" => "views/partials/template.php",
        ];
        $this->generatePage($data_page);
    }

    public function log($data)
    {
        ini_set('xdebug.var_display_max_depth', 10);
        ini_set('xdebug.var_display_max_children', 256);
        ini_set('xdebug.var_display_max_data', 1024);

        $file = __DIR__ . '/../log.php';
        ob_start();
        var_dump($data);
        $param = ob_get_clean();
        $cleanparam = strip_tags($param);
        $date = '[' . date('Y-m-d H:i:s') . ']: ';
        $dump = $date . $cleanparam . "\n";
        error_log($dump, 3, $file);
    }
}