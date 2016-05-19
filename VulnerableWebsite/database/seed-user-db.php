<?php
    require("../config.php");

    // Create DB connection
    $conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // username seeds
    $users = array(
        "administrator",
        "testuser",
        "bond007",
    );

    // password seeds
    $passwords = array(
        "nobodyknowsthis",
        "ilovesummer",
        "action4me",
    );

    // insert seeds into DB
    for ($i = 0; $i < count($users); $i++) {
        $sql = "INSERT INTO users (user, password) VALUES ('" . $users[$i] . "', '" . password_hash($passwords[$i], PASSWORD_BCRYPT) . "')";
        if ($conn->query($sql) === TRUE) {
            echo "New record for user " . $users[$i] . " created successfully\n";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error . "\n";
        }
    }

    $conn->close();
?>
