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

    public function playMusic($file, $idgenre, $idtype, $timer){
        $genre = $this->genrerepository->getGenreById($idgenre);
        $type = $this->typerepository->getTypeById($idtype);

        $audiofile = glob(__DIR__ . "/../assets/mp3/" . $genre . '/' . $type . '/' . $file . '.mp3');
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $typemime = finfo_file($finfo, $audiofile);
        finfo_close($finfo);
    }

    public function createBlindtest(array $genre, array $type, int $timer, int $round, int $gamemode) :void
    {
        // session_destroy();
        // exit;
        if(!$_SESSION){
            // $blindtest = $this->musicrepository->getBlindtestMusic($genre, $type, $round);
            // var_dump($blindtest);
            // exit;
            // $_SESSION['blindtest'] = $blindtest;
            // $_SESSION['round'] = $round;
            // $_SESSION['timer'] = $timer;
            // $_SESSION['gamemode'] = $gamemode;
        } 
    }
}