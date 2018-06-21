<?php

// set history
include_once "setHistory.php";

// connect the database
include_once "connect.php";

if (isset($_GET['searchText']) && isset($_GET['searchBy'])) {
    // get text and filter
    $searchText = $_GET['searchText'];
    $searchBy = $_GET['searchBy'];

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cssCommon.css">
    <link rel="stylesheet" href="css/cssSearch.css">
    <title>Search for <?php echo $searchText ?></title>
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

            <?php

            if(!isset($_POST['signInUserName'])) {
                if (!isset($_SESSION['signInUserName'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" data-toggle="modal" data-target="#signInFormModal" onclick="changeVerify()">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signUp.php">Sign up</a>
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
                        <a class="nav-link" href="release.php">Release</a>
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
                    <a class="nav-link" href="release.php">Release</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signOut.php?location=<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>">Sign out</a>
                </li>
                <?php
            }
            ?>
        </ul>
        <form id="search" class="form-inline my-2 my-lg-0" method="get" action="search.php">
            <input id="searchText" class="form-control mr-sm-2" type="search" name="searchText" placeholder="Search here" aria-label="Search" value="<?php echo $searchText ?>">
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

// insert sign in modal
include_once "signInModal.php";

?>

<main class="search">
    <h5>Search Results FOR "<?php echo $searchText ?>" BY <?php foreach ($searchBy as $value) {echo $value." ";} ?>:</h5>


    <?php

    // splice sql string
    $sql = "SELECT * FROM artworks WHERE (";
    foreach ($searchBy as $value) {
        $sql .= "$value like '%$searchText%' OR ";
    }
    $posSpace = strrpos($sql," OR");
    $sql = substr($sql,0,$posSpace).")";
    $sql .= " AND orderID IS NULL";

    if (isset($_POST['filter'])) {// sort by is set
        // get sort by filter value
        $sortBy = $_POST['filter'];

        $sql .= " ORDER BY $sortBy";

        if ($sortBy == "price") {// price checked

        ?>

        <form id="sort" name="sort" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>">
            Sort by:
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filter" id="filterPrice" value="price" checked>
                <label class="form-check-label" for="filterPrice">Price</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filter" id="filterView" value="view">
                <label class="form-check-label" for="filterView">View</label>
            </div>
        </form>

        <?php

        } else if ($sortBy == "view") {// view checked

            ?>

            <form id="sort" name="sort" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>">
                Sort by:
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="filterPrice" value="price">
                    <label class="form-check-label" for="filterPrice">Price</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="filterView" value="view" checked>
                    <label class="form-check-label" for="filterView">View</label>
                </div>
            </form>

            <?php

        }
    } else {// sort by not set

        ?>

        <form id="sort" name="sort" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'] ?>">
            Sort by:
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filter" id="filterPrice" value="price">
                <label class="form-check-label" for="filterPrice">Price</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="filter" id="filterView" value="view">
                <label class="form-check-label" for="filterView">View</label>
            </div>
        </form>

        <?php

    }

    // get search result all
    $result = $connection->query($sql);

    // keep the sql without limit
    $sqlCommon = $sql;

    // divide the page according to the result
    if ($result)
        $totalCount = $result->num_rows;
    else
        $totalCount = 0;

    if ($totalCount == 0){
        echo "<h1 class='text-center'>No Result!</h1>";
    } else {
        $pageSize = 9;
        $totalPage = (int)(($totalCount % $pageSize === 0) ? ($totalCount / $pageSize):($totalCount / $pageSize + 1));

        if (!isset($_GET['page']))
            $currentPage = 1;
        else
            $currentPage = $_GET['page'];

        $firstPage = 1;
        $lastPage = $totalPage;
        $prePage = ($currentPage > 1) ? ($currentPage - 1) : 1;
        $nextPage = ($totalPage - $currentPage > 0) ? ($currentPage + 1) : $totalPage;

        ?>

        <div id="searchResult">

            <?php

            // get the current page content
            $mark = ($currentPage - 1) * $pageSize;
            $sql .= " LIMIT " . $mark . "," . $pageSize;
            $result = $connection->query($sql);

            // get art work number
            $totalWork = $result->num_rows;
            $rowSize = 3;
            $totalRow = (int)(($totalWork % $rowSize === 0) ? ($totalWork / $rowSize):($totalWork / $rowSize + 1));

            for ($i = 0; $i < $totalRow; $i++) {

                ?>

                <div class="row">
                    <div class="card-group text-center">

                        <?php

                        for ($j = 0; $j < $rowSize; $j++) {
                            if ($row = $result->fetch_assoc()) {
                                echo '<div class="card">
                            <img class="card-img-top" src="resources/img/'.$row['imageFileName'].'" alt="'.$row['title'].'">
                            <div class="card-body">
                                <h5 class="card-title">'.$row['title'].'</h5>
                                <p class="card-text">'.$row['description'].'</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Price: <span class="badge badge-primary">'.$row['price'].'</span></li>
                                <li class="list-group-item">View: <span class="badge badge-primary">'.$row['view'].'</span></li>
                            </ul>
                            <div class="card-footer">
                                <a href="details.php?artworkID='.$row['artworkID'].'" class="btn btn-outline-primary">More Details</a>
                            </div>
                        </div>';
                            }
                        }

                        ?>

                    </div>
                </div>

                <?php

            }// end of for total row

            ?>

            <nav class="mt-3" aria-label="Page navigation example">
                <ul class="pagination justify-content-center">

                    <?php

                    if ($prePage == $currentPage) {
                        echo '<li class="page-item disabled"><a id="aFirstPage" class="page-link" href="#">First</a></li>
                               <li class="page-item disabled"><a id="aPreviousPage" class="page-link" href="#">Previous</a></li>';
                    } else {

                        ?>
                        <li class="page-item"><a id="aFirstPage" class="page-link" href="javascript:void(0)"
                                                 onclick="ajaxToPage(1,<?php echo '`'.$sqlCommon.'`'.','.$pageSize.','.$totalPage ?>)">First</a></li>
                        <li class="page-item"><a id="aPreviousPage" class="page-link" href="javascript:void(0)"
                                                 onclick="ajaxToPage(<?php echo $prePage.','.'`'.$sqlCommon.'`'.','.$pageSize.','.$totalPage ?>)">Previous</a></li>
                        <?php

                    }

                    if ($nextPage == $currentPage) {
                        echo '<li class="page-item disabled"><a id="aNextPage" class="page-link" href="#">Next</a></li>
                                <li class="page-item disabled"><a id="aLastPage" class="page-link" href="#">Last</a></li>';
                    } else {

                        ?>
                        <li class="page-item"><a id="aNextPage" class="page-link" href="javascript:void(0)"
                                                 onclick="ajaxToPage(<?php echo $nextPage.',`'.$sqlCommon.'`,'.$pageSize.','.$totalPage ?>)" >Next</a></li>
                        <li class="page-item"><a id="aLastPage" class="page-link" href="javascript:void(0)"
                                                 onclick="ajaxToPage(<?php echo $lastPage.','.'`'.$sqlCommon.'`'.','.$pageSize.','.$totalPage ?>)">Last</a></li>
                        <?php

                    }

                    ?>

                    <li class="page-item">
                        <form class="form-inline">
                            <input id="page" class="form-control" type="number" min="1" max="<?php echo $totalPage ?>"
                                   name="page" placeholder="<?php echo $currentPage ?>">
                            &nbsp;/&nbsp;<?php echo $totalPage; ?> Page(s)
                            &nbsp;<a id="aGoToPage" class="page-link" href="javascript:void(0)"
                                     onclick="checkPage(<?php echo '`'.$sqlCommon.'`'.','.$pageSize.','.$totalPage ?>)">Go</a>
                        </form>
                    </li>
                </ul>
            </nav>

        </div>

        <?php

    }// end of has search result

    ?>

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
<script src="js/jsSort.js"></script>
<script src="js/jsPagination.js"></script>

    <?php

    // release the result
    $result->close();

} else {// search by or search text not set

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cssCommon.css">
    <link rel="stylesheet" href="css/cssSearch.css">
    <title>Search</title>
</head>
<body>

<?php

// insert nav
include_once "nav.php";

// insert sign in modal
include_once "signInModal.php";

?>

<main>
    <div class="text-center">
        <h1>Oops! Unexpected error occurred!</h1>
        <h1>Can't find the result! Please try again.</h1>
    </div>
</main>

<footer class="footer navbar navbar-dark bg-dark">
    <div class="navbar-text m-auto">Produced and maintained by HNoodles in 2018</div>
</footer>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/jsSignIn.js"></script>

    <?php

}

// close the database
$connection->close();

?>

</body>
</html>
