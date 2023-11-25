<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/intervention.php");

?>
<p><a href="<?php echo($_SESSION["url"]."/pages/many/many_intervention.php"); ?>">Retour</a></p>

<h1>Nouvelle Intervention</h1>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_intervention.php"); ?>">
    <?php
    $reponse = $bdd->prepare("SELECT * FROM incident");
    $reponse->execute();
    ?>
    <p>Incident<select name="id_incident">
        <?php
        while ($donnees = $reponse->fetch()) {
            echo '<option value="'.$donnees["id_incident"].'">'.$donnees["name_incident"].'</option>';
        }
        ?>
    </select></p>
    <p>Date de début <input type="datetime-local" name="start_datetime" required></p>
    <p>Date de fin <input type="datetime-local" name="end_datetime"></p>
    <p><input type="submit" value="Ajouter"></p>
</form>

<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>
