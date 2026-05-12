<?php
//data/CursistenDAO.php
declare(strict_types=1);
require_once("data/DBConfig.php");
require_once("entities/Cursist.php");
class CursistenDAO
{
    public function getAll(): array
    {
        $lijst = array();
        $dbh = new PDO(
            DBConfig::$DB_CONNSTRING,
            DBConfig::$DB_USERNAME,
            DBConfig::$DB_PASSWORD
        );
        $sql = "select id, lastName, firstName from cursisten";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $cursist = new Cursist(
                (int)$rij["id"],
                $rij["lastName"],
                $rij["firstName"]
            );
            array_push($lijst, $cursist);
        }
        $dbh = null;
        return $lijst;
    }
}
