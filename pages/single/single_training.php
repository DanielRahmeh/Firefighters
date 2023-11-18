<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/training.php");
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/many/many_training.php"); ?>">Retour</a></p>
<?php
if (isset($_GET["id"])) {
    $reponse = $bdd->prepare("SELECT * 
                            FROM training
                            WHERE training.id_training = ?");
    $reponse->execute([$_GET["id"]]);
    while ($donnees = $reponse->fetch()) {
        $training = new Training($donnees["id_training"],
                                $donnees["name_training"],
                                $donnees["duration_training"]);
    }
}
if (isset($_GET["error"])) {
    if ($_GET["error"] == 0) {
        ?>
        <p>La formation a bien été modifié</p>
        <?php
    }
}
?>

<h1><?php echo($training->name); ?></h1>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/update/update_training.php?id=".$training->id); ?>">
    <p>Nom <input type="text" name="name" value="<?php echo($training->name); ?>" require></p>
    <p>Durée (en mois) <input type="number" name="duration" value="<?php echo($training->duration); ?>" require></p>
    <p><input type="submit" value="Modifier"></p>
</form>

<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>