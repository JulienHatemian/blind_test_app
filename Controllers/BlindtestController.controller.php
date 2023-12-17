<?php
namespace Blindtest\Controllers;

use Blindtest\Repository\GenreRepository;

require_once("MainController.controller.php");
require_once(__DIR__ . '/../Models/GenreRepository.php');

class BlindtestController
    extends MainController
{
    private GenreRepository $genreRepository;
    public function __construct()
    {
        $this->genreRepository = new GenreRepository();
    }

    public function gameconfig(){

        $genre = $this->genreRepository->getAllGenre();

        $data_page = [
            "page_description" => "Blindtest's configuration.",
            "page_title" => "Blindtest - Configuration",
            "views" => "views/gameconfig.view.php",
            "template" => "views/partials/template.php",
            "page_css" => ['style.css', 'configuration.css'],
            "genres" => $genre
        ];

        $this->generatePage($data_page);
    }
}