<?php
namespace Blindtest\Controllers;

use Blindtest\Repository\GenreRepository;
use Blindtest\Repository\TypeRepository;
use Blindtest\Repository\GamemodeRepository;

require_once(__DIR__ . '/../Models/GenreRepository.php');
require_once(__DIR__ . '/../Models/TypeRepository.php');
require_once(__DIR__ . '/../Models/GamemodeRepository.php');

class Check
{
    private GenreRepository $genrerepository;
    private TypeRepository $typerepository;
    private GamemodeRepository $gamemoderepository;

    public function __construct()
    {
        $this->genrerepository = new GenreRepository();
        $this->typerepository = new TypeRepository();
        $this->gamemoderepository = new GamemodeRepository();
    }

    public function checkConfig(array $genres, array $types, int $gamemode, int $rounds, int $timer):bool
    {
        if(empty($genres) || empty($types) || empty($gamemode) || empty($rounds) || empty($timer)){
            Toolbox::addAlertMessage(
                "Complete the data needed.",
                Toolbox::RED_COLOR
            );
        }else{
            if(array_search(false, array_map('is_numeric', $genres)) !== false || array_search(false, array_map('is_numeric', $types)) !== false){
                Toolbox::addAlertMessage(
                    "Choose a valid genre and type.",
                    Toolbox::RED_COLOR
                );
            }

            foreach($genres as $genre){
                if(count($this->genrerepository->getGenreById($genre)) == 0){
                    Toolbox::addAlertMessage(
                        "One or more genre do not exist.",
                        Toolbox::RED_COLOR
                    );
                    break;
                }
            }

            foreach($types as $type){
                if(count($this->typerepository->getTypeById($type)) == 0){
                    Toolbox::addAlertMessage(
                        "One or more type do not exist.",
                        Toolbox::RED_COLOR
                    );
                    break;
                }
            }

            if(count($this->gamemoderepository->getGamemodeById($gamemode)) == 0){
                    Toolbox::addAlertMessage(
                        "That gamemode doesn't exist.",
                        Toolbox::RED_COLOR
                    );
            }

            if(!is_int($rounds) || !is_int($timer)){
                Toolbox::addAlertMessage(
                    "Choose an integer for the timer and round.",
                    Toolbox::RED_COLOR
                );
            }
            
            if(($rounds < 1 || $rounds > 30) || ($timer < 1 || $timer > 30)){
                Toolbox::addAlertMessage(
                    "Round and timer value must be between 1 et 30.",
                    Toolbox::RED_COLOR
                );
            }
        }

        if(isset($_SESSION['alert'])){
            return false;
        }

        return true;
    }
}