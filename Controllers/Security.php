<?php

namespace Blindtest\Controllers;

class Security
{
    public static function secuteHTML($data):string
    {
        return htmlentities($data);
    }
}