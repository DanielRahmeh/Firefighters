<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/training.php");
$reponse = $bdd->prepare("SELECT * 
                        FROM training");
$reponse->execute();
$trainings = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $new_training = new Training($donnees["id_training"],
                            $donnees["name_training"],
                            $donnees["duration_training"]);
    $trainings[$i] = $new_training;
    $i++;
}
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/add/add_training.php"); ?>">Ajouter</a></p>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == 0) {
        ?>
        <p>La formation a bien été ajouté</p>
        <?php
    }
    if ($_GET["error"] == -1) {
        ?>
        <p>La formation a bien été supprimé</p>
        <?php
    }
}
?>
<table>
    <tr>
        <th>Nom</th>
        <th>Durée</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>
    <?php
    foreach($trainings as $training) {
        ?>
        <tr>
            <td><?php echo($training->name); ?></td>
            <td><?php echo($training->duration); ?> mois</td>
            <td><a href=<?php echo($_SESSION["url"]."/pages/single/single_training.php?id=".$training->id); ?>>Modifier</a></td>
            <td><a href=<?php echo($_SESSION["url"]."/scripts/remove/remove_training.php?id=".$training->id); ?>>Supprimer</a></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>