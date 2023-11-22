<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/equipment.php");
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/add/add_equipment.php"); ?>">Ajouter</a></p>
<p><a href="<?php echo($_SESSION["url"]."/scripts/archive/archive_equipment.php"); ?>">Archiver</a></p>
<?php
$reponse = $bdd->prepare("SELECT * 
                            FROM equipment_type");
$reponse->execute();
$equipments_type = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $equipments_type[$i]["id_equipment_type"] = $donnees["id_equipment_type"];
    $equipments_type[$i]["name_equipment_type"] = $donnees["name_equipment_type"];
    $i++;
}
?>
<form method="post" action="<?php echo($_SESSION["url"]."/pages/many/many_equipment.php"); ?>">
    <select name="id_equipment_type">
        <?php
        foreach($equipments_type as $equipment_type) {
            ?>
             <option value="<?php echo($equipment_type["id_equipment_type"]) ?>"><?php echo($equipment_type["name_equipment_type"]); ?></option>
            <?php
        }
        ?>
    </select>
    <p><input type="submit" value="Filtrer"></p>
</form>
<?php

if(isset($_POST["id_equipment_type"])) {
    ?>
    <form method="post" action="<?php echo($_SESSION["url"]."/pages/many/many_equipment.php"); ?>">
        <p><input type="submit" value="Renitialiser"></p>
    </form>
    <?php
    $reponse = $bdd->prepare("SELECT * 
                        FROM equipment 
                        INNER JOIN equipment_type ON equipment.id_equipment_type = equipment_type.id_equipment_type
                        WHERE equipment_type.id_equipment_type = ?");
    $reponse->execute([$_POST["id_equipment_type"]]);
}

else {
    $reponse = $bdd->prepare("SELECT * 
                            FROM equipment 
                            INNER JOIN equipment_type ON equipment.id_equipment_type = equipment_type.id_equipment_type");
    $reponse->execute();
}
$equipments = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $new_equipment = new Equipment($donnees["id_equipment"],
                        $donnees["model_equipment"],
                        $donnees["registration_equipment"],
                        $donnees["puchrase_date_equipment"],
                        $donnees["endlife_date_equipment"],
                        $donnees["picture_equipment"],
                        $donnees["id_equipment_type"],
                        $donnees["name_equipment_type"]);
    $equipments[$i] = $new_equipment;
    $i++;
}
?>

<?php
if(isset($_GET["error"])) {
    switch ($_GET["error"]) {
        case -1:
            ?>
            <p>Erreur lors de l'ajout de l'équipement</p>
            <?php
            break;
        case 0:
            ?>
            <p>L'équipement a bien été ajouté</p>
            <?php
            break;
    }
}
?>
<table>
    <tr>
        <th>Type</th>
        <th>Modèle</th>
        <th>Immatriculation</th>
        <th>Date d'achat</th>
        <th>Photo</th>
        <th>Modifier</th>
    </tr>
    <?php
    foreach($equipments as $equipment) {
        ?>
        <?php echo($equipment->picture_equipment); ?>
        <tr>
            <td><?php echo($equipment->name_equipment_type); ?></td>
            <td><?php echo($equipment->model_equipment); ?></td>
            <td><?php echo($equipment->registration_equipment); ?></td>
            <td><?php echo($equipment->puchrase_date_equipment); ?></td>
            <td><img src="<?php echo($equipment->picture_equipment); ?>" alt=""></td>
            <td><a href=<?php echo($_SESSION["url"]."/pages/single/single_equipment.php?id=".$equipment->id); ?>>Modifier</a></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>