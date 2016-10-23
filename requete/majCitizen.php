<?php
/**
 * Modifie l'utilisateur courrant dans la liste des citoyens, si il y est déjà
*/
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("HTTP/1.0 405 Method Not Allowed", true, 405);
} else {
    session_start();
    if (isset($_POST["town"]) && isset($_SESSION["user"])) {
        if (is_dir("../town/" . $_POST["town"])) {
            // Récupère la ville dans les paramètres GET
            $citizens = file_get_contents("../town/" . $_POST["town"] . "/citizen.json");
            $array_citizen = json_decode($citizens, true);
            $user = $_SESSION['user'];
            $pseudo = $user['pseudo'];
            // Modifie l'user si le pseudo égale celui de l'user
            if (array_key_exists($pseudo, $array_citizen['citizen'])) {
                $user_json = $array_citizen['citizen'][$pseudo];
                $user_json["jhCumul"] = lastPow($_POST["jhCumul"]);
                $user_json["lastPow"] = lastPow($user_json["jhCumul"]);
                $user_json["job"] = $user["job"];
                $user_json["dateMaj"] = new DateTime();
                $user_json["hero"] = $user["hero"];
                $user_json["isGhost"] = $user["isGhost"];
                $new_citizens = json_encode($array_citizen);
                file_put_contents("../town/" . $_POST["town"] . "/citizen.json", $new_citizens);
                echo "Citoyen mis à jour";
            } else {
                echo "Le citoyen n'est pas dans la liste";
            }
        } else {
            echo "Ville introuvable";
        }
    } else {
        echo "Vous devez vous connecter";
    }
}

/**
 * TODO
 * @param int $jhCumul
 * @return array
*/
function lastPow($jhCumul, $array = false) {
    $pow = array();
    if (jhCumul > 3) {
        array_push($pow, "Manipulateur");
    }
    if (jhCumul > 7) {
        array_push($pow, "Clairvoyance");
    }
    if (jhCumul > 16) {
        array_push($pow, "Scribe motivé");
    }
    if (jhCumul > 25) {
        array_push($pow, "Camaraderie");
    }
    if (jhCumul > 31) {
        array_push($pow, "Dictateur");
    }
    if (jhCumul > 45) {
        array_push($pow, "Grand coffre");
    }
    if (jhCumul > 61) {
        array_push($pow, "Corp sain");
    }
    if (jhCumul > 75) {
        array_push($pow, "Omnicience");
    }
    if (jhCumul > 91) {
        array_push($pow, "Débrouillardise");
    }
    if (jhCumul > 105) {
        array_push($pow, "Double fond");
    }
    if (jhCumul > 121) {
        array_push($pow, "Jolie trouvailles");
    }
    if (jhCumul > 135) {
        array_push($pow, "Poches bien rangés");
    }
    if (jhCumul > 151) {
        array_push($pow, "Second souffle");
    }
    if (jhCumul > 165) {
        array_push($pow, "Prévoyant");
    }
    if (jhCumul > 181) {
        array_push($pow, "Armoire à glace");
    }
    if (jhCumul > 195) {
        array_push($pow, "Perfidie");
    }
    if (jhCumul > 211) {
        array_push($pow, "Vaincre la mort");
    }
    if (jhCumul > 241) {
        array_push($pow, "Vaincre la mort");
    }
    if (jhCumul > 301) {
        array_push($pow, "Vengeance sordide");
    }
    if (jhCumul > 301) {
        array_push($pow, "Campeur pro");
    }
    if (jhCumul > 361) {
        array_push($pow, "Camé prévoyant");
    }
    if (jhCumul > 541) {
        array_push($pow, "Maire");
    }
    if (jhCumul > 721) {
        array_push($pow, "Architecte");
    }
    if (jhCumul > 1000) {
        array_push($pow, "Veilleur pro");
    }
    if ($array) {
        return $pow;
    } else {
        end($pow);
    }
}