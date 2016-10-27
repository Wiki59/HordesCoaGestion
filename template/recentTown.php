<div id="recentTownList">
    <?php
    $dir = dir("..");
    var_dump(is_dir($dir));
    $towns = array();
    while (false !== ($t = $dir->read())) {
        if (is_dir($t) && $t != "." && $t != "..") {
            echo "<li>" . var_dump($t) . "</li>";
        }
    }
    echo "<p>Fin</p>";
    ?>
</div>