<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/alert.php");
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/many/many_alert.php"); ?>">Retour</a></p>
<?php
if (isset($_GET["id"])) {
    $reponse = $bdd->prepare("SELECT * 
                            FROM alert
                            WHERE alert.id_alert = ?");
    $reponse->execute([$_GET["id"]]);
    while ($donnees = $reponse->fetch()) {
        $alert = new Alert($donnees["id_alert"],
                            $donnees["phone_alert"],
                            $donnees["latitude_alert"],
                            $donnees["longtitude_alert"],
                            $donnees["datetime_alert"],
                            $donnees["description_alert"]);
    }
}
if (isset($_GET["error"])) {
    if ($_GET["error"] == 0) {
        ?>
        <p>L'alerte a bien été modifié</p>
        <?php
    }
}
?>

<h1>Alerte du <?php echo($alert->datetime); ?></h1>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/update/update_alert.php?id=".$alert->id); ?>">
    <p>Date <input type="datetime-local" name="datetime" value="<?php echo($alert->datetime); ?>" require></p>
    <p>Phone <input type="text" name="phone" value="<?php echo($alert->phone); ?>"></p>
    <p>Latitude <input type="number" name="latitude" value="<?php echo($alert->latitude); ?>" required></p>
    <p>Longtitude <input type="number" name="longtitude" value="<?php echo($alert->longtitude); ?>" required></p>
    <p>Description <textarea  name="description" required><?php echo($alert->description); ?></textarea></p>
    <p><input type="submit" value="Modifier"></p>
</form>

<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>