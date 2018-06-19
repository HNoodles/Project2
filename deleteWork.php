<?php

echo "Processing...Please wait...";

$artworkID = $_GET['artworkID'];

// connect the database
include_once "connect.php";

// delete the work
$sql = "DELETE FROM artworks WHERE artworkID = $artworkID";

if ($connection->query($sql)) {// success
    header("location:profile.php");
} else {// failed
    echo "Failed unexpectedly! Please try again.";
    echo "<a href='profile.php'>Back</a>";
}
