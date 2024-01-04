<?php
namespace Blindtest\Controllers;

use Blindtest\Repository\GenreRepository;
use Blindtest\Repository\TypeRepository;
use Blindtest\Repository\GamemodeRepository;
use Blindtest\Controllers\Security;

require_once(__DIR__ . '/../Models/GenreRepository.php');
require_once(__DIR__ . '/../Models/TypeRepository.php');
require_once(__DIR__ . '/../Models/GamemodeRepository.php');
require_once(__DIR__ . '/../Controllers/Security.php');

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
    public function checkConfig(array $genres, array $types, int $gamemode, int $rounds, int $timer)
    {
        // var_dump($types);
        // var_dump(array_search(false, array_map('is_numeric', $types)));
        // var_dump($genres);
        // exit;
        if(empty($genres) || empty($types)){
            Toolbox::addAlertMessage(
                "Please, choose at least 1 genre & 1 type.",
                Toolbox::RED_COLOR
            );
        }else{
            if(array_search(false, array_map('is_numeric', $genres)) !== false || array_search(false, array_map('is_numeric', $types)) !== false){
                Toolbox::addAlertMessage(
                    "Please, choose a valid genre and type.",
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
        }

        // foreach()

        if(isset($_SESSION['alert'])){
            return false;
        }

        return true;
    }
}