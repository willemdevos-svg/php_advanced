<?php
//data/BoekDAO
declare(strict_types=1);
require_once("DBConfig.php");
require_once("entities/Genre.php");
require_once("entities/Boek.php");
class BoekDAO
{
    public function getAll(): array
    {
        $sql = "select mvc_boeken.id as boek_id, titel, genre_id, genre
        from mvc_boeken, mvc_genres
        where genre_id = mvc_genres.id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            $genre = Genre::create((int)$rij["genre_id"], $rij["genre"]);
            $boek = new Boek((int)$rij["boek_id"], $rij["titel"], $genre);
            array_push($lijst, $boek);
        }
        $dbh = null;
        return $lijst;
    }
    public function getByTitel(string $titel): ?Boek
    {
        $sql = "select mvc_boeken.id as boek_id, titel, genre_id, genre
        from mvc_boeken, mvc_genres
        where genre_id = mvc_genres.id and titel = :titel";
        $dbh = new PDO(
            DBConfig::$DB_CONNSTRING,
            DBConfig::$DB_USERNAME,
            DBConfig::$DB_PASSWORD
        );
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':titel' => $titel));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$rij) {
            return null;
        } else {
            $genre = Genre::create((int)$rij["genre_id"], $rij["genre"]);
            $boek = new Boek((int)$rij["boek_id"], $rij["titel"], $genre);
            $dbh = null;
            return $boek;
        }
    }
}
