<?php
namespace Blindtest\Repository;

use Blindtest\Repository\MainRepository;
use PDO;

require_once(__DIR__ . '/../Models/MainRepository.php');

class MusicRepository
    extends MainRepository
{
    /**
     * Get all music
     * @return  array
     */
    public function getAllMusic():array
    {
        $req = "SELECT * FROM music";
        $pdo = $this->getDatabase()->prepare($req);
        $pdo->execute();
        $data = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $pdo->closeCursor();
        return $data;
    }

    /**
     * Get all the music for the blindtest, depending of the genre and type.
     * @param array $genres
     * @param array $types
     * @param int $round
     * @return  array
     */
    public function getBlindtestMusic(array $genres, array $types, int $round):array
    {
        $ingenre = '';
        $i = 0;
        foreach($genres as $genre){
            $key = ':idgenre' . $i++;
            $ingenre .= ($ingenre ? ',' : '') . $key;
            $ingenres[$key] = $genre;
        }

        unset($key);
        unset($i);

        $intype = '';
        $i = 0;
        foreach($types as $type){
            $key = ':idtype' . $i++;
            $intype .= ($intype ? ',' : '') . $key;
            $intypes[$key] = $type;
        }

        $req = "SELECT * FROM music LEFT JOIN serie ON music.idserie = serie.idserie WHERE idgenre IN ($ingenre) AND idtype IN ($intype) AND file IS NOT NULL ORDER BY RAND() LIMIT :round";
        $pdo = $this->getDatabase()->prepare($req);

        foreach($ingenres as $ingenre => $keygenre){
            $pdo->bindValue($ingenre, $keygenre, PDO::PARAM_INT);
        }

        foreach($intypes as $intype => $keytype){
            $pdo->bindValue($intype, $keytype, PDO::PARAM_INT);
        }

        $pdo->bindValue(':round', $round, PDO::PARAM_INT);
        $pdo->execute();
        $data = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $pdo->closeCursor();
        return $data;
    }
}