<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/training.php");
?>
<h1>Ajouter une formation</h1>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_training.php"); ?>">
    <p>Nom <input type="text" name="name" require></p>
    <p>Durée (en mois) <input type="number" name="duration" require></p>
    <p><input type="submit" value="Ajouer"></p>
</form>

<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");

?>