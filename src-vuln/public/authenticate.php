<?php

    if(!isset($_SESSION)) {
        session_start();
    }

    // redirect to login page if no authenticated user
    if (!(isset($_SESSION["status"]) && $_SESSION["status"] == "loggedin")) {
        $error = isset($_GET["error"]) ? "?error=" . $_GET["error"] : "";
        header("Location: index.php" . $error);
        exit;
    }

?>
