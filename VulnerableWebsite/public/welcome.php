<!DOCTYPE html>
<html lang="de">
    <?php include 'template/head.php';?>

    <body>
        <?php
          // fetch current session
          session_start();

          // redirect to login page if no authenticated user
          if (!(isset($_SESSION["login"]) && $_SESSION["login"] == "ok")) {
              header("Location: index.php");
              return;
          }
        ?>
        <?php include 'template/navbar.php';?>
        <div class="container">
            <p>You are logged in !</p>
        </div>
        <?php include 'template/footer.php';?>
    </body>
</html>
