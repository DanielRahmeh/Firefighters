<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/intervention.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/user.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/equipment.php");

if (isset($_GET["id"])) {
    $reponse = $bdd->prepare("SELECT *
                              FROM intervention 
                              INNER JOIN incident ON intervention.id_incident = incident.id_incident
                              WHERE intervention.id_intervention = ?");
    $reponse->execute([$_GET["id"]]);
    if ($donnees = $reponse->fetch()) {
        $intervention = new Intervention($donnees["id_intervention"],
                                         $donnees["start_datetime_intervention"],
                                         $donnees["end_datetime_intervention"],
                                         $donnees["id_incident"],
                                         $donnees["name_incident"]);
    }
}

if (isset($_GET["error"])) {
    if ($_GET["error"] == 0) {
        ?>
        <p>L'intervention a bien été modifiée</p>
        <?php
    }
}
?>

<h1>Modifier l'intervention <?php echo htmlspecialchars($intervention->id); ?> : <?php echo htmlspecialchars($intervention->name_incident); ?></h1>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/update/update_intervention.php?id=".htmlspecialchars($intervention->id)); ?>">
    <p>Date de début <input type="datetime-local" name="start_datetime" value="<?php echo htmlspecialchars($intervention->start_datetime); ?>" required></p>
    <p>Date de fin <input type="datetime-local" name="end_datetime" value="<?php echo htmlspecialchars($intervention->end_datetime); ?>"></p>
    <p><input type="submit" value="Modifier"></p>
</form>

<h3>Intervenants</h3>
<?php
if(isset($_GET["error_user"])) {
    switch ($_GET["error_user"]) {
        case -1:
            ?>
            <p>L'intervenant a bien été retiré</p>
            <?php
            break;
        case 0:
            ?>
            <p>L'intervenant a bien été ajouté</p>
            <?php
            break;
        case 1:
            ?>
            <p>L'intervenant avait déja été ajouté</p>
            <?php
            break;
    }
}
?>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM user
                        INNER JOIN user_role ON user_role.id_user_role = user.id_user_role
                        WHERE user.id_user_role = 5 OR user.id_user_role = 6");
$reponse->execute();
$users = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $user = new User($donnees["id_user"],
                    $donnees["firstname_user"],
                    $donnees["lastname_user"],
                    $donnees["phone_user"],
                    $donnees["address_user"],
                    $donnees["mail_user"],
                    $donnees["password_user"],
                    $donnees["start_date_user"],
                    $donnees["end_date_user"],
                    $donnees["id_user_role"],
                    $donnees["name_user_role"]);
    $users[$i] = $user;
    $i++;
}
?>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_intervention_user.php?id=".$intervention->id); ?>">
    <select name="id_user">
        <?php
        foreach($users as $user) {
            ?>
             <option value="<?php echo($user->id) ?>"><?php echo($user->name_user_role); ?> : <?php echo($user->first_name); ?> <?php echo($user->last_name); ?></option>
            <?php
        }
        ?>
    </select>
    <p><input type="submit" value="Ajouter"></p>
</form>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM user
                        INNER JOIN intervened ON intervened.id_user = user.id_user
                        INNER JOIN user_role ON user_role.id_user_role = user.id_user_role
                        WHERE intervened.id_intervention = ?");
$reponse->execute([$_GET["id"]]);
$intervened = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $intervened[$i]["id_intervention"] = $donnees["id_intervention"];
    $intervened[$i]["id_user"] = $donnees["id_user"];
    $intervened[$i]["firstname"] = $donnees["firstname_user"];
    $intervened[$i]["lastname"] = $donnees["lastname_user"];
    $intervened[$i]["role"] = $donnees["name_user_role"];
    $i++;
}
?>
<ul>
    <?php
    foreach($intervened as $single_intervened) {
        ?>
        <li>
            <?php echo($single_intervened["role"]); ?> : <?php echo($single_intervened["firstname"]); ?> <?php echo($single_intervened["lastname"]); ?>
            <a href="<?php echo($_SESSION["url"]."/scripts/remove/remove_intervention_user.php?id_intervention=".$intervention->id."&id_user=".$single_intervened["id_user"]); ?>">Supprimer</a>
        </li>
        <?php
    }
    ?>
</ul>

<h3>Equipements</h3>
<?php
if(isset($_GET["error_equipment"])) {
    switch ($_GET["error_equipment"]) {
        case -1:
            ?>
            <p>L'équipement a bien été retiré</p>
            <?php
            break;
        case 0:
            ?>
            <p>L'équipement a bien été ajouté</p>
            <?php
            break;
        case 1:
            ?>
            <p>L'équipement avait déja été ajouté</p>
            <?php
            break;
    }
}
?>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM equipment
                        INNER JOIN equipment_type ON equipment_type.id_equipment_type = equipment.id_equipment_type");
$reponse->execute();
$equipments = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $equipment = new Equipment($donnees["id_equipment"],
                            $donnees["model_equipment"],
                            $donnees["registration_equipment"],
                            $donnees["puchrase_date_equipment"],
                            $donnees["endlife_date_equipment"],
                            $donnees["picture_equipment"],
                            $donnees["id_equipment_type"],
                            $donnees["name_equipment_type"]);
    $equipments[$i] = $equipment;
    $i++;
}
?>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_intervention_equipment.php?id=".$intervention->id); ?>">
    <select name="id_equipment">
        <?php
        foreach($equipments as $equipment) {
            ?>
             <option value="<?php echo($equipment->id) ?>"><?php echo($equipment->name_equipment_type); ?> : <?php echo($equipment->model_equipment); ?> <?php echo($equipment->registration_equipment); ?></option>
            <?php
        }
        ?>
    </select>
    <p><input type="submit" value="Ajouter"></p>
</form>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM equipment
                        INNER JOIN equiped ON equiped.id_equipment = equipment.id_equipment
                        INNER JOIN equipment_type ON equipment_type.id_equipment_type = equipment.id_equipment_type
                        WHERE equiped.id_intervention = ?");
$reponse->execute([$_GET["id"]]);
$equiped = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $equiped[$i]["id_intervention"] = $donnees["id_intervention"];
    $equiped[$i]["id_equipment"] = $donnees["id_equipment"];
    $equiped[$i]["type"] = $donnees["name_equipment_type"];
    $equiped[$i]["model"] = $donnees["model_equipment"];
    $equiped[$i]["registration"] = $donnees["registration_equipment"];
    $i++;
}
?>
<ul>
    <?php
    foreach($equiped as $single_equiped) {
        ?>
        <li>
            <?php echo($single_equiped["type"]); ?> : <?php echo($single_equiped["model"]); ?> <?php echo($single_equiped["registration"]); ?>
            <a href="<?php echo($_SESSION["url"]."/scripts/remove/remove_intervention_equipment.php?id_intervention=".$intervention->id."&id_equipment=".$single_equiped["id_equipment"]); ?>">Supprimer</a>
        </li>
        <?php
    }
    ?>
</ul>



<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>
