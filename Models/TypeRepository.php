<?php
namespace Blindtest\Repository;

use Blindtest\Repository\MainRepository;
use PDO;

require_once(__DIR__ . '/../Models/MainRepository.php');

class TypeRepository
    extends MainRepository
{
    /**
     * Array of all types.
     * @return array
     */
    public function getAllType():array
    {
        $req = "SELECT * FROM type";
        $pdo = $this->getDatabase()->prepare($req);
        $pdo->execute();
        $data = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $pdo->closeCursor();
        return $data;
    }

    /**
     * Array  of a specific type, given its id.
     * @param  int $id
     * @return array
     */
    public function getTypeById(int $id):array
    {
        $req = "SELECT * FROM type WHERE idtype = :idtype";
        $pdo = $this->getDatabase()->prepare($req);
        $pdo->bindValue(':idtype', $id, PDO::PARAM_INT);
        $pdo->execute();
        $data = $pdo->fetch(PDO::FETCH_ASSOC);
        $pdo->closeCursor();
        return $data;
    }
}