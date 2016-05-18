<!DOCTYPE html>
<html lang="de">
    <?php include 'template/head.php';?>

    <body>
        <?php include 'template/navbar.php';?>
        <div class="container">
            <h1 class="text-center">Dog of the day</h1>
            <img class="center-block" src="cute-dog.jpg"/>
            <h5 class="text-center">Look at this dog, isn't he the sweetest little dog you've ever seen?</h5>

            <!-- Form for deleting all pics-->
            <form method="POST" action="http://ccc-xsrf.dev/delete.php" class="form-horizontal text-center">
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

</html>
