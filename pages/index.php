<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Pomper</title>
</head>
<body>
<?php
if (isset($_GET["error"])) {
    switch ($_GET["error"]) {
        case "1":
            ?>
                <p>Veuillez remplir tous les champs de connection.</p>
            <?php
            break;
        case "2":
            ?>
                <p>Identifiants incorrectes.</p>
            <?php
            break;
    }
}
?>
<main>
    <form method="post" action="../scripts/authentify.php">
        <p>Mail : <input type="text" id="mail" name="mail" required></p>
        <p>Mot de passe : <input type="password" id="password" name="password" required></p>
        <p><input type="submit" value="Se connecter"></p>
    </form>
</main>
<?php
include("footer.php");
?>