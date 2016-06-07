<?php

session_start();
// Obtention du token
$clientSecret = file_get_contents("/var/ressourceWeb/clientsecret");
$clientSecret = substr($clientSecret, 0, -1);
if ($_SESSION["access_token"] === NULL) {
    $_SESSION["access_token"] = postToArray("https://twinoid.com/oauth/token", array(
                "client_id" => "270",
                "client_secret" => $clientSecret,
                "redirect_uri" => "http%3A%2F%2Fwww.hordes.wissamlefevre.com%2Faccueil.php",
                "code" => $_GET["code"],
                "grant_type" => "authorization_code",
            ))["access_token"];
}
// Recuperation des infos me twino/hordes, l'id et le pseudo
/*
  $me = postToArray("http://twinoid.com/graph/me", array(
  "access_token" => $_SESSION["access_token"],
  ));
 */
$me = postToArray("http://www.hordes.fr/tid/graph/me", array(
    "access_token" => $_SESSION["access_token"],
    "fields" => "name,twinId,hero,dead,job,baseDef,map",
        ));

// Recupere les pictos
$pictos = postToArray("http://twinoid.com/graph/user/" . $me["twinId"], array(
    "access_token" => $_SESSION["access_token"],
    "fields" => "sites.filter(6).fields(stats.fields(score))"
        ));
// Les JH cumulés et l'armag
$jobs = array("jermit", "jguard", "jtech", "jtamer", "jrangr", "jcolle", "jsham");
$jhCumul = 0;
$temoinArmag = false;
$temoinGinfec = false;
foreach ($pictos[sites][0][stats] as $picto) {
    if (in_array($picto["id"], $jobs)) {
        $jhCumul += $picto["score"];
    } else if ($picto["id"] === "armag") {
        $temoinArmag = true;
    } else if ($picto["id"] === "ginfec") {
        $temoinGinfec = true;
    }
}

// data
$data = array(
    "pseudo" => $me["name"],
    "jhCumul" => $jhCumul,
    "armag" => $temoinArmag,
    "ginfec" => $temoinGinfec,
    "hero" => $me["hero"],
    "job" => $me["job"],
    "isGhost" => $me["isGhost"],
    "baseDef" => $me["baseDef"],
);

if (isset($data["pseudo"])) {
	$_SESSION["user"] = $data;
}
echo json_encode($data);

// Functions
function postToArray($link, $param = null, $method = "POST") {
    $param_string = arrayToStringCurl($param);
    $ch = curl_init($link);
    curl_setopt($ch, CURLOPT_URL, $link);
    if ($method === "POST" && isset($param)) {
        curl_setopt($ch, CURLOPT_POST, count($param));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_string);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

function arrayToStringCurl($array) {
    foreach ($array as $key => $value) {
        $ret .= $key . '=' . $value . '&';
    }
    return substr($ret, 0, -1);
}
