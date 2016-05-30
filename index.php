<?php
$link = "Location: https://twinoid.com/oauth/auth?";
$param = array(
	"response_type" => "code",
	"client_id" => "270",
	"redirect_uri" => "http%3A%2F%2Fwww.hordes.wissamlefevre.com%2Faccueil.php",
	"scope" => "www.hordes.fr",
	"state" => "Ok",
//	"access_type" => "offline",
);
$param_string = "";
foreach($param as $key=>$value) {
        $param_string .= $key.'='.$value.'&';
}
$param_string = substr($param_string, 0, -1);
$final_link = $link . $param_string;
header($link . $param_string);
//echo $final_link;
