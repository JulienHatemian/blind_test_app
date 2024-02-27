<?php
namespace Blindtest\Repository;

use Blindtest\Repository\MainRepository;
use PDO;

require_once(__DIR__ . '/../Models/MainRepository.php');

class GenreRepository
    extends MainRepository
{
    /**
     * Get all genre
     * @return array
     */
    public function getAllGenre():array
    {
        $req = "SELECT * FROM genre";
        $pdo = $this->getDatabase()->prepare($req);
        $pdo->execute();
        $data = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $pdo->closeCursor();
        return $data;
    }

    /**
     * Get  one genre by its id
     * @param int $id
     * @return array
     */
    public function getGenreById($id):array
    {
        $req = "SELECT * FROM genre WHERE idgenre = :idgenre";
        $pdo = $this->getDatabase()->prepare($req);
        $pdo->bindValue(':idgenre', $id, PDO::PARAM_INT);
        $pdo->execute();
        $data = $pdo->fetch(PDO::FETCH_ASSOC);
        $pdo->closeCursor();
        return $data;
    }
}