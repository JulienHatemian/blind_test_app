<?php

namespace Blindtest\Services;

require_once(__DIR__ . '/../Models/GenreRepository.php');
require_once(__DIR__ . '/../Models/TypeRepository.php');
require_once(__DIR__ . '/../Models/MusicRepository.php');

use Blindtest\Repository\GenreRepository;
use Blindtest\Repository\TypeRepository;
use Blindtest\Repository\MusicRepository;

class BlindtestService
{
    private GenreRepository $genrerepository;
    private TypeRepository $typerepository;
    private MusicRepository $musicrepository;

    public function __construct()
    {
        $this->genrerepository = new GenreRepository();
        $this->typerepository = new TypeRepository();
        $this->musicrepository = new MusicRepository();
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

            $_SESSION['blindtest'] = $blindtest;
            $_SESSION['round'] = 1;
            $_SESSION['totalround'] = count($blindtest);
            $_SESSION['timer'] = $timer;
            $_SESSION['timeleft'] = $timer;
            $_SESSION['gamemode'] = $gamemode;
        } 
    }

    public function checkTimestampLeft(int $time)
    {
        $totaltime = $_SESSION['timer'];
        $timeleft = $_SESSION['timeleft'];
        
        if($totaltime - $timeleft > 0 && $timeleft - $time > 0){
            $_SESSION['timeleft'] = $time;
        }
    }
}