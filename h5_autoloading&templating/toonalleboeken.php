<?php
//toonalleboeken.php
declare(strict_types=1);
spl_autoload_register();
require_once("vendor/autoload.php");

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Business\BoekService;

$loader = new FilesystemLoader('Presentation');
$twig = new Environment($loader);
$boekSvc = new BoekService();
$boekenLijst = $boekSvc->getBoekenOverzicht();
print $twig->render("boekenlijst.twig", array("boekenlijst"=>$boekenLijst));
?>