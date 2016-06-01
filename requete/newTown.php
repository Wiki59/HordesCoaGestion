<?php

/**
 * Créé un dossier au nom de la ville et inclue un fichier citizen.json
 */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("HTTP/1.0 405 Method Not Allowed", true, 405);
} else {
    session_start();
    if (isset($_SESSION["token"]) && isset($_POST["token"]) && isset($_POST["town"]) && $_SESSION["token"] == $_POST["token"]) {
        if (!is_dir("town/" . $_POST["town"])) {
            mkdir("town/" . $_POST["town"]);
            $citizen = array();
            $citizen_json = json_encode($citizen);
            file_put_contents("town/" . $_POST["town"] . "/citizen.json", $citizen_json);
            header("Location: accueil.php");
        } else {
            echo "Nom de ville déjà existant";
            header("Location: accueil.php");
        }
    } else {
        header("HTTP/1.0 400 Bad Request", true, 400);
    }
}

