<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/user.php");


$reponse = $bdd->prepare("SELECT * 
                        FROM user_archive
                        INNER JOIN user_role ON user_archive.id_user_role = user_role.id_user_role");
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
<table>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Role</th>
        <th>Plus</th>
    </tr>
    <?php
    foreach($users as $user) {
        ?>
        <tr>
            <td><?php echo($user->last_name); ?></td>
            <td><?php echo($user->first_name); ?></td>
            <td><?php echo($user->name_user_role); ?></td>
            <td><a href=<?php echo($_SESSION["url"]."/pages/archive/single/single_archive_user.php?id=".$user->id); ?>>Details</a></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>