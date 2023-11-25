<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$reponse = $bdd->prepare("INSERT INTO incident(id_incident_type, name_incident, description_incident, start_datetime_incident, end_datetime_incident)
                        VALUES(?,?,?,?,?)");
$reponse->execute([$_POST["id_incident_type"], $_POST["name"], $_POST["description"], $_POST["start_datetime"], $_POST["end_datetime"]]);

header("Location: ".$_SESSION["url"]."/pages/many/many_incident.php?error=0");
?>
