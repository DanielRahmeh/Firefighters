<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
if (isset($_POST["name"]) && isset($_POST["duration"])) {
    $reponse = $bdd->prepare("INSERT INTO training(name_training, duration_training)
                            VALUES(?, ?)");
    $reponse->execute([$_POST["name"], $_POST["duration"]]);
}
header("Location: ".$_SESSION["url"]."/pages/many/many_training.php?error=0");
?>