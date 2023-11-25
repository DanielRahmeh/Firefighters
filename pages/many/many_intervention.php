<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/intervention.php");

$reponse = $bdd->prepare("SELECT *
                          FROM intervention 
                          INNER JOIN incident ON intervention.id_incident = incident.id_incident
                          ORDER BY intervention.start_datetime_intervention DESC");
$reponse->execute();
$interventions = array();
while ($donnees = $reponse->fetch()) {
    $new_intervention = new Intervention($donnees["id_intervention"],
                                         $donnees["start_datetime_intervention"],
                                         $donnees["end_datetime_intervention"],
                                         $donnees["id_incident"],
                                         $donnees["name_incident"]);
    array_push($interventions, $new_intervention);
}
?>
<h1>Liste des interventions</h1>
<p><a href="<?php echo($_SESSION["url"]."/pages/add/add_intervention.php"); ?>">Ajouter une intervention</a></p>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == 0) {
        ?>
        <p>L'intervention a bien été ajoutée</p>
        <?php
    }
}
?>
<table>
    <tr>
        <th>Nom de l'incident</th>
        <th>Date de début</th>
        <th>Date de fin</th>
        <th>Actions</th>
    </tr>
    <?php
    foreach($interventions as $intervention) {
        ?>
        <tr>
            <td><?php echo htmlspecialchars($intervention->name_incident); ?></td>
            <td><?php echo htmlspecialchars($intervention->start_datetime); ?></td>
            <td><?php echo htmlspecialchars($intervention->end_datetime); ?></td>
            <td>
                <a href="<?php echo htmlspecialchars($_SESSION["url"]."/pages/single/single_intervention.php?id=".$intervention->id); ?>">Modifier</a>
                <a href="<?php echo htmlspecialchars($_SESSION["url"]."/scripts/remove/remove_intervention.php?id=".$intervention->id); ?>">Supprimer</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>
