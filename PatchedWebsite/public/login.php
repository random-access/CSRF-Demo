<?php
    require("../config.php");

    // start session
    session_start();

    // either password or user field was empty
    if (empty($_POST["user"]) && empty($_POST["password"])) {
        header("Location: index.php?error=1001");
        exit;
    }

    $user = $_POST["user"];
    $password = $_POST["password"];

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
