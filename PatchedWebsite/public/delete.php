<?php
    // fetch current session
    session_start();

    // redirect to login page if no authenticated user
    if (!(isset($_SESSION["login"]) && $_SESSION["login"] == "ok")) {
        header("Location: index.php");
        return;
    }

    if (!isset($_POST["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
        error_log("CSRF token not matching");
        header("Location: index.php?error=1004");
        return;
    }

    // get user dir
    $target_dir ="uploads/" . $_SESSION["user"];

    // if there are no pics yet, nothing to delete
    if (!file_exists($target_dir)) {
        header("Location: dashboard.php?error=3001");
        return;
    }

    // remove user dir + all content
    recursive_rm($target_dir);

    error_log("Referer: " . $_SERVER['HTTP_REFERER']);

    // redirect to main page
    header("Location: " . $_SERVER['HTTP_REFERER'] . "?delete=1");

    // function for recursively deleting directory + content
    function recursive_rm ($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            is_dir($file) ? recursive_rm($dir . "/" . $file) : unlink($dir . "/" . $file);
        }
    }

 ?>
