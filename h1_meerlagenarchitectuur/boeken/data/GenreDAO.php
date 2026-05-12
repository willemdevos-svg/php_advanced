<?php
//data/GenreDAO
declare(strict_types=1);
require_once("DBConfig.php");
require_once("entities/Genre.php");
class GenreDAO
{
    public function getAll(): array
    {
        $sql = "select id, genre from mvc_genres";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $genre = Genre::create((int)$rij["id"], $rij["genre"]);
            array_push($lijst, $genre);
        }
        $dbh = null;
        return $lijst;
    }
}
