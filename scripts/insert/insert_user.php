<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
//try {
    $reponse = $bdd->prepare("INSERT INTO user(id_user_role,
                                                firstname_user,
                                                lastname_user,
                                                phone_user,
                                                address_user,
                                                mail_user,
                                                password_user,
                                                start_date_user,
                                                end_date_user)
                            VALUES(?, ?, ?, ?, ?, ?, SHA2(?, 256), ?, ?)");
    $reponse->execute([$_POST["id_user_role"],
                    $_POST["firstname"],
                    $_POST["lastname"],
                    $_POST["phone"],
                    $_POST["address"],
                    $_POST["mail"],
                    $_POST["password"],
                    $_POST["start_date"],
                    $_POST["end_date"]]);
    //header("Location: ".$_SESSION["url"]."/pages/many/many_user.php?error=0");
    exit;
    
//} catch (PDOException $e) {
    //header("Location: ".$_SESSION["url"]."/pages/many/many_user.php?error=-1");
    //exit;
//}
//header("Location: ".$_SESSION["url"]."/pages/many/many_user.php");
?>