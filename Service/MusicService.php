<?php
namespace Blindtest\Services;

use Blindtest\Repository\GenreRepository;
use Blindtest\Repository\TypeRepository;

require_once(__DIR__ . '/../Models/GenreRepository.php');
require_once(__DIR__ . '/../Models/TypeRepository.php');

class MusicService
{
    private GenreRepository $genrerepository;
    private TypeRepository $typerepository;

    public function __construct()
    {
        $this->genrerepository = new GenreRepository();
        $this->typerepository = new TypeRepository();
    }

    /**
     * Get the MP3 file for the blindtest
     * @param string $file
     * @param integer $idgenre
     * @param integer $idtype
     * @return array|bool
     */
    public function getMusicFile(string $file, int $idgenre, int $idtype) :array|bool{
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

    /**
     * Get approximately duration of the MP3 file depending of the bitrate
     * @param string $audiofile
     * @return int
     */
    public function getMP3Duration($audiofile){
        $ratio = 16000;
        $file_size = filesize($audiofile);
        $duration = ($file_size / $ratio);
        return round($duration - 5);
    }
}