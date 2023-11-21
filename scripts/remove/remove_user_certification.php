<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
if (isset($_GET["id_certification"]) && isset($_GET["id_user"])) {
    $reponse = $bdd->prepare("DELETE FROM obtained
                            WHERE id_certification = ?
                            AND id_user = ?");
    $reponse->execute([$_GET["id_certification"], $_GET["id_user"]]);
}
header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?error_certification=-1&id=".$_GET["id_user"]);
?>