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
                echo "<tr><th>Pseudo</th><th>Heros</th><th>JH Cumulé</th></tr>";
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
