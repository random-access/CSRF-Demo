<?php
    require("../config.php");

    // Create DB connection
    $conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // sql to create table
    $sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Successfully created users table." . "\n";
    } else {
        echo "Error creating users table: " . $conn->error . "\n";
    }

    $conn->close();
?>
