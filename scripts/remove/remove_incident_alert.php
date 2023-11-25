<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
if (isset($_GET["id_alert"]) && isset($_GET["id_incident"])) {
    $reponse = $bdd->prepare("DELETE FROM alerted
                            WHERE id_alert = ?
                            AND id_incident = ?");
    $reponse->execute([$_GET["id_alert"], $_GET["id_incident"]]);
}
header("Location: ".$_SESSION["url"]."/pages/single/single_incident.php?error_alert=-1&id=".$_GET["id_incident"]);
?>