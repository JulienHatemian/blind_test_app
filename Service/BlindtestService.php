<?php

namespace Blindtest\Services;

require_once(__DIR__ . '/../Models/GenreRepository.php');
require_once(__DIR__ . '/../Models/TypeRepository.php');
require_once(__DIR__ . '/../Models/MusicRepository.php');
require_once(__DIR__ . '/../Controllers/MainController.controller.php');

use Blindtest\Repository\GenreRepository;
use Blindtest\Repository\TypeRepository;
use Blindtest\Repository\MusicRepository;
use Blindtest\Controllers\MainController;

class BlindtestService
{
    private GenreRepository $genrerepository;
    private TypeRepository $typerepository;
    private MusicRepository $musicrepository;
    private MainController $maincontroller;

    public function __construct()
    {
        $this->genrerepository = new GenreRepository();
        $this->typerepository = new TypeRepository();
        $this->musicrepository = new MusicRepository();
        $this->maincontroller = new MainController();
    }

    public function getMusicFile($file, $idgenre, $idtype, $timer){
        $genre = $this->genrerepository->getGenreById($idgenre);
        $type = $this->typerepository->getTypeById($idtype);

        $audiofile = glob(__DIR__ . "/../assets/mp3/" . $genre . '/' . $type . '/' . $file . '.mp3');
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $typemime = finfo_file($finfo, $audiofile);
        finfo_close($finfo);
    }

    public function createBlindtest(array $genre, array $type, int $timer, int $round, int $gamemode) :void
    {
        if(empty($_SESSION)){
            $blindtest = $this->musicrepository->getBlindtestMusic($genre, $type, $round);

            $_SESSION['blindtest']['music'] = $blindtest;
            $_SESSION['blindtest']['rounds']['total'] = count($blindtest);
            $_SESSION['blindtest']['rounds']['actual'] = 1;
            $_SESSION['blindtest']['timer']['config'] = $timer;
            // $_SESSION['blindtest']['timer']['previous'] = $timer;
            $_SESSION['blindtest']['timer']['left'] = $timer;
            $_SESSION['blindtest']['gamemode'] = $gamemode;
        } 
    }

    public function checkTimestamp(int $time) :bool
    {
        $totaltime = $_SESSION['blindtest']['timer']['config'];
        $timeleft = $_SESSION['blindtest']['timer']['left'];

        $bool = ($totaltime - $timeleft >= 0 && $timeleft - $time >= 0 && $timeleft <= $totaltime && $timeleft >= $time) ? true : false;
        $this->maincontroller->log($bool);
        return $bool;
    }
}