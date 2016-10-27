<?php include 'requete/info.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<?php include 'template/header.php'; ?>
<body>
<?php include 'template/entete.php'; ?>
<div id="result">
    Bienvenue sur le gestionnaire de coalition.<br/>
    Si vous rencontrez un bug ou des diffultés à utiliser le site, reportez le <a href="mailto:wiki59@live.fr">ici</a>.
    </br>
    </br>
    <div id="recentTownList">
        <?php
        $dir = scandir("./town");
        $fileName = array();
        $fileDate = array();
        foreach ($dir as $t) {
            if (is_dir("./town/" . $t) && $t != "." && $t != "..") {
                $fileName[] = $t;
                $fileDate[] = filemtime("./town/" . $t); // filectime permettrait de ranger par ordre de création /!\
                // Unix ne garde que la date de création
            }
        }
        arsort($fileDate);
        echo "<table><tr></tr><th id='headerTownResult'><h2>Villes récentes :</h2></th></tr>";
        foreach (array_keys($fileDate) as $iDate) {
            $t = $fileName[$iDate];
            echo "<tr class='townResult' town='$t' onclick=\"location.replace('/town.php?town='$t')\"><td>$t</td></tr>";
        }
        echo "</table>";
        ?>
    </div>
</div>
<script type="text/javascript" src="script/script.js"></script>
</body>
</html>