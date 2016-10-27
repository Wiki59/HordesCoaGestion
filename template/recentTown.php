<div id="recentTownList">
    <?php
    $dir = dir("../town");
    var_dump($dir);
    $towns = array();
    while (false !== ($t = $dir->re²ad())) {
        if (is_dir($t) && $t != "." && $t != "..") {
            echo "<li>" . var_dump($t) . "</li>";
        }
    }
    echo "<p>Fin</p>";
    ?>
</div>