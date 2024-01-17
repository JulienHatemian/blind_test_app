<?php

namespace Blindtest\Services;

// require_once(__DIR__ . '/../Models/GenreRepository.php');
// require_once(__DIR__ . '/../Models/TypeRepository.php');
require_once(__DIR__ . '/../Models/MusicRepository.php');
// require_once(__DIR__ . '/../Controllers/MainController.controller.php');

// use Blindtest\Repository\GenreRepository;
// use Blindtest\Repository\TypeRepository;
use Blindtest\Repository\MusicRepository;
// use Blindtest\Controllers\MainController;

class BlindtestService
{
    // private GenreRepository $genrerepository;
    // private TypeRepository $typerepository;
    private MusicRepository $musicrepository;
    // private MainController $maincontroller;

    public function __construct()
    {
        // $this->genrerepository = new GenreRepository();
        // $this->typerepository = new TypeRepository();
        $this->musicrepository = new MusicRepository();
        // $this->maincontroller = new MainController();
    }

    public function createBlindtest(array $genre, array $type, int $timer, int $round, int $gamemode) :void
    {
        if(empty($_SESSION)){
            $blindtest = $this->musicrepository->getBlindtestMusic($genre, $type, $round);

            $_SESSION['blindtest']['music'] = $blindtest;
            $_SESSION['blindtest']['rounds']['total'] = count($blindtest);
            $_SESSION['blindtest']['rounds']['actual'] = 1;
            $_SESSION['blindtest']['timer']['config'] = $timer;
            $_SESSION['blindtest']['timer']['left'] = $timer;
            $_SESSION['blindtest']['timer']['ongoing'] = false;
            $_SESSION['blindtest']['gamemode'] = $gamemode;
        } 
    }

    public function checkTimestamp(int $time) :bool
    {
        $totaltime = $_SESSION['blindtest']['timer']['config'];
        $timeleft = $_SESSION['blindtest']['timer']['left'];

        return ($totaltime - $timeleft >= 0 && $timeleft - $time >= 0 && $timeleft <= $totaltime && $timeleft >= $time) ? true : false;
    }
}