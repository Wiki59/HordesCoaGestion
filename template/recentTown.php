<div id="recentTownList">
    <?php
    $dir = dir("../town");
    $town = array();
    while (false !== ($f = $dir->read())) {
        if (!is_dir($f) && $f != "." && f != "..") {
            array_push($town, $f);
        }
    }
    echo json_encode($town);
    ?>
</div>