<?php
include_once("exceptions.php");
class DBConfig {
	public static $DB_CONNSTRING = "mysql:host=localhost;dbname=cursusphp;charset=utf8";
	public static $DB_USER = "cursusgebruiker";
	public static $DB_PASSWORD = "cursuspwd";
}
class User
{
    private ?int $id;
    private ?string $email;
    private ?string $wachtwoord;
    public function __construct(
        ?int $cid = null,
        ?string $cemail = null,
        ?string $cwachtwoord = null
    ) {
        $this->id = $cid;
        $this->email = $cemail;
        $this->wachtwoord = $cwachtwoord;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getWachtwoord()
    {
        return $this->wachtwoord;
    }
    public function setEmail(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new OngeldigEmailadresException();
        }
        $this->email = $email;
    }
    public function setWachtwoord(string $wachtwoord, string $herhaalwachtwoord)
    {
        if ($wachtwoord !== $herhaalwachtwoord) {
            throw new WachtwoordenKomenNietOvereenException();
        }
        $this->wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
    }
    public function emailReedsInGebruik()
    {
        $dbh = new PDO(
            DBConfig::$DB_CONNSTRING,
            DBConfig::$DB_USER,
            DBConfig::$DB_PASSWORD
        );
        $stmt = $dbh->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindValue(":email", $this->email);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $dbh = null;
        return $rowCount;
    }
    public function register()
    {
        $rowCount = $this->emailReedsInGebruik();
        if ($rowCount > 0) {
            throw new GebruikerBestaatAlException();
        }
        $dbh = new PDO(
            DBConfig::$DB_CONNSTRING,
            DBConfig::$DB_USER,
            DBConfig::$DB_PASSWORD
        );
        $stmt = $dbh->prepare("INSERT INTO users (email, wachtwoord) VALUES (:email, :wachtwoord)");
        $stmt->bindValue(":email", $this->email);
        $stmt->bindValue(":wachtwoord", $this->wachtwoord);
        $stmt->execute();
        $laatsteNieuweId = $dbh->lastInsertId();
        $dbh = null;
        $this->id = $laatsteNieuweId;
        return $this;
    }
    public function login()
    {
        $rowCount = $this->emailReedsInGebruik();
        if ($rowCount == 0) {
            throw new GebruikerBestaatNietException();
        }
        $dbh = new PDO(
            DBConfig::$DB_CONNSTRING,
            DBConfig::$DB_USER,
            DBConfig::$DB_PASSWORD
        );

        $stmt = $dbh->prepare("SELECT id, wachtwoord FROM users WHERE email = :email");
        $stmt->bindValue(":email", $this->email);
        $stmt->execute();
        $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
        $isWachtwoordCorrect = password_verify(
            $this->wachtwoord,
            $resultSet["wachtwoord"]
        );
        if (!$isWachtwoordCorrect) {
            throw new WachtwoordIncorrectException();
        }
        $this->id = $resultSet["id"];
        $dbh = null;
        return $this;
    }
}
