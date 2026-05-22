<?php
//verwijderboek.php

spl_autoload_register();
require_once("vendor/autoload.php");
use Business\BoekService;

$boekSvc = new BoekService();
$boekSvc->verwijderBoek((int)$_GET["id"]);
header("location: toonalleboeken.php");
exit(0);


