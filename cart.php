<?php

// set history
include_once "setHistory.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cssCommon.css">
    <title>Cart</title>
</head>
<body>

<?php


if(!isset($_POST['signInUserName'])) {
    if (!isset($_SESSION['signInUserName'])) {// not signed in

        // include nav
        include_once "nav.php";

        // insert sign in modal
        include_once "signInModal.php";

        ?>

        <main>
            <div class="text-center">
                <h1>Oops! Unexpected error occurred!</h1>
                <h1>Please sign in first.</h1>
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

    } else {// signed in

        ?>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php"><strong>Art Store</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <span class="navbar-text mx-2">Where you find <strong>genius</strong> and <strong>extraordinary</strong></span>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Front Page<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php"><?php echo $_SESSION['signInUserName'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="release.php">Release</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signOut.php?location=index.php">Sign out</a>
                    </li>
                </ul>
                <form id="search" class="form-inline my-2 my-lg-0" method="get" action="search.php">
                    <input id="searchText" class="form-control mr-sm-2" type="search" name="searchText" placeholder="Search here" aria-label="Search">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Search By...
                        </button>
                        <div class="dropdown-menu text-center" aria-labelledby="dropdownMenuButton">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ckbTitle" name="searchBy[]" value="title" checked>
                                <label class="form-check-label" for="ckbTitle">Title</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ckbIntroduction" name="searchBy[]" value="description">
                                <label class="form-check-label" for="ckbIntroduction">Description</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ckbArtist" name="searchBy[]" value="artist">
                                <label class="form-check-label" for="ckbArtist">Artist</label>
                            </div>
                            <span id="searchAlert" class="invisible alert"></span><br/>
                            <button id="btSearch" class="btn btn-outline-primary my-2 my-sm-0" type="button">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>

        <?php

        // show history
        include_once "showHistory.php";

        // sign in form
        include_once "signInModal.php";

        // connect the database
        include_once "connect.php";

        // get the user
        $sql = "SELECT * FROM users";
        $result = $connection->query($sql);
        while ($user = $result->fetch_array()) {
            if ($user['name'] == $_SESSION['signInUserName']) {
                break;
            }
        }

        ?>

        <main class="cart m-4">
            <h5>My Cart</h5>
            <div class="container my-3">

                <?php

                // get user's cart
                $sqlCart = "SELECT * FROM carts WHERE userID = ".$user['userID'];
                $resultCart = $connection->query($sqlCart);

                if ($resultCart->num_rows == 0) {// no result
                    echo "<h1 class='text-center'>Nothing in your cart.</h1>";
                } else {// layout art works in the cart

                    ?>

                    <!--cart works-->
                    <div class="row">

                        <table class="table table-hover table-sm">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Price</th>
                                <th scope="col">Option</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            $totalPrice = 0;

                            // out put every art work in cart
                            $i = 1;
                            while ($rowCart = $resultCart->fetch_array()) {

                                // get art work info
                                $sqlCartWork = "SELECT * FROM artworks";
                                $resultCartWork = $connection->query($sqlCartWork);

                                while ($rowCartWork = $resultCartWork->fetch_array()) {
                                    if ($rowCartWork['artworkID'] == $rowCart['artworkID']) {
                                        break;
                                    }
                                }

                                // release result
                                $resultCartWork->close();

                                echo '<tr>
                        <th scope="row">'.$i.'</th>
                        <td>
                            <a href="details.php?artworkID='.$rowCartWork['artworkID'].'" class="badge badge-light">
                            '.$rowCartWork['title'].'
                            </a>
                        </td>
                        <td>'.$rowCartWork['description'].'</td>
                        <td>
                            <img class="w-100" src="resources/img/'.$rowCartWork['imageFileName'].'" alt="'.$rowCartWork['title'].'">
                        </td>
                        <td>$'.$rowCartWork['price'].'</td>
                        <td>
                            <button type="button" class="btn btn-outline-primary"
                            onclick="document.getElementById(`remove'.$rowCart['cartID'].'`).submit()">Remove</button>
                            <form id="remove'.$rowCart['cartID'].'" name="remove'.$rowCart['cartID'].'" 
                            class="invisible" method="get" action="removeCartWork.php">
                                <input type="text" name="cartID" value="'.$rowCart['cartID'].'">
                            </form>
                        </td>
                   </tr>';

                                $totalPrice += $rowCartWork['price'];
                                $i++;
                            }

                            // release result
                            $result->close();

                            ?>

                            </tbody>
                        </table>
                    </div>

                    <!--controls-->
                    <div class="row">
                        <button id="btBuy" type="button" class="btn btn-outline-primary">Total: $<?php echo $totalPrice ?></button>
                        <form id="buy" class="invisible" name="buy">
                            <input type="hidden" id="userID" name="userID" value="<?php echo $user['userID'] ?>">
                            <input type="hidden" id="balance" name="balance" value="<?php echo $user['balance'] ?>">
                            <input type="hidden" id="totalPrice" name="totalPrice" value="<?php echo $totalPrice ?>">
                        </form>
                    </div>

                    <!--alert-->
                    <div class="row">
                        <span id="alertBuy" class="alert"></span>
                    </div>

                    <?php

                }// end of lay out art works

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
<script src="js/jsCreateOrder.js"></script>
</body>
</html>

        <?php

        // close database
        $connection->close();

    }// end of signed in

} else {
    $_SESSION['signInUserName'] = $_POST['signInUserName'];
    header("location:" . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']);
}

?>
