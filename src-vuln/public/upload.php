<?php

    // fetch current session
    session_start();

    require("authenticate.php");

    // create upload folder (uploads/[username]) if not existing
    $target_dir = "uploads/" . $_SESSION["user"];
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // get uploaded file path and extension
    $target_file = $target_dir . "/" . basename($_FILES['file-input']['name']);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES['file-input']['tmp_name']);
        if($check === false) {
            header("Location: dashboard.php?error=2001");
            return;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            header("Location: dashboard.php?error=2002");
            return;
        }
        // Check file size
        if ($_FILES["file-input"]["size"] > 2000000) {
            header("Location: dashboard.php?error=2003");
            return;
        }
        // Allow only certain image formats
        if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png"
              && $imageFileType != "gif" ) {
            header("Location: dashboard.php?error=2004");
            return;
        }

        // Try to upload image
        if (move_uploaded_file($_FILES['file-input']['tmp_name'], $target_file)) {
            header("Location: dashboard.php?upload=1");
            return;
        } else {
            header("Location: dashboard.php?error=2005");
            return;
        }
    }
?>
