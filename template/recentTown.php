<div id="recentTownList">
    <?php
    $dir = scandir(".");
    var_dump($dir);
    foreach ($dir as $t) {
        if (is_dir($t) && $t != "." && $t != "..") {
            echo "<li>" . var_dump($t) . "</li>";
        }
    }
    ?>
</div>