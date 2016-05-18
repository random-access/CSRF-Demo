<!DOCTYPE html>
<html lang="de">
  <?php include 'template/head.php';?>

  <body>
      <?php include 'template/navbar.php';?>

      <div class="container pagecontent">
          <div class="col-md-8 col-md-offset-2">
              <?php
                if (isset($_GET["error"])) {
                    echo "<div class='alert alert-danger alert-message'>";
                    switch ($_GET["error"]) {
                        case 1001:
                          echo "<strong>Login nicht möglich!</strong> Es wurden keine Daten eingegeben.";
                          break;
                        case 1002:
                          echo "<strong>Login nicht möglich!</strong> Ein interner Fehler ist aufgetreten.";
                          break;
                        case 1003:
                          echo "<strong>Login nicht möglich!</strong> Benutzername unbekannt oder Passwort nicht korrekt.";
                          break;
                        default:
                          echo "<strong>Login nicht möglich</strong> Es ist ein unbekannter Fehler aufgetreten.";
                    }
                    echo "</div>";
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
