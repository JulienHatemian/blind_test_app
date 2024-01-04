<?php

namespace Blindtest\Controllers;

class Security
{
    public static function secuteHTML($data):string
    {
        return htmlentities($data);
    }

    public static function secureArray($array):array
    {
        $result = array();
        foreach($array as $data){
            $result[] = htmlentities($data);
        }
        return $result;
    }
}