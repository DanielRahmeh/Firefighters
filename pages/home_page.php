<?php
include("header.php");
?>
<main>
    <p>Bienvenue <?php echo($_SESSION["firstname_user"]); ?> <?php echo($_SESSION["lastname_user"]); ?></p>
    <p>vous êtes connecté en tant que <?php echo($_SESSION["role_user"]); ?></p>
</main>
<?php
include("footer.php");
?>