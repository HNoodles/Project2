<?php

// get variables
$userID = isset($_GET['userID']) ? $_GET['userID']:null;
$totalPrice = isset($_GET['totalPrice']) ? $_GET['totalPrice']:null;
$balance = isset($_GET['balance']) ? $_GET['balance']:null;
$date = date('y-m-d h:i:s', time());

// connect the database
include_once "connect.php";

// get art works in user's cart
$sqlCart = "SELECT * FROM carts WHERE userID = $userID";
$resultCart = $connection->query($sqlCart);

// current price count
$currentPrice = 0;

// response
$response = "";

// every work in the cart
while ($rowCart = $resultCart->fetch_array()) {

    // find the work in artworks
    $sqlWork = "SELECT * FROM artworks";
    $resultWork = $connection->query($sqlWork);
    while ($rowWork = $resultWork->fetch_array()) {
        if ($rowWork['artworkID'] == $rowCart['artworkID']) {
            break;
        }
    }

    // release result
    $resultWork->close();

    if ($rowWork['orderID'] != NULL) {// work has been bought by others
        $response = "workBought";

        // delete the work from the user's cart list
        $sqlDelete = "DELETE FROM carts WHERE (artworkID = ".$rowWork['artworkID'].") AND (userID = $userID)";
        $connection->query($sqlDelete);
    }

    // add to the total price
    $currentPrice += $rowWork['price'];
}

// release result
$resultCart->close();

if ($response == "workBought") {// work has been bought by others
    echo "Some works in your cart have been bought. Please refresh the page.";
} else if ($currentPrice != $totalPrice) {// work's price has been changed
    echo "Some works' price has been changed. Please refresh the page.";
} else {// every thing clear
    // add to orders
    $sqlOrder = "INSERT INTO orders (`ownerID`, `sum`, `timeCreated`) 
VALUES ('$userID', '$currentPrice', '$date')";
    if ($connection->query($sqlOrder)) {// add to order successfully
        // get order id
        $sqlOrderID = "SELECT * FROM orders ORDER BY timeCreated DESC";
        $resultOrderID = $connection->query($sqlOrderID);
        while ($rowOrderID = $resultOrderID->fetch_array()) {
            if ($rowOrderID['ownerID'] == $userID) {
                break;
            }
        }

        // release result
        $resultOrderID->close();

        // add orderID to sold artworks
        $resultCart = $connection->query($sqlCart);
        // every work in the cart
        while ($rowCart = $resultCart->fetch_array()) {
            // find the work in artworks
            $resultWork = $connection->query($sqlWork);
            while ($rowWork = $resultWork->fetch_array()) {
                if ($rowWork['artworkID'] == $rowCart['artworkID']) {
                    break;
                }
            }

            // release result
            $resultWork->close();

            // add orderID to the work
            $sqlArtworks = "UPDATE artworks SET orderID = ".$rowOrderID['orderID']." WHERE artworkID = ".$rowWork['artworkID'];
            $connection->query($sqlArtworks);
        }

        // delete user's cart
        $sqlDeleteAll = "DELETE FROM carts WHERE userID = $userID";
        $connection->query($sqlDeleteAll);

        // update balance
        $balance = $balance - $currentPrice;
        $sqlBalance = "UPDATE users SET balance = $balance WHERE userID = $userID";
        $connection->query($sqlBalance);

        // response ajax
        echo "Bought successfully! Please refresh the page.";
    } else {// add to order failed
        echo "Unexpected error occurred! Please try again.";
    }
}
