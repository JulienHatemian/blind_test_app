<?php
namespace Blindtest\Controllers;

use Blindtest\Repository\GenreRepository;
use Blindtest\Repository\TypeRepository;
use Blindtest\Repository\GamemodeRepository;
use Blindtest\Services\BlindtestService;

require_once("MainController.controller.php");
require_once(__DIR__ . '/../Models/GenreRepository.php');
require_once(__DIR__ . '/../Models/TypeRepository.php');
require_once(__DIR__ . '/../Models/GamemodeRepository.php');
require_once(__DIR__ . '/../Service/BlindtestService.php');

class BlindtestController
    extends MainController
{
    private GenreRepository $genreRepository;
    private TypeRepository $typeRepository;
    private GamemodeRepository $gamemodeRepository;
    private BlindtestService $blindtestservice;

    public function __construct()
    {
        $this->genreRepository = new GenreRepository();
        $this->typeRepository = new TypeRepository();
        $this->gamemodeRepository = new GamemodeRepository();
        $this->blindtestservice = new BlindtestService();
    }

    public function gameconfig(){

        $genre = $this->genreRepository->getActiveGenre();
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
        $blindtest = $this->blindtestservice->createBlindtest($_POST['genre'], $_POST['type'], $_POST['timer'], $_POST['rounds'], $_POST['gamemode']);

        $data_page = [
            "page_description" => "Blindtest.",
            "page_title" => "Blindtest",
            "views" => "views/blindtest.view.php",
            "template" => "views/partials/template.php",
            "page_css" => ['style.css', 'blindtest.css'],
            "page_javascript" => ['script.js', 'blindtest.js'],
            "blindtest" => $blindtest
        ];

        $this->generatePage($data_page);
    }
}