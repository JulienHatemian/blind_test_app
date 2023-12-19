<?php
namespace Blindtest\Controllers;

use Blindtest\Repository\GenreRepository;
use Blindtest\Repository\TypeRepository;
use Blindtest\Repository\GamemodeRepository;

require_once("MainController.controller.php");
require_once(__DIR__ . '/../Models/GenreRepository.php');
require_once(__DIR__ . '/../Models/TypeRepository.php');
require_once(__DIR__ . '/../Models/GamemodeRepository.php');

class BlindtestController
    extends MainController
{
    private GenreRepository $genreRepository;
    private TypeRepository $typeRepository;
    private GamemodeRepository $gamemodeRepository;

    public function __construct()
    {
        $this->genreRepository = new GenreRepository();
        $this->typeRepository = new TypeRepository();
        $this->gamemodeRepository = new GamemodeRepository();
    }

    public function gameconfig(){

        $genre = $this->genreRepository->getAllGenre();
        $type = $this->typeRepository->getAllType();
        $gamemode = $this->gamemodeRepository->getAllGamemode();

        $data_page = [
            "page_description" => "Blindtest's configuration.",
            "page_title" => "Blindtest - Configuration",
            "views" => "views/gameconfig.view.php",
            "template" => "views/partials/template.php",
            "page_css" => ['style.css', 'configuration.css'],
            "genres" => $genre,
            "types" => $type,
            "gamemodes" => $gamemode
        ];

        $this->generatePage($data_page);
    }

    public function blindtest()
    {
        $post = $_POST;
        $data_page = [
            "page_description" => "Blindtest.",
            "page_title" => "Blindtest - Configuration",
            "views" => "views/blindtest.view.php",
            "template" => "views/partials/template.php",
            "page_css" => ['style.css', 'blindtest.css'],
            // "blindtest_data" => $blindtest
            "blindtest_data" => $post
        ];

        $this->generatePage($data_page);
    }
}