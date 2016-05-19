<?php

    // fetch current session
    session_start();

    // redirect to login page if no authenticated user
    if (!(isset($_SESSION["login"]) && $_SESSION["login"] == "ok")) {
        header("Location: index.php");
        exit;
    }

?>
