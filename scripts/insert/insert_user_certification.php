<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}

if (isset($_POST["id_certification"]) && isset($_POST["id_user"])) {
    try {
        $reponse = $bdd->prepare("INSERT INTO obtained(id_certification, id_user, date_obtained) VALUES(?, ?, ?)");
        $reponse->execute([$_POST["id_certification"], $_POST["id_user"], $_POST["date"]]);
        header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?error_certification=0&id=".$_POST["id_user"]);
        exit;
    } catch (PDOException $e) {
        header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?error_certification=1&id=".$_POST["id_user"]);
        exit;
    }
}
header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?id=".$_POST["id_user"]);
exit;
?>