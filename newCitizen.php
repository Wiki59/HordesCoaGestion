<?php

/**
 * Ajoute l'utilisateur courrant dans la liste des citoyen
 */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("HTTP/1.0 405 Method Not Allowed", true, 405);
} else {
    session_start();
    if (isset($_SESSION["token"]) && isset($_POST["token"]) && $_SESSION["token"] == $_POST["token"] && isset($_POST["town"]) && isset($_SESSION["user"])) {
        if (is_dir("/town/" . $_POST["town"])) {
            $citizens = file_get_contents("/town/" . $_POST["town"] . "/citizen.json");
            $array_citizen = json_decode($citizens, true);
            $user = $_SESSION['user'];
            $pseudo = $user['pseudo'];
            if (array_key_exists($pseudo, $array_citizen)) {
                echo "Citoyen déjà dans la liste";
            } else {
                $pdc = 2;
                if ($user['job'] == "jgard") {
                    $pdc += 2;
                }
                if ($user['jhCumul'] > 61) { // Corp sain
                    ++$pdc;
                }
                if ($user['jhCumul'] > 181) { // Armoire à glace
                    ++$pdc;
                }
                $present = 1;
                if ($user['jhCumul'] > 91) {
                    ++$present;
                }
                if ($user['jhCumul'] > 121) {
                    ++$present;
                }
                $array_citizen['citizen'][$pseudo] = array(
                    "lastPow" => lastPow($user["jhCumul"]),
                    "job" => $user['job'],
                    "nbCamp" => 0,
                    "pdc" => $pdc,
                    "nvRuin" => 0,
                    "apag" => false,
                    "rvMorning" => false,
                    "arma" => $user["armag"],
                    "ginfec" => $user["ginfec"],
                    "rescue" => $user["hero"],
                    "rdh" => $user["hero"],
                    "upper" => $user["hero"],
                    "solder" => ($user["jhCumul"] > 25),
                    "ss" => ($user["jhCumul"] > 135),
                    "clean" => true,
                    "armored" => ($user["jhCumul"] > 181),
                    "deathtrap" => ($user["jhCumul"] > 211),
                    "trouvaille" => $present,
                    "campPro" => ($user["jhCumul"] > 301),
                    "archi" => ($user["jhCumul"] > 721),
                    "veilPro" => ($user["jhCumul"] > 1000),
                    "forBan" => false,
                    "forGoul" => false,
                    "jhLeft" => 0,
                    "role" => "",
                    "com" => "",
                    "contact" => "",
                    "isGhost" => $user["isGhost"],
                    "hero" => $user["hero"],
                    "dateMaj" => \DateTime(),
                    "jhCumul" => $user["jhCumul"],
                    "reservist" => false,
                );
                $new_citizens = json_encode($array_citizen);
                file_put_contents("/town/" . $_POST["town"] . "/citizen.json", $new_citizens);
            }
        } else {
            echo "Ville introuvable";
        }
    } else {
        header("HTTP/1.0 400 Bad Request", true, 400);
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
