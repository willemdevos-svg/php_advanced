<?php
//toongeheim.php
declare(strict_types=1);
session_start();
if ($_SESSION["aangemeld"] == true) {
    include("presentation/geheim.php");
} else {
    header('location:aanmelden.php');
    exit;
}
