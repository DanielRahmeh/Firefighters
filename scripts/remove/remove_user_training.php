<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
if (isset($_GET["id_training"]) && isset($_GET["id_user"])) {
    $reponse = $bdd->prepare("DELETE FROM trained
                            WHERE id_training = ?
                            AND id_user = ?");
    $reponse->execute([$_GET["id_training"], $_GET["id_user"]]);
}
header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?error_training=-1&id=".$_GET["id_user"]);
?>