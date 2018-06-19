<?php

session_start();

if (!isset($_SESSION['signInUserName'])) {// not signed in
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cssCommon.css">
    <title>Profile</title>
</head>
<body>

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
                <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#signInFormModal" onclick="changeVerify()">Sign in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="signUp.html">Sign up</a>
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

// insert sign in modal
include_once "signInModal.php";

?>

<main>
    <div class="text-center">
        <h1>Oops! Unexpected error occurred!</h1>
        <h1>Please sign in first.</h1>
    </div>
</main>

    <?php

} else {// signed in

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cssCommon.css">
    <title>Profile of <?php echo $_SESSION['signInUserName'] ?></title>
</head>
<body>

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
                <a class="nav-link active" href="profile.php"><?php echo $_SESSION['signInUserName'] ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart</a>
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

// include sign in modal
include_once "signInModal.php";

// connect the database
include_once "connect.php";

$sql = "SELECT * FROM users";
$result = $connection->query($sql);
while ($user = $result->fetch_array()) {
    if ($user['name'] == $_SESSION['signInUserName']) {
        break;
    }
}

// release the result
$result->close();

?>

<!-- Modal -->
<div class="modal fade" id="topUpFormModal" tabindex="-1" role="dialog" aria-labelledby="topUpFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topUpFormModalLabel">Top Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="topUp" name="topUp" method="get" action="topUp.php">
                    <div class="form-row">
                        <div class="col mb-3">
                            <span id="alertTopUp" class="alert"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="topUpAmount">Please enter the amount: </label>
                            <input type="number" min="1" class="form-control" id="topUpAmount" name="topUpAmount" placeholder="Amount">
                        </div>
                    </div>
                    <input type="text" class="invisible" id="userID" name="userID" value="<?php echo $user['userID'] ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="topUpSubmit" class="btn btn-outline-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<?php

// output delete modals
$sqlMyArtWorks = "SELECT * FROM artworks WHERE ownerID = ".$user['userID'];
$resultMyArtWorks = $connection->query($sqlMyArtWorks);

while ($rowMyArtWorks = $resultMyArtWorks->fetch_array()) {

    ?>

    <!-- Modal -->
    <div class="modal fade" id="deleteWork<?php echo $rowMyArtWorks['artworkID'] ?>Modal" tabindex="-1"
         role="dialog" aria-labelledby="deleteWork<?php echo $rowMyArtWorks['artworkID'] ?>ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteWork<?php echo $rowMyArtWorks['artworkID'] ?>ModalLabel">Delete Art Work</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="delete<?php echo $rowMyArtWorks['artworkID'] ?>" name="delete<?php echo $rowMyArtWorks['artworkID'] ?>" method="get" action="deleteWork.php">
                        <div class="form-row">
                            <div class="col mb-3">
                                <span>You are attempting to DELETE <?php echo $rowMyArtWorks['title'] ?>!</span>
                            </div>
                        </div>
                        <input type="text" class="invisible" name="artworkID" value="<?php echo $rowMyArtWorks['artworkID'] ?>">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-outline-primary" onclick="document.getElementById('delete<?php echo $rowMyArtWorks['artworkID'] ?>').submit()">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <?php

    // release result
    $resultMyArtWorks->close();
}

?>

<main class="profile">

    <div class="container m-3">
        <div class="row">
            <div class="col-sm-4">
                <h3>Profile</h3>
                <dl class="row">
                    <dt class="col-sm-3">User: </dt>
                    <dd class="col-sm-9"><?php echo $user['name'] ?></dd>

                    <dt class="col-sm-3">Email: </dt>
                    <dd class="col-sm-9"><?php echo $user['email'] ?></dd>

                    <dt class="col-sm-3">Tel: </dt>
                    <dd class="col-sm-9"><?php echo $user['tel'] ?></dd>

                    <dt class="col-sm-3">Address: </dt>
                    <dd class="col-sm-9"><?php echo $user['address'] ?></dd>

                    <dt class="col-sm-3">Balance: </dt>
                    <dd class="col-sm-9">$<?php echo $user['balance'] ?></dd>
                </dl>
                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#topUpFormModal">Top Up</button>
            </div>

            <div class="col-sm-8">

                <!--my artworks-->
                <div class="row">
                    <table class="table table-hover table-sm">
                        <caption>My artworks</caption>
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Release Time</th>
                            <th scope="col">Options</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        // get my art works
                        $resultMyArtWorks = $connection->query($sqlMyArtWorks);

                        // output rows of art works
                        $i = 1;
                        while ($rowMyArtWorks = $resultMyArtWorks->fetch_array()) {
                            echo '<tr>
                                <th scope="row">'.$i.'</th>
                                <td>
                                    <a href="details.php?artworkID='.$rowMyArtWorks['artworkID'].'" class="badge badge-light">
                                    '.$rowMyArtWorks['title'].'
                                    </a>
                                </td>
                                <td>'.$rowMyArtWorks['timeReleased'].'</td>';

                            if ($rowMyArtWorks['orderID']) {// sold out
                                echo '<td>
                                        <a href="release.php" class="btn btn-outline-primary disabled">Modify</a> &nbsp;
                                        <button type="button" class="btn btn-outline-primary" disabled>Delete</button>
                                </td>
                            </tr>';
                            } else {// not sold yet
                                echo '<td>
                                        <a href="release.php" class="btn btn-outline-primary">Modify</a> &nbsp;
                                        <button type="button" class="btn btn-outline-primary" 
                                data-toggle="modal" data-target="#deleteWork'.$rowMyArtWorks['artworkID'].'Modal">Delete</button>
                                </td>
                            </tr>';
                            }

                            $i++;
                        }

                        // release result
                        $resultMyArtWorks->close();

                        ?>

                        </tbody>
                    </table>
                </div>

                <!--my orders-->
                <div class="row">
                    <table class="table table-hover table-sm">
                        <caption>My orders</caption>
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Order Time</th>
                            <th scope="col">Sum</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        // get my orders
                        $sqlMyOrders = "SELECT * FROM orders WHERE ownerID = ".$user['userID'];
                        $resultMyOrders = $connection->query($sqlMyOrders);

                        // output rows of orders
                        $i = 1;
                        while ($rowMyOrders = $resultMyOrders->fetch_array()) {

                            // output works of every order
                            echo '<tr>
                                <th scope="row">'.$i.'</th>
                                <td>'.$rowMyOrders['orderID'].'</td>
                                <td>';

                            // get works of every order
                            $sqlMyOrderWorks = "SELECT * FROM artworks";
                            $resultMyOrderWorks = $connection->query($sqlMyOrderWorks);
                            while ($rowMyOrderWorks = $resultMyOrderWorks->fetch_array()) {
                                if ($rowMyOrderWorks['orderID'] == $rowMyOrders['orderID']){
                                    echo '<p>
                                    <a href="details.php?artworkID='.$rowMyOrderWorks['artworkID'].'" class="badge badge-light">
                                    '.$rowMyOrderWorks['title'].'
                                    </a>
                                </p>';
                                }
                            }

                            echo '</td>
                                    <td>'.$rowMyOrders['timeCreated'].'</td>
                                    <td>$'.$rowMyOrders['sum'].'</td>
                                </tr>';

                            // release result
                            $resultMyOrderWorks->close();

                            $i++;
                        }

                        // release result
                        $resultMyOrders->close();

                        ?>

                        </tbody>
                    </table>
                </div>

                <!--my sold works-->
                <div class="row">
                    <table class="table table-hover table-sm">
                        <caption>My sold works</caption>
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Sold Time</th>
                            <th scope="col">Price</th>
                            <th scope="col">Buyer</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        // get my sold works
                        $sqlMySoldWorks = "SELECT * FROM artworks WHERE ownerID = ".$user['userID']." AND orderID != NULL";
                        $resultMySoldWorks = $connection->query($sqlMySoldWorks);

                        // output rows of sold outs
                        $i = 1;
                        while ($rowMySoldWorks = $resultMySoldWorks->fetch_array()) {

                            // get order of every sold out
                            $sqlMySoldOrder = "SELECT * FROM orders WHERE orderID = ".$rowMySoldWorks['orderID'];
                            $resultMySoldOrder = $connection->query($sqlMySoldOrder);
                            $rowMySoldOrder = $resultMySoldOrder->fetch_array();

                            // get buyer of every order
                            $sqlMySoldBuyer = "SELECT * FROM users";
                            $resultMySoldBuyer = $connection->query($sqlMySoldBuyer);
                            while ($rowMySoldBuyer = $resultMySoldBuyer->fetch_array()) {
                                if ($rowMySoldOrder['ownerID'] == $rowMySoldBuyer['userID']) {
                                    break;
                                }
                            }

                            // release results
                            $resultMySoldOrder->close();
                            $resultMySoldBuyer->close();

                            echo '<tr>
                                <th scope="row">'.$i.'</th>
                                <td>
                                    <a href="details.php?artworkID='.$rowMySoldWorks['artworkID'].'" class="badge badge-light">
                                    '.$rowMySoldWorks['title'].'
                                    </a>
                                </td>
                                <td>'.$rowMySoldOrder['timeCreated'].'</td>
                                <td>$'.$rowMySoldWorks['price'].'</td>
                                <td>
                                    <p>User name: '.$rowMySoldBuyer['name'].'</p>
                                    <p>Email: '.$rowMySoldBuyer['email'].'</p>
                                    <p>Tel: '.$rowMySoldBuyer['tel'].'</p>
                                    <p>Address: '.$rowMySoldBuyer['address'].'</p>
                                </td>
                                </tr>';

                            $i++;
                        }

                        // release result
                        $resultMySoldWorks->close();

                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</main>

<?php

}// end of signed in

// close database
$connection->close();

?>

<footer class="footer navbar navbar-dark bg-dark">
    <div class="navbar-text m-auto">Produced and maintained by HNoodles in 2018</div>
</footer>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/jsSignIn.js"></script>
<script src="js/jsSearch.js"></script>
<script src="js/jsTopUp.js"></script>
</body>
</html>
