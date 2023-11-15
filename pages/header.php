<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Pompiers</title>
</head>
<?php
session_start();
require ('../scripts/connect_to_db.php');
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
?>
<body>
    <header>
        <p><a href="home_page.php">Accueil</a></p>
        <p><a href="my_profil_page.php">Profil</a></p>
        <p><a href="../scripts/disconnect.php">Déconnexion</a></p>
        <?php
        switch ($_SESSION["id_role_user"]) {
            case 1:
            case 2:
                ?>
                <p><a href="many_managing/many_user.php">Gestion des utilisateurs</a></p>
                <p><a href="many_managing/many_competence.php">Gestion des compétences</a></p>
                <p><a href="many_managing/many_training.php">Gestion des formations</a></p>
                <p><a href="many_managing/many_certification.php">Gestion des certification</a></p>
                <p><a href="many_managing/many_schedule.php">Gestion des plannings</a></p>
                <?php
                if ($_SESSION["id_role_user"] == 2) {
                    break;
                }
            case 3:
                ?>
                <p><a href="many_managing/many_equipment.php">Gestion des équipements</a></p>
                <p><a href="many_managing/many_servicing.php">Gestion des maintenances</a></p>
                <?php
                if ($_SESSION["id_role_user"] == 3) {
                    break;
                }
            case 4:
                ?>
                <p><a href="many_managing/many_alert.php">Gestion des alertes</a></p>
                <p><a href="many_managing/many_incident.php">Gestion des incidents</a></p>
                <?php
                if ($_SESSION["id_role_user"] == 4) {
                    break;
                }
            case 5:
                ?>
                <p><a href="many_managing/many_state.php">Gestion des états d'interventions</a></p>
                <p><a href="many_managing/many_analyse.php">Gestion des analyse d'intervention</a></p>
                <?php
                if ($_SESSION["id_role_user"] == 5) {
                    break;
                }
            case 6:
                ?>
                <p><a href="many_managing/many_state.php">Gestion des états d'interventions</a></p>
                <p><a href="many_managing/many_analyse.php">Gestion des analyse d'intervention</a></p>
                <p><a href="many_managing/many_intervention.php">Gestion des d'interventions</a></p>
                <?php
                break;
            case 7:
                break;
        }
        ?>
    </header>
