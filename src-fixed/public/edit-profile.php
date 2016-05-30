<!DOCTYPE html>
<html lang="de">

    <?php session_start();?>

    <?php require("authenticate.php");?>
    <?php include 'template/head.php';?>

    <body>
        <?php include 'template/navbar.php';?>

        <!-- Content of page -->
        <div class="container pagecontent">
            <div class="col-md-8 col-md-offset-2">

                <?php
                  // Output error / success messages
                  require_once "Message.php";
                  if (isset($_GET["error"])) {
                      print Message::forError($_GET["error"]);
                  } else if (isset($_GET["update"])) {
                      print Message::success_update();
                  }
                ?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                       Profil bearbeiten
                    </div>
                    <div class="panel-body">
                        <div class="form-group row">
                            <form method="POST" action="update-profile.php" class="form-horizontal">
                                <input type="hidden" name="csrf_token" value=<?php echo($_SESSION['csrf_token']) ?> />
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
