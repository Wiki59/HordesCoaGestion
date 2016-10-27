<div id="recentTownList">
    <?php
    $dir = dir("../town");
    $town = array();
    while (false !== ($t = $dir->read())) {
        if (is_dir($t) && $t != "." && $t != "..") {
            array_push($town, $t);
        }
    }
    echo json_encode($town);
    ?>
</div>