<?php

    // fetch current session
    session_start();

    // redirect to login page if no authenticated user
    if (!(isset($_SESSION["status"]) && $_SESSION["status"] == "loggedin")) {
        header("Location: index.php");
        exit;
    }

?>
