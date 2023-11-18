<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
if (isset($_GET["id"])) {
    $reponse = $bdd->prepare("DELETE FROM competence
                            WHERE id_competence = ?");
    $reponse->execute([$_GET["id"]]);
}
header("Location: ".$_SESSION["url"]."/pages/many/many_competence.php?error=-1&id=".$_GET["id"]);
?>