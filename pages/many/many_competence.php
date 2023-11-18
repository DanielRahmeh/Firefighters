<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/competence.php");
$reponse = $bdd->prepare("SELECT * 
                        FROM competence");
$reponse->execute();
$competences = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $new_competence = new Competence($donnees["id_competence"],
                            $donnees["name_competence"]);
    $competences[$i] = $new_competence;
    $i++;
}
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/add/add_competence.php"); ?>">Ajouter</a></p>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == 0) {
        ?>
        <p>La compétence a bien été ajouté</p>
        <?php
    }
    if ($_GET["error"] == -1) {
        ?>
        <p>La compétence a bien été supprimé</p>
        <?php
    }
}
?>
<table>
    <tr>
        <th>Nom</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>
    <?php
    foreach($competences as $competence) {
        ?>
        <tr>
            <td><?php echo($competence->name); ?></td>
            <td><a href=<?php echo($_SESSION["url"]."/pages/single/single_competence.php?id=".$competence->id); ?>>Modifier</a></td>
            <td><a href=<?php echo($_SESSION["url"]."/scripts/remove/remove_competence.php?id=".$competence->id); ?>>Supprimer</a></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>