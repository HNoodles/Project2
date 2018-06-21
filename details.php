<?php

// connect the database
include_once "connect.php";

if (isset($_GET['userID']) && isset($_GET['artworkID'])) {// add to cart attempt
    $userID = $_GET['userID'];
    $artworkID = $_GET['artworkID'];

    $sqlAddToCart = "INSERT INTO carts (`userID`, `artworkID`) VALUES ('$userID', '$artworkID')";
    if ($connection->query($sqlAddToCart)) {// add to cart successfully
        // get art work from database
        $sqlArtWork = "SELECT * FROM artworks WHERE artworkID = $artworkID";
        $resultArtWork = $connection->query($sqlArtWork);
        $row = $resultArtWork->fetch_array();

//        // add view
//        $newView = (int)$row['view'] + 1;
//        $sqlAddView = "UPDATE artworks SET view = $newView WHERE artworkID = $artworkID";
//        $connection->query($sqlAddView);

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="css/cssCommon.css">
            <title>Details of <?php echo $row['title'] ?></title>
        </head>
        <body class="details">


        <?php
        session_start();

        // insert nav
        include_once "nav.php";

        // insert sign in modal
        include_once "signInModal.php";

        ?>

        <main>
            <div class="row m-3">

                <?php

                // image
                echo '<div class="col-sm-6">
            <img class="rounded w-100" src="resources/img/'.$row['imageFileName'].'" alt="'.$row['title'].'">
        </div>';

                // info
                echo '<div class="col-sm-6">
            <h1>'.$row['title'].'</h1>
            <h3>By '.$row['artist'].'</h3>';

                if ($row['orderID'] !== NULL) {
                    echo '<h4 class="text-danger">SOLD OUT</h4>';
                }

                echo '<dl class="row">
                <dt class="col-sm-3">Year of work: </dt>
                <dd class="col-sm-9">'.$row['yearOfWork'].'</dd>

                <dt class="col-sm-3">Dimensions: </dt>
                <dd class="col-sm-9">'.$row['width'].'*'.$row['height'].'</dd>

                <dt class="col-sm-3">Genres: </dt>
                <dd class="col-sm-9">'.$row['genre'].'</dd>

                <dt class="col-sm-3">Viewed: </dt>
                <dd class="col-sm-9">'.$row['view'].' Time(s)</dd>

                <dt class="col-sm-3">Description: </dt>
                <dd class="col-sm-9">
                    <p>'.$row['description'].'</p>
                </dd>
                
                <dt class="col-sm-3">Price: </dt>
                <dd class="col-sm-9">$'.$row['price'].'</dd>';


                // get owner from database
                $sqlUsers = "SELECT * FROM users WHERE userID = ".$row['ownerID'];
                $resultUsers = $connection->query($sqlUsers);
                $rowUsers = $resultUsers->fetch_array();

                echo '<dt class="col-sm-3">Owner: </dt>
                <dd class="col-sm-9">'.$rowUsers['name'].'</dd>';

                // release the user result
                $resultUsers->close();

                echo '<dt class="col-sm-3">Released time: </dt>
                <dd class="col-sm-9">'.$row['timeReleased'].'</dd>
            </dl>';

                echo '<p class="text-center"><span class="alert">Added to cart successfully!</span></p>';
                echo '<button id="btAdd" type="button" class="btn btn-outline-primary btn-block" title="Already in your cart." disabled>Add to my cart</button>';

                echo '</div>';

                // release the art work result
                $resultArtWork->close();

                ?>

            </div>

        </main>
        <footer class="footer navbar navbar-dark bg-dark">
            <div class="navbar-text m-auto">Produced and maintained by HNoodles in 2018</div>
        </footer>
        <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>
        <script src="js/jsSignIn.js"></script>
        <script src="js/jsSearch.js"></script>
        </body>
        </html>

        <?php
        }
} else if (isset($_GET['artworkID'])) {// enter details ordinarily
    $artworkID = $_GET['artworkID'];

    // get art work from database
    $sqlArtWork = "SELECT * FROM artworks WHERE artworkID = $artworkID";
    $resultArtWork = $connection->query($sqlArtWork);
    $row = $resultArtWork->fetch_array();

    // add view
    $newView = (int)$row['view'] + 1;
    $sqlAddView = "UPDATE artworks SET view = $newView WHERE artworkID = $artworkID";
    $connection->query($sqlAddView);

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/cssCommon.css">
        <title>Details of <?php echo $row['title'] ?></title>
    </head>
    <body class="details">

    <?php
    session_start();

    // insert nav
    include_once "nav.php";

    // insert sign in modal
    include_once "signInModal.php";

    ?>

    <main>
        <div class="row m-3">
            <?php

            // image
            echo '<div class="col-sm-6">
            <img class="rounded w-100" src="resources/img/'.$row['imageFileName'].'" alt="'.$row['title'].'">
        </div>';

            // info
            echo '<div class="col-sm-6">
            <h1>'.$row['title'].'</h1>
            <h3>By '.$row['artist'].'</h3>';

            if ($row['orderID'] !== NULL) {
                echo '<h4 class="text-danger">SOLD OUT</h4>';
            }

            echo '<dl class="row">
                <dt class="col-sm-3">Year of work: </dt>
                <dd class="col-sm-9">'.$row['yearOfWork'].'</dd>

                <dt class="col-sm-3">Dimensions: </dt>
                <dd class="col-sm-9">'.$row['width'].'*'.$row['height'].'</dd>

                <dt class="col-sm-3">Genres: </dt>
                <dd class="col-sm-9">'.$row['genre'].'</dd>

                <dt class="col-sm-3">Viewed: </dt>
                <dd class="col-sm-9">'.$row['view'].' Time(s)</dd>

                <dt class="col-sm-3">Description: </dt>
                <dd class="col-sm-9">
                    <p>'.$row['description'].'</p>
                </dd>
                
                <dt class="col-sm-3">Price: </dt>
                <dd class="col-sm-9">$'.$row['price'].'</dd>';


            // get owner from database
            $sqlUsers = "SELECT * FROM users WHERE userID = ".$row['ownerID'];
            $resultUsers = $connection->query($sqlUsers);
            $rowUsers = $resultUsers->fetch_array();

            echo '<dt class="col-sm-3">Owner: </dt>
                <dd class="col-sm-9">'.$rowUsers['name'].'</dd>';

            // release the user result
            $resultUsers->close();

            echo '<dt class="col-sm-3">Released time: </dt>
                <dd class="col-sm-9">'.$row['timeReleased'].'</dd>
            </dl>';

            if ($row['orderID'] === NULL && isset($_SESSION['signInUserName'])) {// user signed in and work not sold out
                // get current user id
                $sqlCurrentUser = "SELECT * FROM users";
                $resultCurrentUser = $connection->query($sqlCurrentUser);
                while ($rowCurrentUser = $resultCurrentUser->fetch_assoc()) {
                    if ($rowCurrentUser['name'] === $_SESSION['signInUserName']) {// find the current user
                        // get the cart result
                        $sqlCart = "SELECT * FROM carts WHERE userID = ".$rowCurrentUser['userID']." AND artworkID = ".$artworkID;
                        $resultCart = $connection->query($sqlCart);

                        if ($resultCart->fetch_array()) {// already in current user's cart
                            echo '<p class="text-center"><span class="alert">Already in your cart.</span></p>';
                            echo '<button id="btAdd" type="button" class="btn btn-outline-primary btn-block" title="Already in your cart." disabled>Add to my cart</button>';

                            // release the cart result
                            $resultCart->close();
                        } else {// NULL, work not added to current user's cart
                            echo '<form class="invisible" method="get" action="details.php">
                        <input id="artworkID" name="artworkID" type="text" value="'.$artworkID.'">
                        <input id="userID" name="userID" type="text" value="'.$rowCurrentUser['userID'].'"> 
                        <button id="btAdd" type="submit" class="btn btn-outline-primary btn-block visible">Add to my cart</button>
                    </form>';
                        }
                    }
                }

                // release the current user result
                $resultCurrentUser->close();
            } else if (!isset($_SESSION['signInUserName'])) {// user not signed in
                echo '<p class="text-center"><span class="alert">Please sign in first.</span></p>';
                echo '<button id="btAdd" type="button" class="btn btn-outline-primary btn-block" title="Please sign in first." disabled>Add to my cart</button>';
            } else if ($row['orderID'] !== NULL) {// work sold out
                echo '<p class="text-center"><span class="alert">Sorry! Already sold out.</span></p>';
                echo '<button id="btAdd" type="button" class="btn btn-outline-primary btn-block" title="Sorry! Already sold out." disabled>Add to my cart</button>';
            }

            echo '</div>';

            // release the art work result
            $resultArtWork->close();

            ?>

        </div>

    </main>
    <footer class="footer navbar navbar-dark bg-dark">
        <div class="navbar-text m-auto">Produced and maintained by HNoodles in 2018</div>
    </footer>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>
    <script src="js/jsSignIn.js"></script>
    <script src="js/jsSearch.js"></script>
    </body>
    </html>

    <?php

    // close the database
    $connection->close();

} else {// art work id not set unexpectedly
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/cssCommon.css">
        <title>Details</title>
    </head>
    <body class="details">

    <?php

    session_start();

    // insert nav
    include_once "nav.php";

    // insert sign in modal
    include_once "signInModal.php";

    ?>

    <main>
        <div class="text-center">
            <h1>Oops! Unexpected error occurred!</h1>
            <h1>Can't find the work! Please try again.</h1>
        </div>
    </main>

    <footer class="footer navbar navbar-dark bg-dark">
        <div class="navbar-text m-auto">Produced and maintained by HNoodles in 2018</div>
    </footer>
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>
    <script src="js/jsSignIn.js"></script>
    <script src="js/jsSearch.js"></script>
    </body>
    </html>

<?php
}
?>

