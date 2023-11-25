<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

if (isset($_GET["id"])) {
    $reponse = $bdd->prepare("UPDATE incident
                            SET name_incident = ?,
                            description_incident = ?,
                            start_datetime_incident = ?,
                            end_datetime_incident = ?
                            WHERE id_incident = ?");
    $reponse->execute([$_POST["name"], $_POST["description"], $_POST["start_datetime"], $_POST["end_datetime"], $_GET["id"]]);
}

header("Location: ".$_SESSION["url"]."/pages/single/single_incident.php?error=0&id=".$_GET["id"]);
?>
