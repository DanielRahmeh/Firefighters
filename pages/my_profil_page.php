<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
?>
<main>
    <h1>Mon profil</h1>
    <h2>Informations personnelles</h2>
    <p>Nom : <?php echo($_SESSION["lastname_user"]); ?></p>
    <p>Prénom : <?php echo($_SESSION["firstname_user"]); ?></p>
    <p>Téléphone : <?php echo($_SESSION["phone_user"]); ?></p>
    <p>Adresse : <?php echo($_SESSION["address_user"]); ?></p>
    <p>Mail : <?php echo($_SESSION["mail_user"]); ?></p>
    <p>Arrivé le <?php echo($_SESSION["start_date_user"]); ?></p>
    <h2>Modifier mon mot de passe</h2>
    <?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case "0":
                ?>
                <p>Le mot de passe a été modifié avec succès</p>
                <?php
                break;
            case "1":
                ?>
                <p>Les mot de passes ne sont pas identiques</p>
                <?php
                break;
        }
    }
    ?>
    <form method="post" action=<?php echo($_SESSION["url"]."/scripts/password_modification.php"); ?>>
        <p>Mot de passe : <input type="password" id="password" name="password" required></p>
        <p>Confirmation du mot de passe : <input type="password" id="password" name="re_password" required></p>
        <p><input type="submit" value="Modification"></p>
    </form>
</main>
<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>