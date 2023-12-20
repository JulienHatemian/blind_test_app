<?php
namespace Blindtest\Repository;

use Blindtest\Repository\MainRepository;
use PDO;

require_once(__DIR__ . '/../Models/MainRepository.php');
class MusicRepository
    extends MainRepository
{
    public function getAllMusic(){
        $req = "SELECT * FROM music";
        $pdo = $this->getDatabase()->prepare($req);
        $pdo->execute();
        $data = $pdo->fetchAll(PDO::FETCH_ASSOC);
        $pdo->closeCursor();
        return $data;
    }

    public function createBlindtest(array $genre, array $type, int $timer, int $round, int $gamemode) :array
    {
        $blindtest = array();

        $this->getBlindtestMusic($genre, $type, $round);

        return $blindtest;
    }

    public function getBlindtestMusic(array $genres, array $types, int $round) :array
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

        $req = "SELECT * FROM music WHERE idgenre IN ($ingenre) AND idtype IN ($intype) ORDER BY RAND() LIMIT :random";
        $pdo = $this->getDatabase()->prepare($req);

        foreach($ingenres as $ingenre => $keygenre){
            $pdo->bindValue($ingenre, $keygenre, PDO::PARAM_INT);
        }

        foreach($intypes as $intype => $keytype){
            $pdo->bindValue($intype, $keytype, PDO::PARAM_INT);
        }

        $pdo->bindValue(':random', $round, PDO::PARAM_INT);
        $pdo->execute();
        return $pdo->fetchAll(PDO::FETCH_ASSOC);
    }
}