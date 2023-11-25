<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

if (isset($_GET["id"])) {
    $reponse = $bdd->prepare("UPDATE intervention
                            SET start_datetime_intervention = ?,
                            end_datetime_intervention = ?
                            WHERE id_intervention = ?");
    $reponse->execute([$_POST["start_datetime"], $_POST[" end_datetime"], $_GET["id"]]);
}

header("Location: ".$_SESSION["url"]."/pages/single/single_intervention.php?error=0&id=".$_GET["id"]);
?>
