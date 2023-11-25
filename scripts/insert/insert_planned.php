<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

if (isset($_GET["id"])) {
    for($i = $_POST["start_hour"]; $i < $_POST["end_hour"]; $i++) {
        $reponse = $bdd->prepare("INSERT INTO planned(id_schedule, id_user, date_planned, hour_planned)
        VALUES(?, ?, ?, ?)");
        $reponse->execute([1, $_GET["id"], $_POST["date"], $i]);
        header("Location: ".$_SESSION["url"]."/pages/many/many_planned.php?error=0&id=".$_GET["id"]);
    }
}
header("Location: ".$_SESSION["url"]."/pages/many/many_planned.php?error=-1&id=".$_GET["id"]);
?>