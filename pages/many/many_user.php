<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/user.php");


$reponse = $bdd->prepare("SELECT * 
                        FROM user 
                        INNER JOIN user_role ON user.id_user_role = user_role.id_user_role");
$reponse->execute();
$users = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $new_user = new User($donnees["id_user"],
                        $donnees["firstname_user"],
                        $donnees["lastname_user"],
                        $donnees["phone_user"],
                        $donnees["address_user"],
                        $donnees["mail_user"],
                        $donnees["password_user"],
                        $donnees["start_date_user"],
                        $donnees["end_date_user"],
                        $donnees["id_user_role"],
                        $donnees["name_user_role"]);
    $users[$i] = $new_user;
    $i++;
}
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/add/add_user.php"); ?>">Ajouter</a></p>
<p><a href="<?php echo($_SESSION["url"]."/scripts/archive/archive_user.php"); ?>">Archiver</a></p>
<?php
if(isset($_GET["error"])) {
    switch ($_GET["error"]) {
        case -1:
            ?>
            <p>Erreur lors de la création du profil</p>
            <?php
            break;
        case 0:
            ?>
            <p>La profil a bien été crée</p>
            <?php
            break;
    }
}
?>
<table>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Role</th>
        <th>Modifier</th>
    </tr>
    <?php
    foreach($users as $user) {
        ?>
        <tr>
            <td><?php echo($user->last_name); ?></td>
            <td><?php echo($user->first_name); ?></td>
            <td><?php echo($user->name_user_role); ?></td>
            <td><a href=<?php echo($_SESSION["url"]."/pages/single/single_user.php?id=".$user->id); ?>>Modifier</a></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>