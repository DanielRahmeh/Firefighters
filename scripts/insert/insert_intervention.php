<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$reponse = $bdd->prepare("INSERT INTO intervention(id_incident, start_datetime_intervention, end_datetime_intervention)
                        VALUES(?,?,?)");
$reponse->execute([$_POST["id_incident"], $_POST["start_datetime"], $_POST["end_datetime"]]);

header("Location: ".$_SESSION["url"]."/pages/many/many_intervention.php?error=0");
?>
