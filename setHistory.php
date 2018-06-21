<?php

session_start();

if (!isset($_SESSION['history'])) {// first time entered the website
    $history = array();
    array_push($history,$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
    $_SESSION['history'] = $history;
} else {// has come to the website before
    // push the current page
    array_push($_SESSION['history'],$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);

    // check if has come to this page before
    $history = array();
    foreach ($_SESSION['history'] as $value) {
        if ($value == $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']) {// back to the page
            array_push($history,$value);
            break;
        } else {// first time to the page
            array_push($history,$value);
        }
    }
    $_SESSION['history'] = $history;
}