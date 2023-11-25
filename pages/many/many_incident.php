<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/incident.php");
?>
<h1>Liste des incidents</h1>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM incident
                        INNER JOIN incident_type ON incident.id_incident_type = incident_type.id_incident_type
                        ORDER BY start_datetime_incident DESC");
$reponse->execute();
$incidents = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $new_incident = new Incident($donnees["id_incident"],
                                 $donnees["name_incident"],
                                 $donnees["description_incident"],
                                 $donnees["start_datetime_incident"],
                                 $donnees["end_datetime_incident"],
                                 $donnees["id_incident_type"],
                                 $donnees["name_incident_type"]);
    $incidents[$i] = $new_incident;
    $i++;
}
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/add/add_incident.php"); ?>">Ajouter</a></p>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == 0) {
        ?>
        <p>L'incident a bien été ajouté</p>
        <?php
    }
}
?>
<table>
    <tr>
        <th>Type</th>
        <th>Nom</th>
        <th>Date de début</th>
        <th>Date de fin</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php
    foreach($incidents as $incident) {
        ?>
        <tr>
            <td><?php echo($incident->name_incident_type); ?></td>
            <td><?php echo($incident->name); ?></td>
            <td><?php echo($incident->start_datetime); ?></td>
            <td><?php echo($incident->end_datetime); ?></td>
            <td><?php echo($incident->description); ?></td>
            <td><a href=<?php echo($_SESSION["url"]."/pages/single/single_incident.php?id=".$incident->id); ?>>Modifier</a></td>
            <td><a href=<?php echo($_SESSION["url"]."/scripts/remove/remove_incident.php?id=".$incident->id); ?>>Supprimer</a></td>
        </tr>
        <?php
    }
    ?>
</table>
