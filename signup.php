<?php
require 'register.php';
require 'dbFNS.php';

if (!$connection = @ mysqli_connect($hostName, $userName, $password))
    die("Cannot connect");

// Clean the data collected in the <form>
// lack of two password
$signupUsername = mysqlclean($_POST, "signupUsername", 40, $connection);
$signupEmail = mysqlclean($_POST, "signupEmail", 40, $connection);
$signupGender = mysqlclean($_POST, "signupGender", 40, $connection);
$signupTruename = mysqlclean($_POST, "signupTruename", 40, $connection);
$signupHometown = mysqlclean($_POST, "signupHometown", 40, $connection);
$signupPassword = mysqlclean($_POST, "signupPassword", 40, $connection);
$signupConfirmPassword = mysqlclean($_POST, "signupConfirmPassword", 40, $connection);

// if($signupConfirmPassword != $signupPassword){ 
//     echo"<script>alert('Your confirm password should be same!');window.location.href='sign.php'</script>";
// }

date_default_timezone_set('America/New_York');
$signupTime = date("Y-m-d H:i:s");

if (!mysqli_select_db($connection, $databaseName))
    showerror();

session_start();

// Authenticate the user
if (registerUser($connection, $signupUsername, $signupEmail, $signupPassword, $signupHometown, 
        $signupTruename, $signupGender, $signupTime)) {
    // Register the loginUsername
    $_SESSION["signupUsername"] = $signupUsername;

    // // Register the IP address that started this session
    // $_SESSION["loginIP"] = $_SERVER["REMOTE_ADDR"];

    //$_SESSION["signupPassword"] = $loginPassword;
    // Relocate back to the first page of the application
    header("Location: sign.php");
    exit;

} else {
    // The authentication failed: setup a logout message
    $_SESSION["message"] =
        "Could sign up as '{$signupUsername}'";

    // Relocate to the logout page
    header("Location: 404.html");
    exit;
}
?>

