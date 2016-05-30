<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("HTTP/1.0 405 Method Not Allowed", true, 405);
} else {
    session_start();
    if (
            isset($_SESSION["token"]) &&
            isset($_POST["token"]) &&
            $_SESSION["token"] == $_POST["token"] &&
            $_SESSION["token_time"] >= (time() - (10 * 60) &&
            isset($_POST["town"]) &&
            isset($_POST["nom"])
            )) {
        if (is_dir("/town/" . $_POST["town"])) {
            fopen("/town/" . $_POST["town"] . "/citizen.json");
        } else {
            echo "Citoyen déjà présent";
        }
    } else {
        header("HTTP/1.0 400 Bad Request", true, 400);
    }
}

