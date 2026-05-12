<?php
//business/BoekService.php
declare(strict_types=1);
require_once("data/BoekDAO.php");
class BoekService
{
    public function getBoekenOverzicht(): array
    {
        $boekDAO = new BoekDAO();
        $lijst = $boekDAO->getAll();
        return $lijst;
    }
}
