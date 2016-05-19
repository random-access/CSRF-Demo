<?php
    require("../config.php");

    // Create DB connection
    $conn = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // sql to create table
    $sql = "DROP TABLE users";

    if ($conn->query($sql) === TRUE) {
        echo "Successfully deleted users table." . "\n";
    } else {
        echo "Error deleting users table: " . $conn->error . "\n";
    }

    $conn->close();
?>
