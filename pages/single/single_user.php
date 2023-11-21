<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/user.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/competence.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/training.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/certification.php");
?>
<p><a href="<?php echo($_SESSION["url"]."/pages/many/many_user.php"); ?>">Retour</a></p>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM user
                        INNER JOIN user_role ON user.id_user_role = user_role.id_user_role
                        WHERE user.id_user = ?");
$reponse->execute([$_GET["id"]]);
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
}
?>
<h1>Profil de <?php echo($user->first_name); ?> <?php echo($user->last_name);?> </h1>
<h2><?php echo($user->name_user_role); ?></h2>
<?php
if(isset($_GET["error"])) {
    switch ($_GET["error"]) {
        case -1:
            ?>
            <p>Erreur lors de la modification du profil</p>
            <?php
            break;
        case 0:
            ?>
            <p>La profil a bien été modifié</p>
            <?php
            break;
    }
}
?>
<h3>Information personnelles</h3>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/update/update_user.php?id=".$_GET["id"]); ?>">
    <p>Prénom <input type="text" name="first_name" value="<?php echo($user->first_name); ?>" required></p>
    <p>Nom <input type="text" name="last_name" value="<?php echo($user->last_name); ?>" required></p>
    <p>Téléphone <input type="text" name="phone" value="<?php echo($user->phone); ?>" required></p>
    <p>Adresse <input type="text" name="address" value="<?php echo($user->address); ?>" required></p>
    <p>Mail <input type="text" name="mail" value="<?php echo($user->mail); ?>" required></p>
    <p>Date de début <input type="date" name="start_date" value="<?php echo($user->start_date); ?>" required></p>
    <p>Date de fin  <input type="date" name="end_date" value="<?php echo($user->end_date); ?>"></p>
    <p><input type="submit" value="Modifier"></p>
</form>

<h3>Compétences</h3>
<?php
if(isset($_GET["error_competence"])) {
    switch ($_GET["error_competence"]) {
        case -1:
            ?>
            <p>La compétence a bien été supprimé</p>
            <?php
            break;
        case 0:
            ?>
            <p>La compétence a bien été ajouté</p>
            <?php
            break;
        case 1:
            ?>
            <p>La compétence avait déja été ajouté</p>
            <?php
            break;
    }
}
?>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM competence");
$reponse->execute();
$competences = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $new_competence = new Competence($donnees["id_competence"],
                            $donnees["name_competence"]);
    $competences[$i] = $new_competence;
    $i++;
}
?>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_user_competence.php?id_user=".$user->id); ?>">
    <select name="id_competence">
        <?php
        foreach($competences as $competence) {
            ?>
             <option value="<?php echo($competence->id) ?>"><?php echo($competence->name); ?></option>
            <?php
        }
        ?>
    </select>
    <p><input type="submit" value="Ajouter"></p>
</form>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM competence
                        INNER JOIN qualified ON qualified.id_competence = competence.id_competence
                        WHERE qualified.id_user = ?");
$reponse->execute([$_GET["id"]]);
$qualified = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $qualified[$i]["id_competence"] = $donnees["id_competence"];
    $qualified[$i]["id_user"] = $donnees["id_user"];
    $qualified[$i]["name_competence"] = $donnees["name_competence"];
    $i++;
}
?>
<ul>
    <?php
    foreach($qualified as $qualification) {
        ?>
        <li>
            <?php echo($qualification["name_competence"]); ?>
            <a href="<?php echo($_SESSION["url"]."/scripts/remove/remove_user_competence.php?id_user=".$user->id."&id_competence=".$qualification["id_competence"]); ?>">Supprimer</a>
        </li>
        <?php
    }
    ?>
</ul>

<h3>Formations</h3>
<?php
if(isset($_GET["error_training"])) {
    switch ($_GET["error_training"]) {
        case -1:
            ?>
            <p>La formation a bien été supprimé</p>
            <?php
            break;
        case 0:
            ?>
            <p>La formation a bien été ajouté</p>
            <?php
            break;
        case 1:
            ?>
            <p>La formation avait déja été ajouté</p>
            <?php
            break;
    }
}
?>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM training");
$reponse->execute();
$trainings = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $new_training = new Training($donnees["id_training"],
                                    $donnees["name_training"],
                                    $donnees["duration_training"]);
