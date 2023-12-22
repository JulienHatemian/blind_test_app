<?php

namespace Blindtest\Services;

require_once(__DIR__ . '/../Models/GenreRepository.php');
require_once(__DIR__ . '/../Models/TypeRepository.php');

use Blindtest\Repository\GenreRepository;
use Blindtest\Repository\TypeRepository;

class BlindtestService
{
    private GenreRepository $genrerepository;
    private TypeRepository $typerepository;

    public function __construct()
    {
        $this->genrerepository = new GenreRepository();
        $this->typerepository = new TypeRepository();
    }

    public function playMusic($file, $idgenre, $idtype, $timer){
        $genre = $this->genrerepository->getGenreById($idgenre);
        $type = $this->typerepository->getTypeById($idtype);

        $audiofile = glob(__DIR__ . "/../assets/mp3/" . $genre . '/' . $type . '/' . $file . '.mp3');
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $typemime = finfo_file($finfo, $audiofile);
        finfo_close($finfo);
    }
}