<?php
namespace Blindtest\Controllers;

class Security
{
    public static function secuteHTML($data):string
    {
        return htmlentities($data);
    }

    public static function secureArray(array $array):array
    {
        $result = array();
        foreach($array as $key => $data){
            $newkey = htmlentities($key);
            $newdata = htmlentities($data);
            (is_numeric($newdata) === true) ? $newdata = (int) $newdata : false;
            
            $result[$newkey] = $newdata;
        }
        return $result;
    }

    public static function blindtestOngoing():bool
    {
        return (isset($_SESSION['blindtest'])) ? true : false;
    }
}