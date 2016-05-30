<!DOCTYPE html>
<html lang="de">

  <?php
      session_start();

      if (isset($_SESSION["status"]) && $_SESSION["status"] == "loggedin") {
          $error = isset($_GET["error"]) ? "?error=" . $_GET["error"] : "";
          header("Location: dashboard.php" . $error);
          exit;
      }
  ?>

  <?php include 'template/head.php';?>

  <body>
      <?php include 'template/navbar.php';?>

      <div class="container pagecontent">
          <div class="col-md-8 col-md-offset-2">
              <?php
                // output error messages
                require_once "Message.php";
                if (isset($_GET["error"])) {
                    print Message::forError($_GET["error"]);
                }
              ?>
              <div class="panel panel-default">
                  <div class="panel-heading">
                      Login
                  </div>
                  <div class="panel-body">
                      <form method="POST" action="login.php" class="form-horizontal">
                          <!-- User name -->
                          <div class="form-group ">
                              <label class="col-md-4 control-label">Benutzername</label>

                              <div class="col-md-6">
                                  <input type="text" class="form-control" name="user">
                              </div>
                          </div>

                          <!-- Password -->
                          <div class="form-group">
                              <label class="col-md-4 control-label">Passwort</label>

                              <div class="col-md-6">
                                  <input type="password" class="form-control" name="password">
                              </div>
                          </div>

                          <!-- Submit button -->
                          <div class="form-group">
                              <div class="col-md-6 col-md-offset-4">
                                  <button type="submit" class="btn btn-default">
                                      <i class="fa fa-btn fa-sign-in"></i>Einloggen
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>

      <?php include 'template/footer.php';?>
      <?php include 'template/scripts.php';?>
  </body>
</html>
