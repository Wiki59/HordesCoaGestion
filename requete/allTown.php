<?php

//if ($_SERVER["REQUEST_METHOD"] !== "POST") {
//    header("HTTP/1.0 405 Method Not Allowed", true, 405);
//} else {
    session_start();
    if (
    /* A remettre
      isset($_SESSION["token"]) &&
      isset($_POST["token"]) &&
      $_SESSION["token"] == $_POST["token"]
     */
            true
    ) {
        $dir = scandir("../town");
        $towns = array();
        foreach ($dir as $t) {
            if (is_dir($t) && $t != "." && $t != "..") {
                array_push($towns, $t);
            }
        }
        echo json_encode($towns);
    } else {
        header("HTTP/1.0 400 Bad Request Token", true, 400);
//    }
}