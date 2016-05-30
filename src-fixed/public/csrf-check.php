<?php

    if(!isset($_SESSION)) {
        session_start();
    }

    $site = "http://".$_SERVER["SERVER_NAME"];
    if (isset($_SERVER["HTTP_ORIGIN"])) {
        $origin = $_SERVER["HTTP_ORIGIN"];
        if (strpos($site, $origin) !== 0) {
            error_log("Invalid origin header: " . $origin);
            header("Location: index.php?error=1004");
            exit;
        }
    } else if (isset($_SERVER["HTTP_REFERER"])) {
        $referer = $_SERVER["HTTP_REFERER"];
        if (strpos($site, $referer) !== 0) {
            error_log("Origin not set and invalid referer header: " . $referer);
            header("Location: index.php?error=1004");
            exit;
        }
    } else {
        error_log("Neither origin nor referer set.");
        header("Location: index.php?error=1004");
        exit;
    }

    // test if CSRF token is valid, redirect to login page if not
    if (!isset($_POST["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
        error_log("CSRF token not matching");
        header("Location: index.php?error=1004");
        exit;
    }

 ?>
