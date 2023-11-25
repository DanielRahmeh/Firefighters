<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

if (isset($_POST["id_alert"]) && isset($_GET["id"])) {
    try {
        $reponse = $bdd->prepare("INSERT INTO alerted(id_alert, id_incident) VALUES(?, ?)");
        $reponse->execute([$_POST["id_alert"], $_GET["id"]]);
        header("Location: ".$_SESSION["url"]."/pages/single/single_incident.php?error_alert=0&id=".$_GET["id"]);
        exit;
    } catch (PDOException $e) {
        header("Location: ".$_SESSION["url"]."/pages/single/single_incident.php?error_alert=1&id=".$_GET["id"]);
        exit;
    }
}
header("Location: ".$_SESSION["url"]."/pages/single/single_incident.php?id=".$_GET["id"]);
exit;
?>