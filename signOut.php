<?php

// destroy session
$_SESSION = array();
setcookie(session_name(), '', time() - 2592000, '/');
session_destroy();

// redirect
if (isset($_GET['location'])) {
    header("location:".$_GET['location']);
} else {
    header("location:index.php");
}


