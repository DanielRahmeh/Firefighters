<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/user.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/user_role.php");
?>
<a href="<?php echo($_SESSION["url"]."/pages/many/many_user.php"); ?>">Retour</a>
<h1>Ajouter un utilisateur</h1>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_user.php"); ?>">
    <?php
    $reponse = $bdd->prepare("SELECT * 
                            FROM user_role");
    $reponse->execute();
    $roles = array();
    $i = 0;
    while ($donnees = $reponse->fetch()) {
        $new_role = new UserRole($donnees["id_user_role"],
                                $donnees["name_user_role"]);
        $roles[$i] = $new_role;
        $i++;
    }
    ?>
    <p>Role<select name="id_user_role">
        <?php
        foreach($roles as $role) {
            ?>
             <option value="<?php echo($role->id) ?>"><?php echo($role->name); ?></option>
            <?php
        }
        ?>
    </select></p>
    <p>Prénom <input type="text" name="firstname" required></p>
    <p>Nom <input type="text" name="lastname" required></p>
    <p>Téléphone <input type="text" name="phone" required></p>
    <p>Adresse <input type="text" name="address" required></p>
    <p>Mail <input type="text" name="mail" required></p>
    <p>Mot de passe <input type="password" name="password" required></p>
    <p>Date <input type="date" name="start_date" required></p>
    <p>Date <input type="date" name="end_date"></p>
    <p><input type="submit" value="Modifier"></p>
</form>