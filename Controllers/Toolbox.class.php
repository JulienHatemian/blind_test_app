<?php

namespace Blindtest\Controllers;
class Toolbox
{
    public const RED_COLOR = "alert-danger";
    public const ORANGE_COLOR = "alert-warning";
    public const GREEN_COLOR = "alert-success";
    
    public static function addAlertMessage($message, $type){
        $_SESSION['alert'][] = [
            "message" => $message,
            "type" => $type
        ];
    }
}