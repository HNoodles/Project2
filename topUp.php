<?php

echo "Processing...Please wait...";

$amount = $_GET['topUpAmount'];
$userID = $_GET['userID'];

// connect the database
include_once "connect.php";

// find the user
$sqlUser = "SELECT * FROM users";
$result = $connection->query($sqlUser);
while ($user = $result->fetch_array()) {
    if ($user['userID'] == $userID) {
        break;
    }
}

// set new balance
$newBalance = $user['balance'] + (int)$amount;
$sqlUpdate = "UPDATE users SET balance = $newBalance WHERE userID = $userID";

// update
if ($connection->query($sqlUpdate)) {// success
    header("location:profile.php");
} else {// failed
    echo "Failed unexpectedly! Please try again.";
    echo "<a href='profile.php'>Back</a>";
}
