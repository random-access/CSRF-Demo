<?php
    // fetch current session
    session_start();

    // redirect to login page if no authenticated user
    if (!(isset($_SESSION["login"]) && $_SESSION["login"] == "ok")) {
        header("Location: index.php");
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

    // redirect to main page
    header("Location: dashboard.php?delete=1");

    // function for recursively deleting directory + content
    function recursive_rm ($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            is_dir($file) ? recursive_rm($dir . "/" . $file) : unlink($dir . "/" . $file);
        }
    }

 ?>