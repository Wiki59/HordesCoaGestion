<?php

/**
 * Ajoute l'utilisateur courrant dans la liste des citoyen
 */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("HTTP/1.0 405 Method Not Allowed", true, 405);
} else {
    session_start();
    if (isset($_POST["town"]) && isset($_SESSION["user"])) {
        if (is_dir("../town/" . $_POST["town"])) {
            $citizens = file_get_contents("../town/" . $_POST["town"] . "/citizen.json");
            $array_citizen = json_decode($citizens, true);
            $pseudo = $_SESSION['user']['pseudo'];
            unset($array_citizen[$pseudo]);
            $new_citizens = json_encode($array_citizen);
            file_put_contents("../town/" . $_POST["town"] . "/citizen.json", $new_citizens);
            echo "Citoyen retiré";
        } else {
            echo "Ville \"" . $_POST["town"] . "\" introuvable";
        }
    } else {
        header("HTTP/1.0 400 Bad Request", true, 400);
    }
}
