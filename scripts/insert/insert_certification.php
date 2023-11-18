<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
if (isset($_POST["name"])) {
    $reponse = $bdd->prepare("INSERT INTO certification(name_certification)
                            VALUES(?)");
    $reponse->execute([$_POST["name"]]);
}
header("Location: ".$_SESSION["url"]."/pages/many/many_certification.php?error=0");
?>