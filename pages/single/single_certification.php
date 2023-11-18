<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/certification.php");
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/many/many_certification.php"); ?>">Retour</a></p>
<?php
if (isset($_GET["id"])) {
    $reponse = $bdd->prepare("SELECT * 
                            FROM certification
                            WHERE certification.id_certification = ?");
    $reponse->execute([$_GET["id"]]);
    while ($donnees = $reponse->fetch()) {
        $certification = new Certification($donnees["id_certification"],
                                    $donnees["name_certification"]);
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

<h1><?php echo($certification->name); ?></h1>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/update/update_certification.php?id=".$certification->id); ?>">
    <p>Nom <input type="text" name="name" value="<?php echo($certification->name); ?>" require></p>
    <p><input type="submit" value="Modifier"></p>
</form>

<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>