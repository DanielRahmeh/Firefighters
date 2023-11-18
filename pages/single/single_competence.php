<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/competence.php");
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/many/many_competence.php"); ?>">Retour</a></p>
<?php
if (isset($_GET["id"])) {
    $reponse = $bdd->prepare("SELECT * 
                            FROM competence
                            WHERE competence.id_competence = ?");
    $reponse->execute([$_GET["id"]]);
    while ($donnees = $reponse->fetch()) {
        $competence = new Competence($donnees["id_competence"],
                                    $donnees["name_competence"]);
    }
}
if (isset($_GET["error"])) {
    if ($_GET["error"] == 0) {
        ?>
        <p>La compétence a bien été modifié</p>
        <?php
    }
}
?>

<h1><?php echo($competence->name); ?></h1>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/update/update_competence.php?id=".$competence->id); ?>">
    <p>Nom <input type="text" name="name" value="<?php echo($competence->name); ?>" require></p>
    <p><input type="submit" value="Modifier"></p>
</form>

<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>