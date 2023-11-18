<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/certification.php");
$reponse = $bdd->prepare("SELECT * 
                        FROM certification");
$reponse->execute();
$certifications = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $new_certification = new Certification($donnees["id_certification"],
                            $donnees["name_certification"]);
    $certifications[$i] = $new_certification;
    $i++;
}
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/add/add_certification.php"); ?>">Ajouter</a></p>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == 0) {
        ?>
        <p>La certfication a bien été ajouté</p>
        <?php
    }
    if ($_GET["error"] == -1) {
        ?>
        <p>La certfication a bien été supprimé</p>
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
    foreach($certifications as $certification) {
        ?>
        <tr>
            <td><?php echo($certification->name); ?></td>
            <td><a href=<?php echo($_SESSION["url"]."/pages/single/single_certification.php?id=".$certification->id); ?>>Modifier</a></td>
            <td><a href=<?php echo($_SESSION["url"]."/scripts/remove/remove_certification.php?id=".$certification->id); ?>>Supprimer</a></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>