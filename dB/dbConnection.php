<?php
namespace Blindtest\Database;

use Blindtest\database\dbConfig;
use Exception;
use PDO;
require_once 'dbConfig.php';

class dbConnection
    extends dbConfig
{
    public function getDatabase(){
        try{
            $db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dataBase . ';charset=utf8', $this->user, $this->password);
        }
        catch(Exception $e){
            die('Erreur: ' . $e->getMessage());
        }

        return $db;
    }
}