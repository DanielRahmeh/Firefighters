<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
if (isset($_GET["id_user"]) && isset($_GET["id_intervention"])) {
    $reponse = $bdd->prepare("DELETE FROM intervened
                            WHERE id_user = ?
                            AND id_intervention = ?");
    $reponse->execute([$_GET["id_user"], $_GET["id_intervention"]]);
}
header("Location: ".$_SESSION["url"]."/pages/single/single_interevention.php?error_user=-1&id=".$_GET["id_intervention"]);
?>