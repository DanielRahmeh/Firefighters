<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
if (isset($_GET["id"]) && isset($_POST["name"]) && isset($_POST["duration"])) {
    $reponse = $bdd->prepare("UPDATE training
                            SET name_training = ?,
                            duration_training = ?
                            WHERE id_training = ?");
    $reponse->execute([$_POST["name"],$_POST["duration"], $_GET["id"]]);
}
header("Location: ".$_SESSION["url"]."/pages/single/single_training.php?error=0&id=".$_GET["id"]);
?>