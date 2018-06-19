<?php
// connect the database
$connection = new mysqli("localhost", "root", "", "art_store");
if ($connection->connect_errno) {
    die($connection->connect_error);
}

// chinese encoding
$connection->query("set names utf8");