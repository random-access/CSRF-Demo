<?php
    require("../config.php");

    // start session
    session_start();

    // if already logged in, redirect to dashboard
    if (isset($_SESSION["login"]) && $_SESSION["status"] == "loggedin") {
        header("Location: dashboard.php");
        exit;
    }

    // either password or user field was empty
    if (empty($_POST["user"]) && empty($_POST["password"])) {
        header("Location: index.php?error=1001");
        exit;
    }

    $user = $_POST["user"];
    $password = $_POST["password"];

    // Create DB connection
    $conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    // prepare statement for fetching password
    $query = $conn->prepare("SELECT password FROM users WHERE user = ?");

    // database connection isn't working
    if (!$query) {
        header("Location: index.php?error=1002");
        exit;
    }

    // execute password query
    $query->bind_param("s", $user);
    $query->execute();
    $query->bind_result($hash);

    // verify password
    if ($query->fetch() && password_verify($password, $hash)) {
      // correct password - redirect to welcome.php
      $_SESSION["user"] = $user;
      $_SESSION["status"] = "loggedin";
      $conn->close();
      header("Location: dashboard.php");
    } else {
      // wrong password
      $conn->close();
      header("Location: index.php?error=1003");
    }

 ?>
