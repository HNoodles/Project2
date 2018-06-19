<?php

// connect the database
include_once "connect.php";

// get values
$totalPage = $_GET['totalPage'];
$currentPage = $_GET['page'];
$pageSize = $_GET['pageSize'];
$sql = urldecode($_GET['sql']);
$sqlCommon = $sql;

// calculate values
$firstPage = 1;
$lastPage = $totalPage;
$prePage = ($currentPage > 1) ? ($currentPage - 1) : 1;
$nextPage = ($totalPage - $currentPage > 0) ? ($currentPage + 1):$totalPage;

// get the current page content
$mark = ($currentPage - 1) * $pageSize;
$sql .= " LIMIT " . $mark . "," . $pageSize;
$result = $connection->query($sql);

// get art work number
$totalWork = $result->num_rows;
$rowSize = 3;
$totalRow = (int)(($totalWork % $rowSize === 0) ? ($totalWork / $rowSize):($totalWork / $rowSize + 1));

$response = "";
// start of total row
for ($i = 0; $i < $totalRow; $i++) {
    $response .= '<div class="row">
        <div class="card-group text-center">';

    for ($j = 0; $j < $rowSize; $j++) {
        if ($row = $result->fetch_assoc()) {
            $response .= '<div class="card">
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

    $response .= "</div>";
    $response .= "</div>";

}// end of for total row

// release the result
$result->close();

// start of pagination

$response .= '<nav class="mt-3" aria-label="Page navigation example">
    <ul class="pagination justify-content-center">';

if ($prePage == $currentPage) {
    $response .= '<li class="page-item disabled"><a id="aFirstPage" class="page-link" href="#">First</a></li>';
    $response .= '<li class="page-item disabled"><a id="aPreviousPage" class="page-link" href="#">Previous</a></li>';
} else {
    $response .= '<li class="page-item"><a id="aFirstPage" class="page-link" href="javascript:void(0)" onclick="'.'toPage('.$firstPage.',`'.$sqlCommon.'`,'.$pageSize.','.$totalPage.')'.'">First</a></li>';
    $response .= '<li class="page-item"><a id="aPreviousPage" class="page-link" href="javascript:void(0)" onclick="'.'toPage('.$prePage.',`'.$sqlCommon.'`,'.$pageSize.','.$totalPage.')'.'">Previous</a></li>';
}

if ($nextPage == $currentPage) {
    $response .= '<li class="page-item disabled"><a id="aNextPage" class="page-link" href="#">Next</a></li>';
    $response .= '<li class="page-item disabled"><a id="aLastPage" class="page-link" href="#">Last</a></li>';
} else {
    $response .= '<li class="page-item"><a id="aNextPage" class="page-link" href="javascript:void(0)"
                                     onclick="'.'toPage('.$nextPage.',`'.$sqlCommon.'`,'.$pageSize.','.$totalPage.')'.'">Next</a></li>';
    $response .= '<li class="page-item"><a id="aLastPage" class="page-link" href="javascript:void(0)" 
                                    onclick="'.'toPage('.$lastPage.',`'.$sqlCommon.'`,'.$pageSize.','.$totalPage.')'.'">Last</a></li>';
}

$response .= '<li class="page-item">
            <form class="form-inline">
                <input id="page" class="form-control" type="number" min="1" max="'.$totalPage.'"
                       name="page" placeholder="'.$currentPage.'">
                &nbsp;/&nbsp;'.$totalPage.' Page(s)
                &nbsp;<a id="aGoToPage" class="page-link" href="javascript:void(0)"
                         onclick="'.'checkPage(`'.$sqlCommon.'`,'.$pageSize.','.$totalPage.')'.'">Go</a>
            </form>
        </li>
        </ul>
    </nav>';
// end of pagination

// close the database
$connection->close();

// response
echo $response;

