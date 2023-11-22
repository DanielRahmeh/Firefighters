<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/equipment.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/servicing.php");

if ($_GET["id"]) {
    $reponse = $bdd->prepare("SELECT * 
                            FROM equipment 
                            INNER JOIN equipment_type ON equipment.id_equipment_type = equipment_type.id_equipment_type
                            WHERE equipment.id_equipment = ?");
    $reponse->execute([$_GET["id"]]);
    while ($donnees = $reponse->fetch()) {
        $equipment = new Equipment($donnees["id_equipment"],
                        $donnees["model_equipment"],
                        $donnees["registration_equipment"],
                        $donnees["puchrase_date_equipment"],
                        $donnees["endlife_date_equipment"],
                        $donnees["picture_equipment"],
                        $donnees["id_equipment_type"],
                        $donnees["name_equipment_type"]);
    }
}
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/many/many_equipment.php"); ?>">Retour</a></p>
<h1>Données <?php echo($equipment->model_equipment); ?> immatriculé <?php echo($equipment->registration_equipment); ?></h1>
<img src="<?php echo($equipment->picture_equipment); ?>" alt="">
<?php
if(isset($_GET["error"])) {
    switch ($_GET["error"]) {
        case -1:
            ?>
            <p>Erreur lors de la modification de l'équipement</p>
            <?php
            break;
        case 0:
            ?>
            <p>L'équipement a bien été modifié</p>
            <?php
            break;
    }
}
?>
<h3>Donnée générales</h3>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/update/update_equipment.php?id=".$_GET["id"]); ?>">
    <p>Modèle <input type="text" name="model" value="<?php echo($equipment->model_equipment); ?>" required></p>
    <p>Immatriculation <input type="text" name="registration" value="<?php echo($equipment->registration_equipment); ?>" required></p>
    <p>Date d'achat <input type="date" name="puchrase_date" value="<?php echo($equipment->puchrase_date_equipment); ?>" required></p>
    <p>Date de fin de vie <input type="date" name="endlife_date" value="<?php echo($equipment->endlife_date_equipment); ?>"></p>
    <p><input type="submit" value="Modifier"></p>
</form>
<h3>Service de maintenance</h3>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_servicing.php?id=".$_GET["id"]); ?>">
    <p>Date de maintenance <input type="date" name="date" required></p>
    <p>Description <textarea  name="description"></textarea></p>
    <p><input type="submit" value="Ajouter"></p>
</form>
<?php
if ($_GET["id"]) {
    $reponse = $bdd->prepare("SELECT * 
                            FROM servicing 
                            INNER JOIN equipment ON equipment.id_equipment = servicing.id_equipment
                            WHERE servicing.id_equipment = ?
                            ORDER BY servicing.date_servicing DESC");
    $reponse->execute([$_GET["id"]]);
    $servicings = array();
    $i = 0;
    while ($donnees = $reponse->fetch()) {
        $servicing = new Servicing($donnees["id_servicing"],
                                    $donnees["date_servicing"],
                                    $donnees["description_servicing"]);
        $servicings[$i] = $servicing;
        $i++;
    }
    foreach ($servicings as $servicing) {
        ?>
        <p><?php echo($servicing->date); ?></p>
        <p><?php echo($servicing->description); ?></p>
        <?php
    }
}
?>