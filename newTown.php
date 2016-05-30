<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("HTTP/1.0 405 Method Not Allowed", true, 405);
} else {
    session_start();
    if (
    //isset
            isset($_SESSION["token"]) &&
            isset($_POST["token"]) &&
            isset($_POST["town"]) &&
            //isGood
            $_SESSION["token"] == $_POST["token"]
    ) {
        if (!is_dir("town/" . $_POST["town"])) {
            mkdir("town/" . $_POST["town"]);
            $file = "citizen.json";
            $fd = fopen("town/" . $_POST["town"] . "/" . $file, "a+");
            $citizen = array();
            $citizen_json = json_encode($citizen);
            fwrite($fd, $citizen_json);
            fclose($fd);
        } else {
            echo "Nom de ville déjà existant";
        }
    } else {
        header("HTTP/1.0 400 Bad Request", true, 400);
    }
}

