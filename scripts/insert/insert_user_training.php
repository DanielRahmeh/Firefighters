<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

if (isset($_POST["id_training"]) && isset($_POST["id_user"])) {
    try {
        $reponse = $bdd->prepare("INSERT INTO trained(id_training, id_user, start_date_trained, end_date_trained) VALUES(?, ?, ?, ?)");
        $reponse->execute([$_POST["id_training"], $_POST["id_user"], $_POST["start_date"], $_POST["end_date"]]);
        header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?error_training=0&id=".$_POST["id_user"]);
        exit;
    } catch (PDOException $e) {
        header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?error_training=1&id=".$_POST["id_user"]);
        exit;
    }
}
header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?id=".$_POST["id_user"]);
exit;
?>