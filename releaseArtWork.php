<?php

// get values
$artworkID = isset($_POST['artworkID']) ? $_POST['artworkID']:"";

$userID = $_POST['userID'];
$title = $_POST['title'];
$artist = $_POST['artist'];
$description = $_POST['description'];
$genre = $_POST['genre'];
$yearOfWork = $_POST['yearOfWork'];
$width = $_POST['width'];
$height = $_POST['height'];
$price = $_POST['price'];

// connect database
include_once "connect.php";

if ($artworkID == ""){// release
    $imageFileName = $_FILES['imageFileName']['name'];
    // store the image
    $tempPath = $_FILES['imageFileName']['tmp_name'];
    $savePath = 'resources/img/'.$imageFileName;

    move_uploaded_file($tempPath, $savePath);

    $sql = "INSERT INTO artworks (`artist`, `imageFileName`, `title`, `description`, `yearOfWork`, `genre`, `width`, `height`, `price`, `ownerID`) 
VALUES ('$artist','$imageFileName','$title','$description','$yearOfWork','$genre','$width','$height','$price','$userID')";
} else {// revise
    // if has new image
    if ($_FILES['imageFileName']['name'] != "") {
        $imageFileName = $_FILES['imageFileName']['name'];
        // store the image
        $tempPath = $_FILES['imageFileName']['tmp_name'];
        $savePath = 'resources/img/'.$imageFileName;

        move_uploaded_file($tempPath, $savePath);
    }



    // find the original info
    $sqlOrigin = "SELECT * FROM artworks";
    $resultOrigin = $connection->query($sqlOrigin);
    while ($origin = $resultOrigin->fetch_array()) {
        if ($origin['artworkID'] == $artworkID) {
            break;
        }
    }

    // release result
    $resultOrigin->close();

    // compose sql of update
    $sql = "UPDATE artworks SET ";

    if ($title != $origin['title']) {
        $sql .= "title = '$title', ";
    }
    if ($artist != $origin['artist']) {
        $sql .= "artist = '$artist', ";
    }
    if ($description != $origin['description']) {
        $sql .= "description = '$description', ";
    }
    if ($yearOfWork != $origin['yearOfWork']) {
        $sql .= "yearOfWork = $yearOfWork, ";
    }
    if ($genre != $origin['genre']) {
        $sql .= "genre = '$genre', ";
    }
    if ($width != $origin['width']) {
        $sql .= "width = $width, ";
    }
    if ($height != $origin['height']) {
        $sql .= "height = $height, ";
    }
    if ($price != $origin['price']) {
        $sql .= "price = $price, ";
    }

    if ($_FILES['imageFileName']['name'] != "") {
        if ($imageFileName != $origin['imageFileName']) {
            $sql .= "imageFileName = '$imageFileName', ";
            // delete original file
            unlink("resources/img/".$origin['imageFileName']);
        }
    }

    // cut the last comma
    $posSpace = strrpos($sql,",");
    $sql = substr($sql,0,$posSpace);

    $sql .= " WHERE artworkID = $artworkID";
}


if ($connection->query($sql)) {
    $connection->close();
    echo "Succeeded!";
} else {
    $connection->close();
    echo "Failed! Please try again.".$sql;
}