$trainings[$i] = $new_training;
$i++;
}
?>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_user_training.php"); ?>">
    <input type="hidden" name="id_user" value="<?php echo($user->id); ?>">
    <select name="id_training">
        <?php
        foreach($trainings as $training) {
            ?>
            <option value="<?php echo($training->id) ?>"><?php echo($training->name); ?></option>
            <?php
        }
        ?>
    </select>
    <p>Date de début <input type="date" name="start_date"></p>
    <p>Date de fin <input type="date" name="end_date"></p>
    <p><input type="submit" value="Ajouter"></p>
</form>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM training
                        INNER JOIN trained ON trained.id_training = training.id_training
                        WHERE trained.id_user = ?");
$reponse->execute([$_GET["id"]]);
$trained = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $trained[$i]["id_training"] = $donnees["id_training"];
    $trained[$i]["id_user"] = $donnees["id_user"];
    $trained[$i]["name_training"] = $donnees["name_training"];
    $trained[$i]["start_date_trained"] = $donnees["start_date_trained"];
    $trained[$i]["end_date_trained"] = $donnees["end_date_trained"];
    $i++;
}
?>
<ul>
    <?php
    foreach($trained as $train) {
        ?>
        <li>
            <?php echo($train["name_training"]); ?>
            <?php echo($train["start_date_trained"]); ?> -> 
            <?php echo($train["end_date_trained"]); ?>
            <a href="<?php echo($_SESSION["url"]."/scripts/remove/remove_user_training.php?id_user=".$user->id."&id_training=".$train["id_training"]); ?>">Supprimer</a>
        </li>
        <?php
    }
    ?>
</ul>

<h3>Certifications</h3>
<?php
if(isset($_GET["error_certification"])) {
    switch ($_GET["error_certification"]) {
        case -1:
            ?>
            <p>La certification a bien été supprimé</p>
            <?php
            break;
        case 0:
            ?>
            <p>La certification a bien été ajouté</p>
            <?php
            break;
        case 1:
            ?>
            <p>La certification avait déja été ajouté</p>
            <?php
            break;
    }
}
?>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM certification");
$reponse->execute();
$certifications = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $new_certification = new Certification($donnees["id_certification"],
                                    $donnees["name_certification"]);
$certifications[$i] = $new_certification;
$i++;
}
?>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_user_certification.php"); ?>">
    <input type="hidden" name="id_user" value="<?php echo($user->id); ?>">
    <select name="id_certification">
        <?php
        foreach($certifications as $certification) {
            ?>
            <option value="<?php echo($certification->id) ?>"><?php echo($certification->name); ?></option>
            <?php
        }
        ?>
    </select>
    <p>Date d'obtention' <input type="date" name="date"></p>
    <p><input type="submit" value="Ajouter"></p>
</form>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM certification
                        INNER JOIN obtained ON obtained.id_certification = certification.id_certification
                        WHERE obtained.id_user = ?");
$reponse->execute([$_GET["id"]]);
$obtained = array();
$i = 0;
while ($donnees = $reponse->fetch()) {
    $obtained[$i]["id_certification"] = $donnees["id_certification"];
    $obtained[$i]["id_user"] = $donnees["id_user"];
    $obtained[$i]["name_certification"] = $donnees["name_certification"];
    $obtained[$i]["date_obtained"] = $donnees["date_obtained"];
    $i++;
}
?>
<ul>
    <?php
    foreach($obtained as $obtain) {
        ?>
        <li>
            <?php echo($obtain["name_certification"]); ?>
            <?php echo($obtain["date_obtained"]); ?>
            <a href="<?php echo($_SESSION["url"]."/scripts/remove/remove_user_certification.php?id_user=".$user->id."&id_certification=".$obtain["id_certification"]); ?>">Supprimer</a>
        </li>
        <?php
    }
    ?>
</ul>
<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/footer.php");
?>