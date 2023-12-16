<?php
namespace Blindtest\Controllers;

require_once("MainController.controller.php");

class BlindtestController
    extends MainController
{
    public function __construct()
    {
    }

    public function blindtestConfig(){
        $data_page = [
            "page_description" => "Blindtest's configuration.",
            "page_title" => "Blindtest - Configuration",
            "views" => "views/configration.views.php",
            "template" => "views/partials/template.php",
            "page_css" => ['style.css', 'configuration.css']
        ];

        $this->generatePage($data_page);
    }

    public function classic(){

    }
}