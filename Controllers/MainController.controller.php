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

    //Propriété "page_css" : tableau permettant d'ajouter des fichiers CSS spécifiques
    //Propriété "page_javascript" : tableau permettant d'ajouter des fichiers JavaScript spécifiques
    public function homepage(){
        // Toolbox::ajouterMessageAlerte("test", Toolbox::COULEUR_VERTE);

        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "views" => "views/homepage.view.php",
            "template" => "views/partials/template.php",
            "page_css" => ['style.css'],
            "page_javascript" => ['script.js']
        ];
        $this->generatePage($data_page);
    }

    public function errorPage($msg){
        $data_page = [
            "page_description" => "Page permettant de gérer les erreurs",
            "page_title" => "Page d'erreur",
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