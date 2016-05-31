<?php
session_start();
$token = uniqid(rand(), true);
$_SESSION['token'] = $token;
$_SESSION['token_time'] = time();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>
            Manager
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="Content-Language" content="fr"/>
        <link rel="icon" href="allumette.ico" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="jquery-ui-1114/jquery-ui.min.css"/>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="jquery-ui.js"></script>
        <script type="text/javascript">
            var code = "<?php echo $_GET["code"]; ?>";
        </script>
    </head>
    <body>
        <?php include './entete.php'; ?>
        <div id="content">
            <?php
            if (isset($_GET["town"])) {
                $town = $_GET["town"];
                echo "<h1>$town</h1>";
                echo "<div>";
		echo "<input class='buttonStyle1' type='button' value='S&apos;ajouter' onclick='addMe('$town')'/>";
		echo "<input class='buttonStyle1' type='button' value='Mettre à jour' onclick='majMe('$town')'/>";
		echo "</div>";
		echo "<div id ='boxInfo'></div>";
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
            ?>
	</div>
        <script type="text/javascript" src="searcher.js"></script>
        <script type="text/javascript" src="script.js"></script>
    </body>
</html>
