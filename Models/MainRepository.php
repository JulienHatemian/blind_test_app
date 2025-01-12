<?php
namespace Blindtest\Repository;

use Blindtest\Database\dbConnection;
use PDO;

require_once(__DIR__ . '/../dB/dbConnection.php');

class MainRepository
    extends dbConnection
{
    /**
     * Get all the data from music
     * @return  array
     */
    public function getData():array
    {
        $req = "SELECT * FROM music";
        $pdo = $this->getDatabase()->prepare($req);
        $pdo->execute();
        $data = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $pdo->closeCursor();
        return $data;
    }
}