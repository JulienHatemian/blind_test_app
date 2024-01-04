<?php
namespace Blindtest\Controllers;


class Check
{
    public function checkConfig(array $genre, array $type, int $gamemode)
    {
        if(empty($genre) || empty($type)){
            Toolbox::addAlertMessage(
                "Please, choose at least 1 genre & 1 type.",
                Toolbox::RED_COLOR
            );
        }elseif(array_search(false, array_map('is_numeric', $genre)) != false || array_search(false, array_map('is_numeric', $type)) != false){
            Toolbox::addAlertMessage(
                "Please, choose a valid genre and type.",
                Toolbox::RED_COLOR
            );
        }

        if(count($_SESSION['alert']) > 0){
            return false;
        }

        return true;
    }
}