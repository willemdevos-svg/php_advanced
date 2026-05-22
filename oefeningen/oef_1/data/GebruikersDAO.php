<?php
//data/GebruikersDAO.php
declare(strict_types=1);
require_once("data/DBConfig.php");
require_once("entities/Gebruiker.php");
class GebruikersDAO
{
    public function getUserByName(string $gebruikersnaam): ?Gebruiker
    {
        $sql = "select id, gebruikersnaam, wachtwoord from gebruikers where gebruikersnaam = :naam";
        $dbh = new PDO(
            DBConfig::$DB_CONNSTRING,
            DBConfig::$DB_USERNAME,
            DBConfig::$DB_PASSWORD
        );
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':naam' => $gebruikersnaam));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);

        $user = null;
        if ($rij) {
            $user = new Gebruiker((int)$rij["id"], $rij["gebruikersnaam"], $rij["wachtwoord"]);
        }
        $dbh = null;
        return $user;
    }
}
