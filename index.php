<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cssCommon.css">
    <link rel="stylesheet" href="css/cssIndex.css">
    <title>Art Store</title>
</head>
<body class="index">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="index.php"><strong>Art Store</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <span class="navbar-text mx-2">Where you find <strong>genius</strong> and <strong>extraordinary</strong></span>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Front Page<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="details.html">Details</a>
            </li>
            <?php
                session_start();

                if(!isset($_POST['signInUserName'])) {
                    if (!isset($_SESSION['signInUserName'])) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="" data-toggle="modal" data-target="#signInFormModal" onclick="changeVerify()">Sign in</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signUp.html">Sign up</a>
                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.html"><?php echo $_SESSION['signInUserName'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.html">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signOut.php">Sign out</a>
                        </li>
                        <?php
                    }
                } else {
                    $_SESSION['signInUserName'] = $_POST['signInUserName'];
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.html"><?php echo $_SESSION['signInUserName'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.html">My Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signOut.php">Sign out</a>
                    </li>
            <?php
                }
            ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<?php
// connect the database
$connection = new mysqli("localhost", "root", "", "art_store");
if ($connection->connect_errno) {
    die($connection->connect_error);
}

// chinese encoding
$connection->query("set names utf8");


// carousel display
echo '<div id="carouselGallery" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselGallery" data-slide-to="0" class="active"></li>
            <li data-target="#carouselGallery" data-slide-to="1"></li>
            <li data-target="#carouselGallery" data-slide-to="2"></li>
        </ol>';

// get results order by view
$sqlView = 'SELECT * FROM artworks ORDER BY view DESC';
$resultView = $connection->query($sqlView);

echo '<div class="carousel-inner">';

// first image
$rowView = $resultView->fetch_array();
echo '<div class="carousel-item active">
        <img class="d-block w-100" src="resources/img/'.$rowView['imageFileName'].'" alt="'.$rowView['title'].'">
            <div class="carousel-caption d-none d-md-block">
                <h1>'.$rowView['artist'].'</h1>
                <h3>'.$rowView['description'].'</h3>
                <a class="btn btn-outline-light" href="details.php?artworkID='.$rowView['artworkID'].'" role="button">Learn more</a>
            </div>
        </div>';

// second image
$rowView = $resultView->fetch_array();
echo '<div class="carousel-item">
            <img class="d-block w-100" src="resources/img/'.$rowView['imageFileName'].'" alt="'.$rowView['title'].'">
            <div class="carousel-caption d-none d-md-block">
                <h1>'.$rowView['artist'].'</h1>
                <h3>'.$rowView['description'].'</h3>
                <a class="btn btn-outline-light" href="details.php?artworkID='.$rowView['artworkID'].'" role="button">Learn more</a>
            </div>
        </div>';

// third image
$rowView = $resultView->fetch_array();
echo '<div class="carousel-item">
            <img class="d-block w-100" src="resources/img/'.$rowView['imageFileName'].'" alt="'.$rowView['title'].'">
            <div class="carousel-caption d-none d-md-block">
                <h1>'.$rowView['artist'].'</h1>
                <h3>'.$rowView['description'].'</h3>
                <a class="btn btn-outline-light" href="details.php?artworkID='.$rowView['artworkID'].'" role="button">Learn more</a>
            </div>
        </div>';

// release the memory used by the result set
$resultView->close();

echo '<a class="carousel-control-prev" href="#carouselGallery" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselGallery" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>';

?>

