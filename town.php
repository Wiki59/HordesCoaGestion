<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<?php include './template/header.php'; ?>
<body>
<?php
include './template/entete.php';
echo "<div id='content'>";
if (isset($_GET["town"])) {
    // Récupère la ville dans les arguments GET
    $town = $_GET["town"];
    if (is_file("town/" . $town . "/citizen.json")) {
        $citizens = file_get_contents("town/" . $town . "/citizen.json");
        // Les données de la ville sont stocké dans $array
        $array = json_decode($citizens, true);
        $pseudo = $_SESSION["user"]["pseudo"];
        echo "<h1>$town</h1>";
        echo "<div>";
        echo "<input type='hidden' value='$town' id='town'/>";
        // Si le joueur est déjà inscrit ou pas
        if (array_key_exists($pseudo, $array["citizen"])) {
            echo "<input class='buttonStyle1 playerControl' type='button' value='Se retirer' id='mvC'/>";
            echo "<input class='buttonStyle1' type='button' value='Mettre à jour' id='majC'/>";
        } else {
            echo "<input class='buttonStyle1 playerControl' type='button' value='S&apos;ajouter' id='addC'/>";
        }
        echo "</div>";
        // TODO Une box d'information, sera géré plus tard, elle permettra de modifier un "tableau noir" propre à la ville
        echo "<div id='boxInfo'></div>";
        echo "<b>Il y a " . sizeof($array['citizen']) . " citoyen(s)</b>";
        echo "<br/><br/>";
        // Créé la table avec un premier tr
        echo "<form action='requete/majCitizen.php' method='post'>";
        echo "<input type='hidden' name='town' value='" . $town . "'>";
        echo "<table id='citoyenTable'>
        <tr><th>Pseudo</th>
		<th><img src='ressource/kniff.gif' title='Dernier pouvoir' width='16' height='16'></th>
		<th>Job</th>
		<th><img src='ressource/h_guard.gif' title='Point de défense' width='16' height='16'></th>
		<th><img src='ressource/r_ruine.gif' title='Niveau d&apos;expertise pour les ruines' width='16' height='16'></th>
		<th><img src='ressource/arma.gif' title='Témoins de l&apos;armageddon' width='16' height='16'></th>
		<th><img src='ressource/r_ginfec.gif' title='Grande infection' width='16' height='16'></th>
		<th><img src='ressource/apag.gif' title='Appareil Photo de l&apos;Avant Guerre' width='16' height='16'></th>
		<th><img src='ressource/h_calim.gif' title='Sauvetage' width='16' height='16'></th>
		<th><img src='ressource/rdh.gif' title='Retour du héros' width='16' height='16'></th>
		<th><img src='ressource/small_wrestle.gif' title='Uppercut sauvage' width='16' height='16'></th>
		<th><img src='ressource/r_share.gif' title='Camaraderie' width='16' height='16'></th>
		<th><img src='ressource/small_pa.gif' title='Second souffle' width='16' height='16'></th>
		<th><img src='ressource/h_death.gif' title='Trompe la mort' width='16' height='16'></th>
		<th><img src='ressource/r_cmplst.gif' title='Campeur pro' width='16' height='16'></th>
		<th><img src='ressource/portiere.gif' title='Veilleur pro' width='16' height='16'></th>
		<th><img src='ressource/h_ban.gif' title='Volontaire si besoin d&apos;un banni' width='16' height='16'></th>
		<th><img src='ressource/small_ghoul.gif' title='Volontaire si besoin d&apos;une goule' width='16' height='16'></th>
		<th><img src='ressource/jhLeft.gif' title='Jours heros restans' width='16' height='16'></th>
		<th>Rôle</th>
		<th>Moyen de contact</tr>";
        // Affiche la liste des citoyen
        foreach ($array['citizen'] as $pseudo => $citizen) {
            $toEcho = "";
            // Si le pseudo du citoyen correspond à l'utilisateur
            if ($pseudo === $_SESSION["user"]["pseudo"]) {
                // Affiche une ligne spécial modifiable par l'utilisateur avec un form
                $toEcho .= "<tr id='citizenRow' style='background-color: rgb(220, 220, 220); box-shadow: 4px 0px 2px -2px green, -4px 0px 2px -2px green;'>";
                $toEcho .= "<td><b>$pseudo</b>";
                $toEcho .= ($citizen["hero"]) ? "<img src='ressource/star.gif' title='Heros' width='16' height='16'>" : "";
                $toEcho .= ($pseudo === "antonii") ? "<img src='ressource/vodka.gif' title='Cyka' width='16' height='16'>" : "";
                $toEcho .= "</td>";
                $toEcho .= "<td id='jhCumulDiv'><div id='jhCumulDivString'>" . $citizen["lastPow"] . "</div>";
                $toEcho .= "<div id='jhCumulDivNumber' hidden='hidden'><input min='0' max='1000' type='number' name='jhCumul' value='" . $citizen["jhCumul"] . "'/></div></td>";
                $toEcho .= "<td>" . jobToImage($citizen["job"]) . "</td>";
                $toEcho .= "<td><input type='number' min='2' max='6' name='pdc' title='Point de défense' value='" . $citizen["pdc"] . "'/></td>";
                $toEcho .= "<td><input type='number' min='0' max='5' name='nvRuin' title='Niveau d&apos;expertise pour les ruines' value='" . $citizen["nvRuin"] . "'/></td>";
                $toEcho .= "<td><input type='checkbox' title='Témoins de l&apos;armageddon' name='arma'"
                    . ($citizen["arma"] ? "checked" : "")
                    . "/></td>";
                $toEcho .= "<td><input type='checkbox' title='Grande infection' name='ginfec'"
                    . ($citizen["ginfec"] ? "checked" : "")
                    . "/></td>";
                $toEcho .= "<td><input type='number' min='0' max='3' title='Appareil Photo de l&apos;Avant Guerre' name='apag' value='" . $citizen["apag"] . "'/></td>";
                $toEcho .= "<td><input type='checkbox' title='Sauvetage' name='rescue'"
                    . ($citizen["rescue"] ? "checked" : "")
                    . "/></td>";
                $toEcho .= "<td><input type='checkbox' title='Retour du héros' name='rdh'"
                    . ($citizen["rdh"] ? "checked" : "")
                    . "/></td>";
                $toEcho .= "<td><input type='checkbox' title='Uppercut sauvage' name='upper'"
                    . ($citizen["upper"] ? "checked" : "")
                    . "/></td>";
                $toEcho .= "<td><input type='checkbox' title='Camaraderie' name='solder'"
                    . ($citizen["solder"] ? "checked" : "")
                    . "/></td>";
                $toEcho .= "<td><input type='checkbox' title='Second souffle' name='ss'"
                    . ($citizen["ss"] ? "checked" : "")
                    . "/></td>";
                //$toEcho .= "<td><input type='number' min='0' max='4' name='trouvaille' value='" . $citizen["trouvaille"] . "'/></td>";
                $toEcho .= "<td><input type='checkbox' title='Trompe la mort' name='deathtrap'"
                    . ($citizen["deathtrap"] ? "checked" : "")
                    . "/></td>";
                $toEcho .= "<td><input type='checkbox' title='Campeur pro' name='campPro'"
                    . ($citizen["campPro"] ? "checked" : "")
                    . "/></td>";
                $toEcho .= "<td><input type='checkbox' title='Veilleur pro' name='veilPro'"
                    . ($citizen["veilPro"] ? "checked" : "")
                    . "/></td>";
                $toEcho .= "<td><input type='checkbox' title='Volontaire si besoin d&apos;un banni' name='forBan'"
                    . ($citizen["forBan"] ? "checked" : "")
                    . "/></td>";
                $toEcho .= "<td><input type='checkbox' title='Volontaire si besoin d&apos;une goule' name='forGoul'"
                    . ($citizen["forGoul"] ? "checked" : "")
                    . "/></td>";
                $toEcho .= "<td><input type='number' min='0' max='9999' title='Jours heros restans' name='jhLeft' value='" . $citizen["jhLeft"] . "'/></td>";
                $toEcho .= "<td><input type='text' maxlength='100' title='Votre rôle concernant la ville' value='" . $citizen["role"] . "'/></td>";
                $toEcho .= "<td><input type='text' maxlength='40' title='Moyen de communication extérieur (tel, skype, fax...)' value='" . $citizen["com"] . "'/></td>";
                $toEcho .= "</tr><input type='submit' hidden='hidden' value='Modifer'/>";
                echo $toEcho;
            } else {
                // Affiche une ligne non modifiable contenant les infos du joueur en question
                $toEcho .= "<tr class='citizenRow'><td>$pseudo";
                $toEcho .= ($citizen["hero"]) ? "<img src='ressource/star.gif' title='Heros' width='16' height='16'>" : "";
                $toEcho .= ($pseudo === "antonii") ? "<img src='ressource/vodka.gif' title='Cyka' width='16' height='16'>" : "";
                $toEcho .= "</td>";
                $toEcho .= "<td>" . $citizen["lastPow"] . "</td>";
                $toEcho .= "<td>" . jobToImage($citizen["job"]) . "</td>";
                $toEcho .= "<td>" . $citizen["pdc"] . "</td>";
                $toEcho .= "<td>" . $citizen["nvRuin"] . "</td>";
                $toEcho .= "<td>" . $citizen["arma"] . "</td>";
                $toEcho .= "<td>" . $citizen["ginfec"] . "</td>";
                $toEcho .= "<td>" . $citizen["apag"] . "</td>";
                $toEcho .= "<td>" . $citizen["rescue"] . "</td>";
                $toEcho .= "<td>" . $citizen["rdh"] . "</td>";
                $toEcho .= "<td>" . $citizen["upper"] . "</td>";
                $toEcho .= "<td>" . $citizen["solder"] . "</td>";
                $toEcho .= "<td>" . $citizen["ss"] . "</td>";
                //$toEcho .= "<td>" . $citizen["trouvaille"] . "</td>";
                $toEcho .= "<td>" . $citizen["deathtrap"] . "</td>";
                $toEcho .= "<td>" . $citizen["campPro"] . "</td>";
                $toEcho .= "<td>" . $citizen["veilPro"] . "</td>";
                $toEcho .= "<td>" . $citizen["forBan"] . "</td>";
                $toEcho .= "<td>" . $citizen["forGoul"] . "</td>";
                $toEcho .= "<td>" . $citizen["jhLeft"] . "</td>";
                $toEcho .= "<td>" . $citizen["com"] . "</td>";
                $toEcho .= "<td>" . $citizen["role"] . "</td>";
                $toEcho .= "</tr>";
                echo $toEcho;
            }
        }
        echo "</table></form>";
    } else {
        // Si la ville n'existe pas/plus
        echo "<h4>Ville introuvable</h4>";
    }
} else {
    echo "<h4>Nom de ville manquant à la requette</h4>";
}
echo "</div>";
?>
<script type="text/javascript" src="script/searcher.js"></script>
<script type="text/javascript" src="script/script.js"></script>
</body>
</html>

<?php
/**
 * @param $job Le nom de job
 * @return string Image correspondant au job
 */
function jobToImage($job)
{
    switch ($job) {
        case "collec":
            return "<img src='ressource/shovel.gif' title='Pelleteur' width='16' height='16'>";
        case "guardian":
            return "<img src='ressource/h_guard.gif' title='Portier' width='16' height='16'>";
        case "basic":
            return "<img src='ressource/citizen.gif' title='Civil' width='16' height='16'>";
        case "hunter":
            return "<img src='ressource/erm_book.gif' title='Scout' width='16' height='16'>";
        default:
            return $job;
    }
}

?>
