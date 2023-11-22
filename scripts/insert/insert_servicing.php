<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

if (isset($_GET["id"])) {
    try {
        $reponse = $bdd->prepare("INSERT INTO servicing(id_equipment, date_servicing, description_servicing)
                                VALUES(?, ?, ?)");
        $reponse->execute([$_GET["id"], $_POST["date"], $_POST["description"]]);
        header("Location: ".$_SESSION["url"]."/pages/single/single_equipment.php?error=0&id=".$_GET["id"]);
        exit;
    } catch (PDOException $e) {
        header("Location: ".$_SESSION["url"]."/pages/single/single_equipment.php?error=1&id=".$_GET["id"]);
        exit;
    }
}
header("Location: ".$_SESSION["url"]."/pages/single/single_equipment.php?id=".$_GET["id"]);
exit;
?>