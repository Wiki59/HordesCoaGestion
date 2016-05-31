<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("HTTP/1.0 405 Method Not Allowed", true, 405);
} else {

    $citizens = file_get_contents("/town/" . "town1" . "/citizen.json");
    $array_citizen = json_decode($citizens);
    echo var_dump($array_citizen);


    /*
      session_start();
      if (isset($_SESSION["token"]) && isset($_POST["token"]) && $_SESSION["token"] == $_POST["token"] && $_SESSION["token_time"] >= (time() - (10 * 60) && isset($_POST["town"]) && isset($_POST["nom"]))) {
      if (is_dir("/town/" . $_POST["town"])) {
      $citizens = file_get_contents("/town/" . $_POST["town"] . "/citizen.json");
      $array_citizen = json_decode($citizens);
      } else {
      echo "Citoyen déjà présent";
      }
      } else {
      header("HTTP/1.0 400 Bad Request", true, 400);
      }
     */
}

