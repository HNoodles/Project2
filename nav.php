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

            <?php

            if(!isset($_POST['signInUserName'])) {
                if (!isset($_SESSION['signInUserName'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#signInFormModal" onclick="changeVerify()">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signUp.html">Sign up</a>
                    </li>

                    <?php

                } else {

                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="profile.php"><?php echo $_SESSION['signInUserName'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signOut.php?location=<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>">Sign out</a>
                    </li>
                    <?php

                }
            } else {
                $_SESSION['signInUserName'] = $_POST['signInUserName'];
                ?>

                <li class="nav-item">
                    <a class="nav-link" href="profile.php"><?php echo $_SESSION['signInUserName'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signOut.php?location=<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>">Sign out</a>
                </li>

                <?php

            }

            ?>

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