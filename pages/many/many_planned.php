<?php
include($_SERVER['DOCUMENT_ROOT']."/Firefighters/pages/header.php");
require ($_SERVER['DOCUMENT_ROOT']."/Firefighters/class/planned.php");
?>
<h1>Gestion des diponibiltés</h1>
<?php
if(isset($_GET["error"])) {
    switch ($_GET["error"]) {
        case -1:
            ?>
            <p>Erreur lors de l'ajout de la disponibilté</p>
            <?php
            break;
        case 0:
            ?>
            <p>La disponibilité a bien été ajouté</p>
            <?php
            break;
    }
}
?>
<h3>Ajouter une disponibilté</h3>
<form method="post" action="<?php echo($_SESSION["url"]."/scripts/insert/insert_planned.php?id=".$_SESSION["id_user"]); ?>">
    <p>Date <input type="date" name="date" required></p>
    <p>Heure du début <select name="start_hour" id="start_hour" onchange="updateEndTime()">
    <?php 
    for($i = 0; $i < 24; $i++) { 
        ?>
        <option value="<?php echo($i); ?>"><?php echo($i); ?></option>
        <?php
    } 
    ?> 
    </select></p>
    <p>Heure de fin <select name="end_hour" id="end_hour">
    <?php 
    for($i = 1; $i <= 24; $i++) { 
        if ($i == 24)
        {
            ?>
            <option value="<?php echo($i); ?>">Minuit</option>
            <?php
        }
        else {
        ?>
            <option value="<?php echo($i); ?>"><?php echo($i); ?></option>
        <?php
        }
    }
    ?> 
    </select></p>
    <p><input type="submit" value="Ajouter"></p>
</form>

<h3>Liste des disponibilités</h3>
<?php
$reponse = $bdd->prepare("SELECT * 
                        FROM planned
                        WHERE id_user = ?
                        ORDER BY date_planned DESC, hour_planned");
$reponse->execute([$_SESSION["id_user"]]);

$plannedsByDate = array();
while ($donnees = $reponse->fetch()) {
    $new_planned = new Planned($donnees["id_schedule"],
                                $donnees["date_planned"],
                                $donnees["hour_planned"]);

    if (!isset($plannedsByDate[$new_planned->date])) {
        $plannedsByDate[$new_planned->date] = array();
    }
    $plannedsByDate[$new_planned->date][] = $new_planned;
}
?>

<ul>
<?php foreach ($plannedsByDate as $date => $planneds) : ?>
    <li>
        <?php echo htmlspecialchars($date); ?>
        <ul>
            <?php 
            $last_hour = null;
            $last_id_schedule = null;
            $range_start = null;

            foreach ($planneds as $planned) {
                if ($last_hour !== null && ($planned->hour != $last_hour + 1 || $planned->id != $last_id_schedule)) {
                    echo '<li>' . htmlspecialchars($range_start) . 'h à ' . htmlspecialchars($last_hour + 1) . 'h - ' . ($last_id_schedule == 1 ? 'Disponible' : 'Intervention') . '</li>';
                    $range_start = $planned->hour;
                }

                if ($range_start === null) {
                    $range_start = $planned->hour;
                }

                $last_hour = $planned->hour;
                $last_id_schedule = $planned->id;
            }
            
            if ($range_start !== null) {
                echo '<li>' . htmlspecialchars($range_start) . 'h à ' . htmlspecialchars($last_hour + 1) . 'h - ' . ($last_id_schedule == 1 ? 'Disponible' : 'Intervention') . '</li>';
            }
            ?>
        </ul>
    </li>
<?php endforeach; ?>
</ul>




<script>
function updateEndTime() {
    var startHourSelect = document.getElementById('start_hour');
    var endHourSelect = document.getElementById('end_hour');
    var selectedStartHour = parseInt(startHourSelect.value);

    endHourSelect.innerHTML = '';

    for (var i = selectedStartHour + 1; i <= 24; i++) {
        var option = document.createElement('option');
        option.value = i;
        if ( i == 24) {
            option.textContent = "Minuit";  
        }
        else {
            option.textContent = i;
        }
        endHourSelect.appendChild(option);
    }
}
</script>