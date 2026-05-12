<?php
//toonalleboeken.php
declare(strict_types=1);
require_once("business/BoekService.php");
$boekSvc = new BoekService();
$boekenLijst = $boekSvc->getBoekenOverzicht();
include("presentation/boekenlijst.php");
