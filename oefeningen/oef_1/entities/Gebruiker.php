<?php
//entities/Gebruiker.php

declare(strict_types=1);

class Gebruiker {
    
    private int $id;
    private string $gebruikersnaam;
    private string $wachtwoord;

    public function __construct(int $id, string $gebruikersnaam, string $wachtwoord) {
        $this->id = $id;
        $this->gebruikersnaam = $gebruikersnaam;
        $this->wachtwoord = $wachtwoord;
    }

    function getId(): int {
        return $this->id;
    }

    function getGebruikersnaam(): string {
        return $this->gebruikersnaam;
    }

    function getWachtwoord(): string {
        return $this->wachtwoord;
    }

    function setGebruikersnaam(string $gebruikersnaam) {
        $this->gebruikersnaam = $gebruikersnaam;
    }

    function setWachtwoord(string $wachtwoord) {
        $this->wachtwoord = $wachtwoord;
    }

}
