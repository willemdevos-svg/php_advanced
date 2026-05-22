<?php
//aanmelden.php
declare(strict_types=1);
session_start();
require_once("business/UserService.php");

if (isset($_GET["action"]) && $_GET["action"] === "login") {
    $service = new UserService();
    if ($service->controleerGebruiker($_POST["gebruikersnaam"], $_POST["wachtwoord"])) {
        $_SESSION["aangemeld"] = true;
        header('location:toongeheim.php');
        exit;
    } else {
        $_SESSION["aangemeld"] = false;
        header('location:aanmelden.php');
        exit;
    }
} else {
    $_SESSION["aangemeld"] = false;
    include("presentation/loginForm.php");
}
