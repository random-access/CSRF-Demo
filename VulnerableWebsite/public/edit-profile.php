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

        <!-- Content of page -->
        <div class="container pagecontent">
            <?php
              if (isset($_GET["error"])) {
                  echo "<div class='alert alert-danger alert-message'>";
                  switch ($_GET["error"]) {
                      case 4001:
                        echo "<strong>Fehler!</strong> Passwort muss mindestens 8 Stellen haben.";
                        break;
                      case 4002:
                        echo "<strong>Fehler!</strong> Passwort und Passwort-Bestätigung stimmen nicht überein.";
                        break;
                      case 4003:
                        echo "Ein interner Fehler ist aufgetreten.";
                        break;
                      default:
                        echo "Es ist ein unbekannter Fehler aufgetreten.";
                  }
                  echo "</div>";
              } else if (isset($_GET["update"])) {
                  echo "<div class='alert alert-success alert-message'>Passwort wurde erfolgreich geändert!</div>";
              }
            ?>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       Profil bearbeiten
                    </div>
                    <div class="panel-body">
                        <div class="form-group row">
                            <form method="POST" action="update-profile.php" class="form-horizontal">
                                <div class="form-group row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <label class="control-label">Neues Passwort</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <label class="control-label">Passwort wiederholen</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" class="form-control" name="password-confirmation">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2 col-md-offset-9 text-center">
                                        <button class="btn btn-primary" type="submit" name="submit">
                                            <i class="fa fa-btn fa-save"></i>Speichern
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
    <script>

        // Function for displaying chosen file besides
        $("#file-input").on('change', function() {
            if($(this).get(0).files) {
                  var name = $(this).get(0).files[0].name;
                  // console.log(name);
                  $("#file-name").html(name);
                  $("#btn-upload").attr("disabled", false);
            } else {
                  $("#btn-upload").attr("disabled", true);
            }
        });

        // Hide image gallery + disable delete button if no pics
        if ($("#image-gallery").find("img").length === 0) {
            $("#image-gallery").hide();
            $("#btn-delete").attr("disabled", true);
        }
    </script>
</html>
