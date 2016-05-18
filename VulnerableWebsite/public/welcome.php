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
            <?php
              if (isset($_GET["error"])) {
                  echo "<div class='alert alert-danger alert-message'>";
                  switch ($_GET["error"]) {
                      case 2001:
                        echo "<strong>Upload nicht möglich!</strong> Die angegebene Datei ist keine Bilddatei.";
                        break;
                      case 2002:
                        echo "<strong>Upload nicht möglich!</strong> Datei existiert bereits am Server.";
                        break;
                      case 2003:
                        echo "<strong>Upload nicht möglich!</strong> Die maximale Dateigröße von 2 MB wurde überschritten.";
                        break;
                      case 2004:
                        echo "<strong>Upload nicht möglich!</strong> Unerlaubter Dateityp, bitte nur JPG, JPEG, PNG & GIF-Dateien hochladen.";
                        break;
                      default:
                        echo "<strong>Upload nicht möglich</strong> Es ist ein unbekannter Fehler aufgetreten.";
                  }
                  echo "</div>";
              } else if (isset($_GET["uploaded"])) {
                  echo "<div class='alert alert-success alert-message'>Datei wurde erfolgreich hochgeladen!</div>";
              }
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                   Bild hinzufügen
                </div>
                <div class="panel-body">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="button control-label" style="height:1em">
                                    <span class="btn btn-default btn-file">
                                        Bild auswählen...<input type="file" name="file-input" id="file-input">
                                    </span>
                                    &nbsp;
                                    <span id="file-name">Keine Datei ausgewählt</span>
                                </label>
                            </div>
                            <div class="col-md-2 col-md-offset-4">
                                <button class="btn btn-primary" type="submit" name="submit">
                                    <i class="fa fa-btn fa-upload"></i>Bild hochladen
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Image gallery -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php $array = glob("uploads/" . $_SESSION["user"] . "/*.*");
                          foreach($array as $value): ?>
                          <div class="col-sm-4 padded">
                              <img class="img-thumbnail img-responsive preview-pic center-block" src="<?php echo $value; ?>">
                              <h5 class="text-center"><?php echo basename($value); ?>&nbsp; &nbsp; <button class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button> </h5>

                          </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
        <?php include 'template/footer.php';?>
        <?php include 'template/scripts.php';?>
    </body>
    <script>
    $("#file-input").on('change', function() {
        if($(this).get(0).files) {
              var name = $(this).get(0).files[0].name;
              console.log(name);
              $("#file-name").html(name);
        }
    });
    </script>
</html>
