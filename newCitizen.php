<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("HTTP/1.0 405 Method Not Allowed", true, 405);
} else {
/*
    $citizens = file_get_contents("town/" . "town1" . "/citizen.json");
    $array_citizen = json_decode($citizens, true);
    //echo var_dump($array_citizen['citizen']);

	$array_citizen['citizen']['melou'] = array(
		"heros" => true,
	);
	echo var_dump($array_citizen['citizen']['melou']);*/
      session_start();
      	if (isset($_SESSION["token"]) && isset($_POST["token"]) && $_SESSION["token"] == $_POST["token"] && isset($_POST["town"]) && isset($_SESSION["user"]))) {
      		if (is_dir("/town/" . $_POST["town"])) {
      			$citizens = file_get_contents("/town/" . $_POST["town"] . "/citizen.json");
      			$array_citizen = json_decode($citizens);
			$pseudo = $_SESSION['user']['pseudo'];
			if (array_key_exists($pseudo, $array_citizen)) {
				echo "Citoyen déjà dans la liste";
			} else {
				$array_citizen['citizen'][$pseudo] = array(
					"job" =>
                			"heros" => true,
					
        			);
			}
      		} else {
      			echo "Ville introuvable";
      		}
      	} else {
      		header("HTTP/1.0 400 Bad Request", true, 400);
      	}
}
