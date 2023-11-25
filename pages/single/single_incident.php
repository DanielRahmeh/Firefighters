<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/incident.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/incident_type.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/alert.php");
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/many/many_incident.php"); ?>">Retour</a></p>
<?php
if (isset($_GET["id"])) {
    $reponse = $bdd->prepare("SELECT * 
                            FROM incident
                            INNER JOIN incident_type ON incident.id_incident_type = incident_type.id_incident_type
                            WHERE id_incident = ?");
    $reponse->execute([$_GET["id"]]);
    if ($donnees = $reponse->fetch()) {
        $incident = new Incident($donnees["id_incident"],
                                 $donnees["name_incident"],
                                 $donnees["description_incident"],
                                 $donnees["start_datetime_incident"],
                                 $donnees["end_datetime_incident"],
                                 $donnees["id_incident_type"],
                                 $donnees["name_incident_type"]);
    }
}
if (isset($_GET["error"])) {
    if ($_GET["error"] == 0) {
        ?>
        <p>L'incident a bien été modifié</p>
        <?php
    }
}
?>

<h1>Incident <?php echo htmlspecialchars($incident->name_incident_type); ?> : <?php echo htmlspecialchars($incident->name); ?></h1>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/update/update_incident.php?id=".htmlspecialchars($incident->id)); ?>">
    <p>Nom <input type="text" name="name" value="<?php echo htmlspecialchars($incident->name); ?>" required></p>
    <p>Description <textarea name="description" required><?php echo htmlspecialchars($incident->description); ?></textarea></p>
    <p>Date de début <input type="datetime-local" name="start_datetime" value="<?php echo htmlspecialchars($incident->start_datetime); ?>" required></p>
    <p>Date de fin <input type="datetime-local" name="end_datetime" value="<?php echo htmlspecialchars($incident->end_datetime); ?>"></p>
    <p><input type="submit" value="Modifier"></p>
</form>

<h3>Alertes</h3>
<?php
if(isset($_GET["error_alert"])) {
    switch ($_GET["error_alert"]) {
        case -1:
            ?>
            <p>L'alerte a bien été supprimé</p>
            <?php
            break;
        case 0:
            ?>
            <p>L'alerte a bien été ajouté</p>
            <?php
            break;
        case 1:
            ?>
            <p>L'alerte avait déja été ajouté</p>
            <?php
            break;
    }
}
?>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM alert");
$reponse->execute();
$alerts = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $alert = new Alert($donnees["id_alert"],
                        $donnees["phone_alert"],
                        $donnees["latitude_alert"],
                        $donnees["longtitude_alert"],
                        $donnees["datetime_alert"],
                        $donnees["description_alert"]);
    $alerts[$i] = $alert;
    $i++;
}
?>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_incident_alert.php?id=".$incident->id); ?>">
    <select name="id_alert">
        <?php
        foreach($alerts as $alert) {
            ?>
             <option value="<?php echo($alert->id) ?>"><?php echo($alert->datetime); ?> : <?php echo($alert->description); ?></option>
            <?php
        }
        ?>
    </select>
    <p><input type="submit" value="Ajouter"></p>
</form>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM alert
                        INNER JOIN alerted ON alerted.id_alert = alert.id_alert
                        WHERE alerted.id_incident = ?");
$reponse->execute([$_GET["id"]]);
$alerted = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $alerted[$i]["id_alert"] = $donnees["id_alert"];
    $alerted[$i]["id_incident"] = $donnees["id_incident"];
    $alerted[$i]["datetime"] = $donnees["datetime_alert"];
    $alerted[$i]["description"] = $donnees["description_alert"];
    $i++;
}
?>
<ul>
    <?php
    foreach($alerted as $single_alerted) {
        ?>
        <li>
            <?php echo($single_alerted["datetime"]); ?> : <?php echo($single_alerted["description"]); ?>
            <a href="<?php echo($_SESSION["url"]."/scripts/remove/remove_incident_alert.php?id_incident=".$incident->id."&id_alert=".$single_alerted["id_alert"]); ?>">Supprimer</a>
        </li>
        <?php
    }
    ?>
</ul>

<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>
