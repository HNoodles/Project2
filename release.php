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
    <title>Release and revise</title>
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
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="release.php">Release</a>
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

        // release result
        $result->close();

        if (!isset($_GET['artworkID'])) {// release

            ?>

        <main>
            <div class="container my-3">
                <h5>Release a work</h5>
                <form id="work" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                            <span id="alertTitle" class="alert"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="artist">Artist</label>
                            <input type="text" class="form-control" id="artist" name="artist" placeholder="Artist">
                            <span id="alertArtist" class="alert"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"></textarea>
                        <span id="alertDescription" class="alert"></span>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="genre">Genre</label>
                            <input type="text" class="form-control" id="genre" name="genre" placeholder="Genre">
                            <span id="alertGenre" class="alert"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="yearOfWork">Year of work</label>
                            <input type="number" class="form-control" id="yearOfWork" name="yearOfWork" placeholder="Year of work">
                            <span id="alertYearOfWork" class="alert"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="width">Width</label>
                            <input type="number" class="form-control" id="width" name="width" placeholder="Width" min="0">
                            <span id="alertWidth" class="alert"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="height">Height</label>
                            <input type="number" class="form-control" id="height" name="height" placeholder="Height" min="0">
                            <span id="alertHeight" class="alert"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Price" min="1">
                            <span id="alertPrice" class="alert"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imageFileName" name="imageFileName"
                                   accept="image/png,image/jpeg,image/gif">
                            <label class="custom-file-label" for="imageFileName">Image file</label>
                            <span id="alertImageFileName" class="alert"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <p>Preview</p>
                        <img id="image" class="w-100" src="">
                    </div>
                    <input type="hidden" id="userID" name="userID" value="<?php echo $user['userID'] ?>">
                    <button type="button" id="btSubmit" class="btn btn-outline-primary">Submit</button>
                    <span id="alertSubmit" class="alert"></span>
                </form>
            </div>
        </main>

            <?php

        } else {// revise

            // get the work
            $sqlWork = "SELECT * FROM artworks";
            $resultWork = $connection->query($sqlWork);
            while ($work = $resultWork->fetch_array()) {
                if ($work['artworkID'] == $_GET['artworkID']) {
                    break;
                }
            }

            // release result
            $resultWork->close();

            ?>

            <main>
                <div class="container my-3">
                    <h5>Revise a work</h5>
                    <form id="work" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo $work['title'] ?>">
                                <span id="alertTitle" class="alert"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="artist">Artist</label>
                                <input type="text" class="form-control" id="artist" name="artist" placeholder="Artist" value="<?php echo $work['artist'] ?>">
                                <span id="alertArtist" class="alert"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description"><?php echo $work['description'] ?></textarea>
                            <span id="alertDescription" class="alert"></span>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="genre">Genre</label>
                                <input type="text" class="form-control" id="genre" name="genre" placeholder="Genre" value="<?php echo $work['genre'] ?>">
                                <span id="alertGenre" class="alert"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="yearOfWork">Year of work</label>
                                <input type="number" class="form-control" id="yearOfWork" name="yearOfWork" placeholder="Year of work" value="<?php echo $work['yearOfWork'] ?>">
                                <span id="alertYearOfWork" class="alert"></span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="width">Width</label>
                                <input type="number" class="form-control" id="width" name="width" placeholder="Width" min="0" value="<?php echo $work['width'] ?>">
                                <span id="alertWidth" class="alert"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="height">Height</label>
                                <input type="number" class="form-control" id="height" name="height" placeholder="Height" min="0" value="<?php echo $work['height'] ?>">
                                <span id="alertHeight" class="alert"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" placeholder="Price" min="1" value="<?php echo $work['price'] ?>">
                                <span id="alertPrice" class="alert"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imageFileName" name="imageFileName"
                                       accept="image/png,image/jpeg,image/gif">
                                <label class="custom-file-label" for="imageFileName">Image file</label>
                                <span id="alertImageFileName" class="alert"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <p>Preview</p>
                            <img id="image" class="w-100" src="resources/img/<?php echo $work['imageFileName'] ?>" alt="<?php echo $work['title'] ?>">
                        </div>
                        <input type="hidden" id="userID" name="userID" value="<?php echo $user['userID'] ?>">
                        <input type="hidden" id="artworkID" name="artworkID" value="<?php echo $work['artworkID'] ?>">
                        <button type="button" id="btSubmit" class="btn btn-outline-primary">Submit</button>
                        <span id="alertSubmit" class="alert"></span>
                    </form>
                </div>
            </main>


            <?php


        }

        // close database
        $connection->close();

    }// end of signed in

} else {
    $_SESSION['signInUserName'] = $_POST['signInUserName'];
    header("location:" . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING']);
}

?>

<footer class="footer navbar navbar-dark bg-dark">
    <div class="navbar-text m-auto">Produced and maintained by HNoodles in 2018</div>
</footer>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>
<script src="js/jsSignIn.js"></script>
<script src="js/jsSearch.js"></script>
<script src="js/jsReleaseArtWork.js"></script>
</body>
</html>
