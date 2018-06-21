<?php

header('Content-type:text/json;charset=utf-8');

// get values
$totalPage = $_POST['totalPage'];
$currentPage = $_POST['page'];
$pageSize = $_POST['pageSize'];
$sql = $_POST['sql'];
$sqlCommon = $sql;

// connect the database
include_once "connect.php";

// calculate values
$firstPage = 1;
$lastPage = $totalPage;
$prePage = ($currentPage > 1) ? ($currentPage - 1) : 1;
$nextPage = ($totalPage - $currentPage > 0) ? ($currentPage + 1):$totalPage;

// get the current page content
$mark = ($currentPage - 1) * $pageSize;
$sql .= " LIMIT " . $mark . "," . $pageSize;
$result = $connection->query($sql);

$rowArray = array();
while ($row = $result->fetch_array()) {
    array_push($rowArray, $row);
}

// release the result
$result->close();

// close the database
$connection->close();

// output json
echo json_encode($rowArray);
