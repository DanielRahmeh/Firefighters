<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/alert.php");
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/many/many_alert.php"); ?>">Retour</a></p>

<h1>Nouvelle Alerte</h1>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_alert.php"); ?>">
    <p>Date <input type="datetime-local" name="datetime" require></p>
    <p>Phone <input type="text" name="phone"></p>
    <p>Latitude <input type="number" name="latitude" required></p>
    <p>Longtitude <input type="number" name="longtitude" required></p>
    <p>Description <textarea  name="description" required></textarea></p>
    <p><input type="submit" value="Ajouter"></p>
</form>

<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>