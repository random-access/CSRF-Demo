<?php
    require("../config.php");

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
