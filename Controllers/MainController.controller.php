<?php
namespace Blindtest\Controllers;

use Blindtest\Repository\MainRepository;

require_once(__DIR__ . '/../Models/MainRepository.php');

class MainController{
    private MainRepository $mainRepository;

    public function __construct(){
        $this->mainRepository = new MainRepository();
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
        $test = $this->mainRepository->getData();

        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "views" => "views/homepage.php",
            "template" => "views/partials/template.php",
            "page_css" => ['style.css'],
            "page_javascript" => ['script.js'],
            "data" => $test
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
}