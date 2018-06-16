<?php
$connection = new mysqli("localhost", "root", "", "art_store");
if ($connection->connect_errno) {
    die($connection->connect_error);
}

$sql = 'select * from users order by userID';

if ($result = $connection->query($sql)) {
    //获得来自 URL 的 username 参数
    $username = isset($_GET["username"]) ? $_GET["username"]:"";

    // loop through the data
    while($row = $result->fetch_assoc()) {
        echo !($username === $row['name']);
    }

    // release the memory used by the result set
    $result->close();
}

$connection->close();