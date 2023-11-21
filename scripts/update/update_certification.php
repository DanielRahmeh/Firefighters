<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
if (isset($_GET["id"]) && isset($_POST["name"])) {
    $reponse = $bdd->prepare("UPDATE certification
                            SET name_certification = ?
                            WHERE id_certification = ?");
    $reponse->execute([$_POST["name"], $_GET["id"]]);
}
header("Location: ".$_SESSION["url"]."/pages/single/single_certification.php?error=0&id=".$_GET["id"]);
?>