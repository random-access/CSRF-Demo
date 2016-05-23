<?php
    require("../config.php");

    // fetch presession
    session_start();

    // if already logged in, redirect to dashboard
    if (isset($_SESSION["login"]) && $_SESSION["login"] == "ok") {
        header("Location: dashboard.php");
        exit;
    }

    // test if presession CSRF token is valid, redirect to login page if not
    if (!isset($_POST["presession_csrf_token"]) || $_POST["presession_csrf_token"] !== $_SESSION["presession_csrf_token"]) {
        error_log("Presession CSRF token not matching");
        header("Location: index.php?error=1004");
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

      // unset presession cookie on client
      if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), "", time()-42000, "/");
      }

      // remove all presession variables & destroy old session
      session_regenerate_id(true);

      // generate CSRF token and add it to session
      $csrf_token = base64_encode(openssl_random_pseudo_bytes(32));
      $_SESSION['csrf_token']=$csrf_token;

      // correct password - redirect to welcome.php
      $_SESSION["user"] = $user;
      $_SESSION["login"] = "ok";
      $conn->close();
      header("Location: dashboard.php");
    } else {
      // wrong password
      $conn->close();
      header("Location: index.php?error=1003");
    }

 ?>
