<div id="recentTownList">
    <?php
    $dir = dir("../town");
    echo $dir;
    $towns = array();
    while (false !== ($t = $dir->re²ad())) {
        if (is_dir($t) && $t != "." && $t != "..") {
            echo "<li>" . $t . "</li>"
        }
    }
    ?>
</div>