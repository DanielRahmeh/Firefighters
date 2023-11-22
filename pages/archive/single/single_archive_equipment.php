<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/equipment.php");
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/archive/many/many_archive_equipment.php"); ?>">Retour</a></p>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM equipment_archive
                        INNER JOIN equipment_type ON equipment_archive.id_equipment_type = equipment_type.id_equipment_type
                        WHERE equipment_archive.id_equipment = ?");

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
?>
<h1>Données <?php echo($equipment->model_equipment); ?> immatriculé <?php echo($equipment->registration_equipment); ?></h1>
<img src="<?php echo($equipment->picture_equipment); ?>" alt="">
<p>Type d'équipment : <?php echo($equipment->name_equipment_type); ?></p>
<p>Modèle : <?php echo($equipment->model_equipment); ?></p>
<p>Immatriculation : <?php echo($equipment->registration_equipment); ?></p>
<p>Date d'achat : <?php echo($equipment->puchrase_date_equipment); ?></p>
<p>Date de fin de vie : <?php echo($equipment->endlife_date_equipment); ?></p>