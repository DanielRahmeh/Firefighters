<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
try {
    $reponse = $bdd->prepare("INSERT INTO equipment(id_equipment_type,
                                                    model_equipment,
                                                    registration_equipment,
                                                    puchrase_date_equipment,
                                                    endlife_date_equipment)
                            VALUES(?, ?, ?, ?, ?)");
    $reponse->execute([$_POST["id_equipment_type"],
                        $_POST["model"],
                        $_POST["registration"],
                        $_POST["puchrase_date"],
                        $_POST["endlife_date"]]);
    header("Location: ".$_SESSION["url"]."/pages/many/many_equipment.php?error=0");
    exit;
    
} catch (PDOException $e) {
    header("Location: ".$_SESSION["url"]."/pages/many/many_equipment.php?error=-1");
    exit;
}
header("Location: ".$_SESSION["url"]."/pages/many/many_equipment.php");
?>