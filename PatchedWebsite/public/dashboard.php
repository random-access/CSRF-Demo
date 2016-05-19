<!DOCTYPE html>
<html lang="de">
    <?php require("authenticate.php");?>
    <?php include 'template/head.php';?>

    <body>
        <?php include 'template/navbar.php';?>

        <!-- Content of page -->
        <div class="container pagecontent">
            <?php
              // Output error / success messages
              require_once "Message.php";
              if (isset($_GET["error"])) {
                  print Message::forError($_GET["error"]);
              } else if (isset($_GET["upload"])) {
                  print Message::success_upload();
              } else if (isset($_GET["delete"])) {
                  print Message::success_delete();
              }
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                   Optionen
                </div>
                <div class="panel-body">
                    <div class="form-group row">

                        <!-- Form for uploading pics -->
                        <form action="upload.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="csrf_token" value=<?php echo($_SESSION['csrf_token']) ?> />
                            <div class="col-md-6">
                                <label class="button control-label" style="height:1em">
                                    <span class="btn btn-default btn-file">
                                        Bild auswählen...<input type="file" name="file-input" id="file-input">
                                    </span>
                                    &nbsp;
                                    <span id="file-name">Keine Datei ausgewählt</span>
                                </label>
                            </div>
                            <div class="col-md-2 col-md-offset-2">
                                <button class="btn btn-primary" type="submit" name="submit" id="btn-upload" disabled="true">
                                    <i class="fa fa-btn fa-upload"></i>Bild hochladen
                                </button>
                            </div>
                        </form>

                        <!-- Form for deleting all pics-->
                        <form method="DELETE" action="delete.php" class="form-horizontal">
                            <input type="hidden" name="csrf_token" value=<?php echo($_SESSION['csrf_token']) ?> />
                            <div class="col-md-2">
                                <button class="btn btn-danger" type="submit" name="submit" id="btn-delete">
                                    <i class="fa fa-btn fa-trash"></i>Alle löschen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Image gallery -->
            <div class="panel panel-default" id="image-gallery">
                <div class="panel-body">
                    <?php $array = glob("uploads/" . $_SESSION["user"] . "/*.*");
                          foreach($array as $value): ?>
                          <div class="col-sm-4 padded">
                              <img class="img-thumbnail img-responsive preview-pic center-block" src="<?php echo $value; ?>">
                              <h5 class="text-center"><?php echo basename($value); ?></h5>
                          </div>
                    <?php endforeach; ?>
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
