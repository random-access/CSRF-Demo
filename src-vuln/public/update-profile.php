<?php

    // fetch current session
    session_start();

    require("authenticate.php");

    // fetch user and password data
    $user = $_SESSION["user"];
    $password = $_POST["password"];
    $password_confirmation = $_POST["password-confirmation"];

    // test if string has at least 8 chars
    if (strlen($password) < 8) {
        header("Location: " . $_SERVER['HTTP_REFERER']  . "?error=4001");
        exit;
    }

    // test if password matches with pw confirmation
    if ($password !== $password_confirmation) {
        header("Location: " . $_SERVER['HTTP_REFERER']  . "?error=4002");
        exit;
    }

    // hash password
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    // Create DB connection
    require("../config.php");
    $conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    // prepare statement for fetching password
    $query = $conn->prepare("UPDATE users SET password = ? WHERE user = ?");

    // database connection isn't working
    if (!$query) {
        header("Location: " . $_SERVER['HTTP_REFERER']  . "?error=4003");
        exit;
    }

    // execute password query & test if successful
    $query->bind_param("ss", $password_hashed, $user);
    if ($query->execute()) {
        $conn->close();
        header("Location: " . $_SERVER['HTTP_REFERER']  . "?update=1");
    } else {
        $conn->close();
        header("Location: " . $_SERVER['HTTP_REFERER']  . "?error=4003");
    }

?>
