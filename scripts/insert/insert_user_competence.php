<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

if (isset($_POST["id_competence"]) && isset($_GET["id_user"])) {
    try {
        $reponse = $bdd->prepare("INSERT INTO qualified(id_competence, id_user) VALUES(?, ?)");
        $reponse->execute([$_POST["id_competence"], $_GET["id_user"]]);
        header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?error_competence=0&id=".$_GET["id_user"]);
        exit;
    } catch (PDOException $e) {
            header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?error_competence=1&id=".$_GET["id_user"]);
            exit;
    }
}
header("Location: ".$_SESSION["url"]."/pages/single/single_user.php");
exit;
?>
