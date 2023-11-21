<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/user.php");
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/many/many_user.php"); ?>">Retour</a></p>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM user_archive
                        INNER JOIN user_role ON user_archive.id_user_role = user_role.id_user_role
                        WHERE user_archive.id_user = ?");
$reponse->execute([$_GET["id"]]);
while ($donnees = $reponse->fetch()) {
    $user = new User($donnees["id_user"],
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
}
?>
<h1>Profil de <?php echo($user->first_name); ?> <?php echo($user->last_name);?> </h1>
<h2><?php echo($user->name_user_role); ?></h2>
<h3>Information personnelles</h3>
<p>Prénom  : <?php echo($user->first_name); ?></p>
<p>Nom : <?php echo($user->last_name); ?></p>
<p>Téléphone : <?php echo($user->phone); ?></p>
<p>Adresse : <?php echo($user->address); ?></p>
<p>Mail : <?php echo($user->mail); ?></p>
<p>Date : <?php echo($user->start_date); ?></p>
<p>Date : <?php echo($user->end_date); ?></p>

<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>