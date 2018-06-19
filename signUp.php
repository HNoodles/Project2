<?php

// get sign up information
$username = isset($_POST["signUpUserName"]) ? $_POST["signUpUserName"]:"";
$email = isset($_POST["signUpEmail"]) ? $_POST["signUpEmail"]:"";
$password = isset($_POST["signUpPassword"]) ? $_POST["signUpPassword"]:"";
$tel = isset($_POST["signUpPhone"]) ? $_POST["signUpPhone"]:"";
$address = isset($_POST["signUpAddress"]) ? $_POST["signUpAddress"]:"";

// connect the database
include_once "connect.php";

$sql = "INSERT INTO users (`name`, `email`, `password`, `tel`, `address`) 
VALUES ('$username', '$email', '$password', '$tel', '$address')";

if ($connection->query($sql) === TRUE) {
    $connection->close();

    // succeed and redirect to index
    echo "Logging in... Please wait...";
    echo "<form style='display:none;' id='form1' name='form1' method='post' action='index.php'>
<input name='signInUserName' type='text' value='{$username}'/>
</form>
<script>(function (){document.form1.submit()})();</script>";
}else {
    $connection->close();
    echo "Sorry, signed up failed unexpectedly! Please try again.";
    header("location:signUp.html");
}


