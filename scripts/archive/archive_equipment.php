<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

$reponse = $bdd->prepare("CALL ArchiveAndDeleteEquipments()");
$reponse->execute();
header("Location: ".$_SESSION["url"]."/pages/archive/many/many_archive_equipment.php");
?>