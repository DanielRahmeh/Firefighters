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
        $reponse = $bdd->prepare("UPDATE user
                                SET firstname_user = ?,
                                lastname_user = ?,
                                phone_user = ?,
                                address_user = ?,
                                mail_user = ?,
                                start_date_user = ?,
                                end_date_user = ?
                                WHERE id_user = ?");
        $reponse->execute([$_POST["first_name"],$_POST["last_name"], $_POST["phone"], $_POST["address"],$_POST["mail"], $_POST["start_date"], $_POST["end_date"], $_GET["id"]]);
        header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?error=0&id=".$_GET["id"]);
        exit;
    } catch (PDOException $e) {
        header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?error=-1&id=".$_GET["id"]);
        exit;
    }
}
header("Location: ".$_SESSION["url"]."/pages/single/single_user.php?id=".$_GET["id"]);
?>