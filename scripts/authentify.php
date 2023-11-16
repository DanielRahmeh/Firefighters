<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/scripts/connect_to_db.php");
$db = new Database();
$bdd = $db->getConnection();
if (!$bdd) {
   die("Error connecting to the database");
}
if (isset($_POST["mail"]) && isset($_POST["password"])) {
    $reponse = $bdd->prepare("SELECT * 
                            FROM user
                            INNER JOIN user_role ON user.id_user_role = user_role.id_user_role
                            WHERE user.password_user = SHA2(?, 256)
                            AND user.mail_user = ?");
    $reponse->execute([$_POST["password"], $_POST["mail"]]);
    $i = 0;
    while ($donnees = $reponse->fetch()) {
        $id = $donnees["id_user"];
        $firstname = $donnees["firstname_user"];
        $lastname = $donnees["lastname_user"];
        $phone = $donnees["phone_user"];
        $address = $donnees["address_user"];
        $mail = $donnees["mail_user"];
        $password = $donnees["password_user"];
        $start_date = $donnees["start_date_user"];
        $end_date = $donnees["end_date_user"];
        $role_id = $donnees["id_user_role"];
        $role = $donnees["name_user_role"];
        $i++;
    }
    if ($i == 0) {
        header("Location: ".$_SESSION["url"]."/pages/index.php?error=2");
    }
    else {
        session_start();
        $_SESSION["id_user"] = $id;
        $_SESSION["firstname_user"] = $firstname;
        $_SESSION["lastname_user"] = $lastname;
        $_SESSION["phone_user"] = $phone;
        $_SESSION["address_user"] = $address;
        $_SESSION["mail_user"] = $mail;
        $_SESSION["password_user"] = $password;
        $_SESSION["start_date_user"] = $start_date;
        $_SESSION["end_date_user"] = $end_date;
        $_SESSION["id_user_role"] = $role_id;
        $_SESSION["role_user"] = $role;
        header("Location: ".$_SESSION["url"]."/pages/home_page.php");
    }
}
else {
    header("Location: ".$_SESSION["url"]."/pages/index.php?error=1");
}
?>