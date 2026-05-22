<?php

declare(strict_types=1);
?>
<!DOCTYPE HTML>
<!--presentation/loginForm.php-->
<html>

<head>
    <meta charset=utf-8>
    <title>loginForm</title>
</head>

<body>
    <h1>loginForm</h1>
    <br>
    Vink aan indien aanwezig:
    <br>
    <form action="aanmelden.php?action=login" method="post">
        <label for="gebruikersnaam">Gebruikersnaam</label>
        <input type="text" name="gebruikersnaam" id="gebruikersnaam">
        <label for="wachtwoord">Wachtwoord</label>
        <input type="password" name="wachtwoord" id="wachtwoord"><br>
        <input type="submit" value="aanmelden">
    </form>
</body>

</html>