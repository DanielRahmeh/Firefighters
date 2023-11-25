<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/alert.php");
?>
<h1>Liste des alertes</h1>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM alert
                        ORDER BY datetime_alert DESC");
$reponse->execute();
$alerts = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $new_alert= new Alert($donnees["id_alert"],
                            $donnees["phone_alert"],
                            $donnees["latitude_alert"],
                            $donnees["longtitude_alert"],
                            $donnees["datetime_alert"],
                            $donnees["description_alert"]);
    $alerts[$i] = $new_alert;
    $i++;
}
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/add/add_alert.php"); ?>">Ajouter</a></p>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == 0) {
        ?>
        <p>L'alerte a bien été ajouté</p>
        <?php
    }
}
?>
<table>
    <tr>
        <th>Date</th>
        <th>Téléphone</th>
        <th>Latitude</th>
        <th>Longtitude</th>
        <th>Plus</th>
    </tr>
    <?php
    foreach($alerts as $alert) {
        ?>
        <tr>
            <td><?php echo($alert->datetime); ?></td>
            <td><?php echo($alert->phone); ?></td>
            <td><?php echo($alert->latitude); ?></td>
            <td><?php echo($alert->longtitude); ?></td>
            <td><a href=<?php echo($_SESSION["url"]."/pages/single/single_alert.php?id=".$alert->id); ?>>Modifier</a></td>
            <td><a href=<?php echo($_SESSION["url"]."/scripts/remove/remove_alert.php?id=".$alert->id); ?>>Supprimer</a></td>
        </tr>
        <?php
    }
    ?>
</table>