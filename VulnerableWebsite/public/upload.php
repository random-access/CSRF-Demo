<?php
    session_start();

    // redirect to login page if no authenticated user
    if (!(isset($_SESSION["login"]) && $_SESSION["login"] == "ok")) {
        header("Location: index.php");
        return;
    }

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
            header("Location: welcome.php?error=2001");
            return;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            header("Location: welcome.php?error=2002");
            return;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 2000000) {
            header("Location: welcome.php?error=2003");
            return;
        }
        // Allow only certain image formats
        if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png"
              && $imageFileType != "gif" ) {
            header("Location: welcome.php?error=2004");
            return;
        }

        // Try to upload image
        if (move_uploaded_file($_FILES['file-input']['tmp_name'], $target_file)) {
            header("Location: welcome.php?uploaded=1");
            return;
        } else {
            header("Location: welcome.php?error=2005");
            return;
        }
    }
?>