<!-- Modal -->
<div class="modal fade" id="signInFormModal" tabindex="-1" role="dialog" aria-labelledby="signInFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signInFormModalLabel">Sign In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="signIn" method="post" name="signIn" action="index.php">
                    <div class="form-row">
                        <div class="col mb-3">
                            <span id="alertSignIn" class="alert"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="signInUserName">User name: </label>
                            <input type="text" class="form-control" id="signInUserName" name="signInUserName" placeholder="User name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="signInPassword">Password: </label>
                            <input type="password" class="form-control" id="signInPassword" name="signInPassword" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-8 mb-3">
                            <label for="verify">Verify: </label>
                            <input type="text" class="form-control" id="verify" placeholder="Verify code">
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="code">Code: </label>
                            <a id="code" href="javascript:changeVerify()" class="badge badge-light">2144</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="signInSubmit" class="btn btn-outline-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="signUpFormModal" tabindex="-1" role="dialog" aria-labelledby="signInFormModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signUpFormModalLabel">Sign Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="signUp">
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="signUpUserName">User name: </label>
                            <input type="text" class="form-control" id="signUpUserName" placeholder="User name" onblur="checkSignUpUserName(this.value)">
                            <span id="alertUserName" class="alert"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="signUpPassword">Password: </label>
                            <input type="password" class="form-control" id="signUpPassword" placeholder="Password" onblur="checkSignUpPassword(this.value)">
                            <span id="alertPassword" class="alert"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="signUpPasswordConfirm">Confirm Password: </label>
                            <input type="password" class="form-control" id="signUpPasswordConfirm" placeholder="Confirm password" onblur="checkSignUpPasswordConfirm(this.value)">
                            <span id="alertPasswordConfirm" class="alert"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col mb-3">
                            <label for="signUpPhone">Phone: </label>
                            <input type="text" class="form-control" id="signUpPhone" placeholder="Phone" onblur="checkSignUpPhone(this.value)">
                            <span id="alertPhone" class="alert"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="signUpSubmit" class="btn btn-outline-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<main class="index">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div><div class="card" style="width: 18rem;">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
<!--    <div class="container-fluid my-3">-->
<!--        <div class="row text-center">-->
<!--            <div class="col-sm">-->
<!--                <figure>-->
<!--                    <img src="images/artists/square-medium/5.jpg" class="border border-primary rounded-circle"/>-->
<!--                    <figcaption>-->
<!--                        <h5 class="m-3 name">Portrait of Jacques-Louis David</h5>-->
<!--                        <p class="introduction">Jacques-Louis David was a French painter in the Neoclassical style,-->
<!--                            considered to be the preeminent painter of the era. In the 1780s his cerebral brand of-->
<!--                            history painting marked a change in taste away from Rococo frivolity toward a classical-->
<!--                            austerity and severity, heightened feeling chiming with the moral climate of the final years-->
<!--of the Ancien Régime.</p>-->
<!--                        <a class="btn btn-outline-primary" href="details.html" role="button">View Details</a>-->
<!--                    </figcaption>-->
<!--                </figure>-->
<!--            </div>-->
<!--            <div class="col-sm">-->
<!--                <figure>-->
<!--                    <img src="images/artists/square-medium/6.jpg" class="border border-primary rounded-circle"/>-->
<!--                    <figcaption>-->
<!--                        <h5 class="m-3 name">Portrait of Jacques-Louis David</h5>-->
<!--                        <p class="introduction">David later became an active supporter of the French Revolution and-->
<!--friend of Maximilien Robespierre (1758–1794), and was effectively a dictator of the arts under-->
<!--                            the French Republic. Imprisoned after Robespierre's fall from power, he aligned himself with-->
<!--                            yet another political regime upon his release, that of Napoleon I. </p>-->
<!--                        <a class="btn btn-outline-primary" href="details.html" role="button">View Details</a>-->
<!--                    </figcaption>-->
<!--                </figure>-->
<!--            </div>-->
<!--            <div class="col-sm">-->
<!--                <figure>-->
<!--                    <img src="images/artists/square-medium/8.jpg" class="border border-primary rounded-circle"/>-->
<!--                    <figcaption>-->
<!--                        <h5 class="m-3 name">Portrait of Jacques-Louis David</h5>-->
<!--                        <p class="introduction">It was at this time that he developed his Empire style, notable for-->
<!--                            its use of warm Venetian colours. David had a huge number of pupils, making him the strongest-->
<!--                            influence in French art of the early 19th century, especially academic Salon painting.</p>-->
<!--                        <a class="btn btn-outline-primary" href="details.html" role="button">View Details</a>-->
<!--                    </figcaption>-->
<!--                </figure>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</main>
<footer class="footer navbar navbar-dark bg-dark">
    <div class="navbar-text m-auto">Produced and maintained by HNoodles in 2018</div>
</footer>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/jsSignIn.js"></script>
<script src="js/jsIndex.js"></script>
</body>
</html>
