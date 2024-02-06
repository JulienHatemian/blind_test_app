<?php
namespace Blindtest\Services;

use Blindtest\Repository\MusicRepository;

require_once(__DIR__ . '/../Models/MusicRepository.php');

class BlindtestService
{
    private MusicRepository $musicrepository;

    public function __construct()
    {
        $this->musicrepository = new MusicRepository();
    }

    public function createBlindtest(array $genre, array $type, int $timer, int $round, int $gamemode) :void
    {
        if(empty($_SESSION)){
            $blindtest = $this->musicrepository->getBlindtestMusic($genre, $type, $round);

            $_SESSION['blindtest']['music'] = $blindtest;
            $_SESSION['blindtest']['music']['sample'] = NULL;
            $_SESSION['blindtest']['rounds']['config'] = count($blindtest);
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