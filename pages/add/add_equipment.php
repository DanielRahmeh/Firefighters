<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/equipment.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/equipment_type.php");
?>
<a href="<?php echo($_SESSION["url"]."/pages/many/many_equipment.php"); ?>">Retour</a>
<h1>Ajouter un équipement</h1>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_equipment.php"); ?>">
    <?php
    $reponse = $bdd->prepare("SELECT * 
                            FROM equipment_type");
    $reponse->execute();
    $equipment_types = array();
    $i = 0;
    while ($donnees = $reponse->fetch()) {
        $new_equipment_type = new EquipmentType($donnees["id_equipment_type"],
                                $donnees["name_equipment_type"]);
        $equipment_types[$i] = $new_equipment_type;
        $i++;
    }
    ?>
    <p>Type <select name="id_equipment_type">
        <?php
        foreach($equipment_types as $equipment_type) {
            ?>
             <option value="<?php echo($equipment_type->id) ?>"><?php echo($equipment_type->name); ?></option>
            <?php
        }
        ?>
    </select></p>
    <p>Modèle <input type="text" name="model" required></p>
    <p>Immatriculation <input type="text" name="registration" required></p>
    <p>Date d'achat <input type="date" name="puchrase_date" required></p>
    <p>Date de fin de vie <input type="date" name="endlife_date"></p>
    <p><input type="submit" value="Ajouter"></p>
</form>