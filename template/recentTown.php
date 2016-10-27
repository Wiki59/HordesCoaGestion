<div id="recentTownList">
    <?php
    $dir = dir(".");
    var_dump(is_dir($dir));
    if (is_dir($dir)) {
        while (false !== ($t = $dir->read())) {
            if (is_dir($t) && $t != "." && $t != "..") {
                echo "<li>" . var_dump($t) . "</li>";
            }
        }
    }
    $dir->close();
    echo "<p>Fin</p>";
    ?>
</div>