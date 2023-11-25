<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo($_SESSION["url"]."/styles/styles.css"); ?>>
    <title>Pompiers</title>
</head>
<?php

require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
?>
<body>
    <header>
        <p><a href=<?php echo($_SESSION["url"]."/pages/home_page.php"); ?>>Accueil</a></p>
        <p><a href=<?php echo($_SESSION["url"]."/pages/my_profil_page.php"); ?>>Profil</a></p>
        <p><a href=<?php echo($_SESSION["url"]."/scripts/disconnect.php"); ?>>Déconnexion</a></p>
        <?php
        switch ($_SESSION["id_user_role"]) {
            case 1:
                if ($_SESSION["id_user_role"] == 1) {
                    ?>
                    <p><a href=<?php echo($_SESSION["url"]."/pages/archive/many/many_archive_user.php"); ?>>Archive des utilisateurs</a></p>
                    <p><a href=<?php echo($_SESSION["url"]."/pages/archive/many/many_archive_equipment.php"); ?>>Archive des équipements</a></p>
                    <p><a href=<?php echo($_SESSION["url"]."/pages/archive/many/many_archive_incident.php"); ?>>Archive des incidents</a></p>
                    <p><a href=<?php echo($_SESSION["url"]."/pages/archive/many/many_archive_intervention.php"); ?>>Archive des interventions</a></p>
                    <?php
                }
            case 2:
                ?>
                <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_user.php"); ?>>Gestion des utilisateurs</a></p>
                <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_competence.php"); ?>>Gestion des compétences</a></p>
                <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_training.php"); ?>>Gestion des formations</a></p>
                <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_certification.php"); ?>>Gestion des certification</a></p>
                <?php
                if ($_SESSION["id_user_role"] == 2) {
                    break;
                }
            case 3:
                ?>
                <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_equipment.php"); ?>>Gestion des équipements</a></p>
                <?php
                if ($_SESSION["id_user_role"] == 3) {
                    break;
                }
            case 4:
                ?>
                <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_alert.php"); ?>>Gestion des alertes</a></p>
                <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_incident.php"); ?>>Gestion des incidents</a></p>
                <?php
                if ($_SESSION["id_user_role"] == 4) {
                    break;
                }
            case 5:
                if ($_SESSION["id_user_role"] == 5) {
                    ?>
                    <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_disponibility.php"); ?>>Définir ses disponibilités</a></p>
                    <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_state.php"); ?>>Gestion des états d'interventions</a></p>
                    <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_analyse.php"); ?>>Gestion des analyse d'intervention</a></p>
                    <?php
                    break;
                }
            case 6:
                ?>
                <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_disponibility.php"); ?>>Définir ses disponibilités</a></p>
                <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_state.php"); ?>>Gestion des états d'interventions</a></p>
                <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_analyse.php"); ?>>Gestion des analyse d'intervention</a></p>
                <p><a href=<?php echo($_SESSION["url"]."/pages/many/many_intervention.php"); ?>>Gestion des d'interventions</a></p>
                <?php
                break;
            case 7:
                break;
        }
        ?>
    </header>