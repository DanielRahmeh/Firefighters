<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
$reponse = $bdd->prepare("INSERT INTO alert(phone_alert, latitude_alert, longtitude_alert, datetime_alert, description_alert)
                        VALUES(?,?,?,?,?)");
$reponse->execute([$_POST["phone"], $_POST["latitude"], $_POST["longtitude"], $_POST["datetime"], $_POST["description"]]);
header("Location: ".$_SESSION["url"]."/pages/many/many_alert.php?error=0");
?>