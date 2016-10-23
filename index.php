<?php
/*
 * La page d'index authentifie l'utilisateur avec son compte twinoid grâce à une redirection, les paramètres sont parser
 * à la main comme une méthode GET
 * Cette page permet l'obtention du token qui sévira é récupérer les infos plus tard
 */
// Lien twino
$link = "Location: https://twinoid.com/oauth/auth?";
// Paramètre d'authentification
$param = array(
    "response_type" => "code",
    "client_id" => "270",
    "redirect_uri" => "http%3A%2F%2Fwww.hordes.wissamlefevre.com%2Faccueil.php", // La redirection effectué après l'authentification
    "scope" => "www.hordes.fr", // Les données nécessaire
    "state" => "Ok",
//	"access_type" => "offline",
);
$param_string = "";
// Parsage et concaténation des paramètres au liens, puis la redirection
foreach ($param as $key => $value) {
    $param_string .= $key . '=' . $value . '&';
}
$param_string = substr($param_string, 0, -1);
$final_link = $link . $param_string;
header($link . $param_string);
