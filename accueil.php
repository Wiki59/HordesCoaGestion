<?php include 'requete/info.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<?php include 'template/header.php'; ?>
<body>
<?php include 'template/entete.php'; ?>
<div id="result">
    Bienvenue sur le gestionnaire de coalition.<br/>
    Si vous rencontrez un bug ou des diffultés à utiliser le site, reportez le <a href="mailto:wiki59@live.fr">ici</a>.
    <div id="recentTownList">
        <?php
        $dir = scandir("./town");
        $fileName = array();
        $fileDate = array();
        foreach ($dir as $t) {
            if (is_dir("./town/" . $t) && $t != "." && $t != "..") {
                $fileName[] = $t;
                $fileDate[] = filemtime("./town/" . $t); // filectime permettrait de ranger par ordre de création /!\
            }
        }
        arsort($fileDate);
        foreach (array_keys($fileDate) as $iDate) {
            echo "<li>" . $fileName[$iDate] . "</li>";
        }
        ?>
    </div>
</div>
<script type="text/javascript" src="script/script.js"></script>
</body>
</html>