<?php
use Blindtest\Database\dbConnection;

require_once(__DIR__ . '/../dB/dbConnection.php');

abstract class MainRepository
    extends dbConnection
{
    public function getData(){
        $req = "SELECT * FROM blindtest";
        $pdo = $this->getDatabase()->prepare($req);
        $pdo->execute();
        $data = $pdo->fetchAll(pdo::FETCH_ASSOC);
        $pdo->closeCursor();
        return $data;
    }
}