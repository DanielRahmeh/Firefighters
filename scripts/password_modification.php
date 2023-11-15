<?php
    session_start();
    require ('connect_to_db.php');
    $db = new Database();
    $bdd = $db->getConnection();
    if (!$bdd) {
        die("Error connecting to the database");
    }
    if (isset($_POST["password"]) && isset($_POST["re_password"])) {
        if ($_POST["password"] != $_POST["re_password"]) {
            header("Location: ../pages/my_profil_page.php?error=1");
        }
        else {
            $reponse = $bdd->prepare("UPDATE user
                                    SET password_user = SHA2(?, 256) 
                                    WHERE id_user = ?");
            $reponse->execute([$_POST["password"], $_SESSION["id_user"]]);
            header("Location: ../pages/my_profil_page.php?error=0");
        }
    }
?>