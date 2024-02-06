<?php

namespace Blindtest\Services;

require_once(__DIR__ . '/../Models/GenreRepository.php');
require_once(__DIR__ . '/../Models/TypeRepository.php');
require_once(__DIR__ . '/../Controllers/MainController.controller.php');

use Blindtest\Repository\GenreRepository;
use Blindtest\Repository\TypeRepository;
use Blindtest\Controllers\MainController;

class MusicService
{
    private GenreRepository $genrerepository;
    private TypeRepository $typerepository;
    private MainController $maincontroller;

    public function __construct()
    {
        $this->genrerepository = new GenreRepository();
        $this->typerepository = new TypeRepository();
        $this->maincontroller = new MainController();
    }

    public function getMusicFile($file, $idgenre, $idtype, $timer){
        $genre = $this->genrerepository->getGenreById($idgenre);
        $type = $this->typerepository->getTypeById($idtype);

        $audiofile = __DIR__ . "/../assets/mp3/" . $genre['filepath'] . '/' . $type['filepath'] . '/' . $file . '.mp3';
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $typemime = finfo_file($finfo, $audiofile);
        finfo_close($finfo);

        if(strpos($typemime, 'audio/') !== false){
            $totaltime = $this->getMP3Duration($audiofile);
            $starttime = 0;
            $endtime = $totaltime;
    
            if($_SESSION['blindtest']['timer']['config'] < $totaltime){
                $randomStartingPoint = rand($starttime, $endtime - $_SESSION['blindtest']['timer']['config']);
                $maxTime = min($_SESSION['blindtest']['timer']['config'], $totaltime - $randomStartingPoint);
            }else{
                $_SESSION['blindtest']['timer']['left'] = $totaltime;
                $randomStartingPoint = rand($starttime, $endtime);
                $maxTime = min($_SESSION['blindtest']['timer']['left'], $totaltime - $randomStartingPoint);
            }
            
            $result = [
                'file' => $audiofile,
                'official_link' => "/assets/mp3/" . $genre['filepath'] . '/' . $type['filepath'] . '/' . $file . '.mp3',
                'start' => $randomStartingPoint,
                'duration' => $maxTime,
                'mime' => $typemime
            ];

            return $result;
        }else{
            return false;
        }
    }

    public function getMP3Duration($audiofile){
        $ratio = 16000; //BytesPerSec
        $file_size = filesize($audiofile);
        $duration = ($file_size / $ratio);
        return round($duration - 5);
    }
}