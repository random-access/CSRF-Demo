<?php
    require("../config.php");

    // fetch current session
    session_start();

    // redirect to login page if no authenticated user
    if (!(isset($_SESSION["login"]) && $_SESSION["login"] == "ok")) {
        header("Location: index.php");
        return;
    }

    // fetch user and password data
    $user = $_SESSION["user"];
    $password = $_POST["password"];
    $password_confirmation = $_POST["password-confirmation"];

    // test if string has at least 8 chars
    if (strlen($password) < 8) {
        header("Location: " . $_SERVER['HTTP_REFERER']  . "?error=4001");
        return;
    }

    // test if password matches with pw confirmation
    if (! $password === $password_confirmation) {
        header("Location: " . $_SERVER['HTTP_REFERER']  . "?error=4002");
        return;
    }

    // hash password
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    // prepare statement for fetching password
    $query = $conn->prepare("UPDATE users SET password = ? WHERE user = ?");

    // database connection isn't working
    if (!$query) {
        header("Location: " . $_SERVER['HTTP_REFERER']  . "?error=4003");
        return;
    }

    // execute password query & test if successful
    $query->bind_param("ss", $password_hashed, $user);
    if ($query->execute()) {
        header("Location: " . $_SERVER['HTTP_REFERER']  . "?update=1");
        return;
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']  . "?error=4003");
        return;
    }

?>
