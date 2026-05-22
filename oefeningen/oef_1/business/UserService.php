<?php
//business/UserService.php

declare(strict_types=1);
include('entities/Gebruiker.php');
include('data/GebruikersDAO.php');

class UserService
{
    public function controleerGebruiker(string $gebruikersnaam, string $wachtwoord): bool
    {
        $gebruikersDAO = new GebruikersDAO;
        $huidigGebruiker = $gebruikersDAO->getUserByName($gebruikersnaam);
        if ($huidigGebruiker && $huidigGebruiker->getWachtwoord() === $wachtwoord) {
            return true;
        } else {
            return false;
        }
    }
}
