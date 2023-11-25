<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
if (isset($_GET["id"])) {
    $reponse = $bdd->prepare("UPDATE alert
                            SET phone_alert = ?,
                            latitude_alert = ?,
                            longtitude_alert = ?,
                            datetime_alert = ?,
                            description_alert = ?
                            WHERE id_alert = ?");
    $reponse->execute([$_POST["phone"], $_POST["latitude"], $_POST["longtitude"], $_POST["datetime"], $_POST["description"], $_GET["id"]]);
}
header("Location: ".$_SESSION["url"]."/pages/single/single_alert.php?error=0&id=".$_GET["id"]);
?>