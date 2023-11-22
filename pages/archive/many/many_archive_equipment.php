<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/equipment.php");


$reponse = $bdd->prepare("SELECT * 
                        FROM equipment_archive
                        INNER JOIN equipment_type ON equipment_archive.id_equipment_type = equipment_type.id_equipment_type");
$reponse->execute();
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
<table>
    <tr>
        <th>Type</th>
        <th>Modèle</th>
        <th>Immatriculation</th>
        <th>Date d'achat</th>
        <th>Plus</th>
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
            <td><a href=<?php echo($_SESSION["url"]."/pages/archive/single/single_archive_equipment.php?id=".$equipment->id); ?>>Details</a></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>