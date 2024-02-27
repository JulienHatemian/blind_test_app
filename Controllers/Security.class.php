<?php
namespace Blindtest\Controllers;

class Security
{
    /**
     * Secure the string
     * @param mixed $data
     * @return string
     */
    public static function secuteHTML(mixed $data):string
    {
        return htmlentities($data);
    }

    /**
     * Secure array
     * @param array $array
     * @return array
     */
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

    /**
     * Check if blindtest if ongoing. Return true if exist, false if not.
     * @return bool
     */
    public static function blindtestOngoing():bool
    {
        return (isset($_SESSION['blindtest'])) ? true : false;
    }
}