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
			<th>DP</th>
			<th>Job</th>
			<th><img src='ressource/h_guard.gif' alt='Point de défense' width='16' height='16'></th>
			<th><img src='ressource/r_ruine.gif' alt='Niveau d'expertise pour les ruines' width='16' height='16'></th>
			<th><img src='ressource/arma.gif' alt='Témoins de l'armageddon width='16' height='16'></th>
			<th>G. Contamination</th>
			<th><img src='ressource/apag.gif' alt='Appareil Photo de l'Avant Guerre width='16' height='16'></th>
			<th><img src='ressource/h_calim.gif' alt='Sauvetage' width='16' height='16'></th>
			<th>RDH</th>
			<th><img src='ressource/small_wrestle.gif' alt='Uppercut sauvage' width='16' height='16'></th>
			<th><img src='ressource/r_share.gif' alt='Camaraderie' width='16' height='16'></th>
			<th><img src='ressource/small_pa.gif' alt='Second souffle' width='16' height='16'></th>
			<th><img src='ressource/item_chest_hero.gif' alt='Niveau de trouvaille (Débrouillardise, Jolie trouvaille, Prévoyant, Avantage ancien joueur)' width='16' height='16'></th>
			<th><img src='ressource/h_death.gif' alt='Trompe la mort' width='16' height='16'></th>
			<th><img src='ressource/r_cmplst.gif' alt='Campeur pro' width='16' height='16'></th>
			<th>Veilleur pro</th>
			<th><img src='ressource/h_ban.gif' alt='Volontaire si besoin d'un banni' width='16' height='16'></th>
			<th><img src='ressource/small_ghoul.gif' alt='Volontaire si besoin d'une goule width='16' height='16'></th>
			<th>JH restant</th>
			<th>Rôle</th>
			<th>Moyen de contact</tr>";
                foreach ($array['citizen'] as $pseudo => $citizen) {
                    echo "<tr><td>$pseudo</td></tr>";
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
