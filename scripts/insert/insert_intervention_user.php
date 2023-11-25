<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

if (isset($_POST["id_user"]) && isset($_GET["id"])) {
    try {
        $reponse = $bdd->prepare("INSERT INTO intervened(id_user, id_intervention) VALUES(?, ?)");
        $reponse->execute([$_POST["id_user"], $_GET["id"]]);
        header("Location: ".$_SESSION["url"]."/pages/single/single_intervention.php?error_user=0&id=".$_GET["id"]);
        exit;
    } catch (PDOException $e) {
        header("Location: ".$_SESSION["url"]."/pages/single/single_intervention.php?error_user=1&id=".$_GET["id"]);
        exit;
    }
}
header("Location: ".$_SESSION["url"]."/pages/single/single_intervention.php?id=".$_GET["id"]);
exit;
?>