<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> <html>
    <head>
        <?php include './template/header.php'; ?>
    </head>
    <body>
        <?php
        include './template/entete.php';
        echo "<div id='content'>";
        if (isset($_GET["town"])) {
            $town = $_GET["town"];
            echo "<h1>$town</h1>";
            echo "<div>";
            echo "<input type='hidden' value='$town' id='town'/>";
            echo "<input class='buttonStyle1' type='button' value='S&apos;ajouter' id='addC'/>";
            echo "<input class='buttonStyle1' type='button' value='Mettre à jour' id='majC'/>";
            echo "</div>";
            echo "<div id='boxInfo'></div>";
            if (is_file("town/" . $town . "/citizen.json")) {
                $citizens = file_get_contents("town/" . $town . "/citizen.json");
                $array = json_decode($citizens, true);
                echo "<table>";
                echo "<tr><th>Pseudo</th>
			<th><img src='ressource/kniff.gif' alt='Dernier pouvoir' width='16' height='16'></th>
			<th>Job</th>
			<th><img src='ressource/h_guard.gif' alt='Point de défense' width='16' height='16'></th>
			<th><img src='ressource/r_ruine.gif' alt='Niveau d'expertise pour les ruines' width='16' height='16'></th>
			<th><img src='ressource/arma.gif' alt='Témoins de l'armageddon width='16' height='16'></th>
			<th><img src='ressource/r_ginfec.gif' alt='Grande infection' width='16' height='16'></th>
			<th><img src='ressource/apag.gif' alt='Appareil Photo de l'Avant Guerre width='16' height='16'></th>
			<th><img src='ressource/h_calim.gif' alt='Sauvetage' width='16' height='16'></th>
			<th><img src='ressource/rdh.gif' alt='Retour du héros' width='16' height='16'></th>
			<th><img src='ressource/small_wrestle.gif' alt='Uppercut sauvage' width='16' height='16'></th>
			<th><img src='ressource/r_share.gif' alt='Camaraderie' width='16' height='16'></th>
			<th><img src='ressource/small_pa.gif' alt='Second souffle' width='16' height='16'></th>
			<th><img src='ressource/item_chest_hero.gif' alt='Niveau de trouvaille (Débrouillardise, Jolie trouvaille, Prévoyant, Avantage armageddon)' width='16' height='16'></th>
			<th><img src='ressource/h_death.gif' alt='Trompe la mort' width='16' height='16'></th>
			<th><img src='ressource/r_cmplst.gif' alt='Campeur pro' width='16' height='16'></th>
			<th><img src='ressource/portiere.gif' alt='Veilleur pro' width='16' height='16'></th>
			<th><img src='ressource/h_ban.gif' alt='Volontaire si besoin d'un banni' width='16' height='16'></th>
			<th><img src='ressource/small_ghoul.gif' alt='Volontaire si besoin d'une goule width='16' height='16'></th>
			<th><img src='ressource/jhLeft.gif' alt='Jours heros restans' width='16' height='16'></th>
			<th>Rôle</th>
			<th>Moyen de contact</tr>";
                foreach ($array['citizen'] as $pseudo => $citizen) {
                    if ($pseudo === $_SESSION["user"]["pseudo"]) {
                        $toEcho .= "<form action='requete/majCitizen.php' method='POST'>";
                        $toEcho .= "<tr><td><b>$pseudo ok</b>";
                        $toEcho .= ($citizen["hero"]) ? "<img src='ressource/star.gif' alt='Heros' width='16' height='16'>" : "";
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
                        $toEcho .= "<td>" . $citizen["trouvaille"] . "</td>";
                        $toEcho .= "<td>" . $citizen["deathtrap"] . "</td>";
                        $toEcho .= "<td>" . $citizen["campPro"] . "</td>";
                        $toEcho .= "<td>" . $citizen["veilPro"] . "</td>";
                        $toEcho .= "<td>" . $citizen["forBan"] . "</td>";
                        $toEcho .= "<td>" . $citizen["forGoul"] . "</td>";
                        $toEcho .= "<td>" . $citizen["jhLeft"] . "</td>";
                        $toEcho .= "<td></td>";
                        $toEcho .= "<td></td>";
                        $toEcho .= "</tr>";
                        $toEcho .= "</form>";
                        echo $toEcho;
                    } else {
                        $toEcho .= "<tr><td>$pseudo";
                        $toEcho .= ($citizen["hero"]) ? "<img src='ressource/star.gif' alt='Heros' width='16' height='16'>" : "";
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
                        $toEcho .= "<td>" . $citizen["trouvaille"] . "</td>";
                        $toEcho .= "<td>" . $citizen["deathtrap"] . "</td>";
                        $toEcho .= "<td>" . $citizen["campPro"] . "</td>";
                        $toEcho .= "<td>" . $citizen["veilPro"] . "</td>";
                        $toEcho .= "<td>" . $citizen["forBan"] . "</td>";
                        $toEcho .= "<td>" . $citizen["forGoul"] . "</td>";
                        $toEcho .= "<td>" . $citizen["jhLeft"] . "</td>";
                        $toEcho .= "<td></td>";
                        $toEcho .= "<td></td>";
                        $toEcho .= "</tr>";
                        echo $toEcho;
                    }
                }
                echo "</table>";
            } else {
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

function jobToImage($job) {
    switch ($job) {
        case "collec":
            return "<img src='ressource/shovel.gif' alt='Pelleteur' width='16' height='16'>";
    }
}
?>
