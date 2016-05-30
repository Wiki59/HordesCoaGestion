<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("HTTP/1.0 405 Method Not Allowed", true, 405);
} else {
    session_start();
    if (
    //isset
            isset($_SESSION["token"]) &&
            isset($_POST["token"]) &&
            //isGood
            $_SESSION["token"] == $_POST["token"]
    ) {
        $dir = dir("town");
        $town = array();
        while (false !== ($f = $dir->read())) {
            if (is_dir($f) && $f != "." && f != "..") {
                array_push($town, $f);
            }
        }
        echo json_encode($town);
    } else {
        header("HTTP/1.0 400 Bad Request", true, 400);
    }
}
