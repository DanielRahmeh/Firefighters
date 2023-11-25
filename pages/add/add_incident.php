<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/incident.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/incident_type.php");
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/many/many_incident.php"); ?>">Retour</a></p>

<h1>Nouvel Incident</h1>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_incident.php"); ?>">
    <?php
    $reponse = $bdd->prepare("SELECT * 
                            FROM incident_type");
    $reponse->execute();
    $types = array();
    $i = 0;
    while ($donnees = $reponse->fetch()) {
        $new_type = new IncidentType($donnees["id_incident_type"],
                                $donnees["name_incident_type"]);
        $types[$i] = $new_type;
        $i++;
    }
    ?>
    <p>Type d'incident<select name="id_incident_type">
        <?php
        foreach($types as $type) {
            ?>
             <option value="<?php echo($type->id) ?>"><?php echo($type->name); ?></option>
            <?php
        }
        ?>
    </select></p>
    <p>Nom <input type="text" name="name"required></p>
    <p>Description <textarea name="description" required></textarea></p>
    <p>Date de début <input type="datetime-local" name="start_datetime" required></p>
    <p>Date de fin <input type="datetime-local" name="end_datetime"></p>
    <p><input type="submit" value="Ajouter"></p>
</form>

<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>
