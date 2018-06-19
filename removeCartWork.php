<?php

echo "Processing...Please wait...";

$cartID = $_GET['cartID'];

include_once "connect.php";

$sql = "DELETE FROM carts WHERE cartID = $cartID";

if ($connection->query($sql)) {// success
    header("location:cart.php");
} else {// failed
    echo "Failed unexpectedly! Please try again.";
    echo "<a href='cart.php'>Back</a>";
}
