<?php

// set history
include_once "setHistory.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cssCommon.css">
    <title>Sign Up</title>
</head>
<body class="index">

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
                <a class="nav-link active" href="signUp.php">Sign up</a>
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

?>

<main>
    <div class="container my-3">
        <form id="signUp" method="post" action="signUpProcess.php">
            <h3 class="mb-3">Sign Up</h3>
            <div class="form-row">
                <div class="col mb-3">
                    <label for="signUpUserName">User name: </label>
                    <input type="text" class="form-control" id="signUpUserName" name="signUpUserName" aria-describedby="userNameHelpBlock" placeholder="User name" onblur="checkSignUpUserName(this.value)">
                    <small id="userNameHelpBlock" class="form-text text-muted">
                        Your user name should be at least 6 characters long, and should contain numbers and characters. Like 'HNoodles1' is ok.
                    </small>
                    <span id="alertUserName" class="alert"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="col mb-3">
                    <label for="signUpEmail">Email: </label>
                    <input type="text" class="form-control" id="signUpEmail" name="signUpEmail" aria-describedby="emailHelpBlock" placeholder="Email" onblur="checkSignUpEmail(this.value)">
                    <small id="emailHelpBlock" class="form-text text-muted">
                        Your email should be like 'name@example.com'.
                    </small>
                    <span id="alertEmail" class="alert"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="col mb-3">
                    <label for="signUpPassword">Password: </label>
                    <input type="password" class="form-control" id="signUpPassword" name="signUpPassword" aria-describedby="passwordHelpBlock" placeholder="Password" onblur="checkSignUpPassword(this.value)">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Your password should be at least 6 characters long, and shouldn't contain only numbers. Like 'Hn123456' is ok.
                    </small>
                    <span id="alertPassword" class="alert"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="col mb-3">
                    <label for="signUpPasswordConfirm">Confirm Password: </label>
                    <input type="password" class="form-control" id="signUpPasswordConfirm" name="signUpPasswordConfirm" aria-describedby="confirmPasswordHelpBlock" placeholder="Confirm password" onblur="checkSignUpPasswordConfirm(this.value)">
                    <small id="confirmPasswordHelpBlock" class="form-text text-muted">
                        Your confirmation should be just the same as your password.
                    </small>
                    <span id="alertPasswordConfirm" class="alert"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="col mb-3">
                    <label for="signUpPhone">Phone: </label>
                    <input type="text" class="form-control" id="signUpPhone" name="signUpPhone" aria-describedby="phoneHelpBlock" placeholder="Phone" onblur="checkSignUpPhone(this.value)">
                    <small id="phoneHelpBlock" class="form-text text-muted">
                        Your phone should contain 11 numbers. Like '12345678910' is ok.
                    </small>
                    <span id="alertPhone" class="alert"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="col mb-3">
                    <label for="signUpAddress">Address: </label>
                    <input type="text" class="form-control" id="signUpAddress" name="signUpAddress" aria-describedby="addressHelpBlock" placeholder="Address" onblur="checkSignUpAddress(this.value)">
                    <small id="addressHelpBlock" class="form-text text-muted">
                        Your should input your address here.
                    </small>
                    <span id="alertAddress" class="alert"></span>
                </div>
            </div>
            <button type="button" id="signUpSubmit" class="btn btn-outline-primary" data-toggle="modal" data-target="#alertModal">Submit</button>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">Sign Up Info</h5>
                </div>
                <div id="signUpInfo" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" id="signUpCommit" class="btn btn-secondary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="footer navbar navbar-dark bg-dark">
    <div class="navbar-text m-auto">Produced and maintained by HNoodles in 2018</div>
</footer>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>
<script src="js/jsSignUp.js"></script>
<script src="js/jsSearch.js"></script>
</body>
</html>
