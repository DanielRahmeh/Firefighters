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
        $reponse = $bdd->prepare("UPDATE equipment
                                SET model_equipment = ?,
                                registration_equipment = ?,
                                puchrase_date_equipment = ?,
                                endlife_date_equipment = ?
                                WHERE id_equipment = ?");
        $reponse->execute([$_POST["model"],$_POST["registration"], $_POST["puchrase_date"], $_POST["endlife_date"], $_GET["id"]]);
        header("Location: ".$_SESSION["url"]."/pages/single/single_equipment.php?error=0&id=".$_GET["id"]);
        exit;
    } catch (PDOException $e) {
        header("Location: ".$_SESSION["url"]."/pages/single/single_equipment.php?error=-1&id=".$_GET["id"]);
        exit;
    }
}
header("Location: ".$_SESSION["url"]."/pages/single/single_equipment.php?id=".$_GET["id"]);
?>