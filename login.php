<?php
session_start();
require 'authenticationFNS.php';
require 'dbFNS.php';



if (!$connection = @ mysqli_connect($hostName, $userName, $password))
    die("Cannot connect");

// Clean the data collected in the <form>
$loginUsername = mysqlclean($_POST, "loginUsername", 40, $connection);
$loginPassword = mysqlclean($_POST, "loginPassword", 40, $connection);

if (!mysqli_select_db($connection, $databaseName))
    showerror();



// Authenticate the user
if (authenticateUser($connection, $loginUsername, $loginPassword)) {
    // Register the loginUsername
    $_SESSION["loginUsername"] = $loginUsername;
    //$_SESSION["loginTime"] = getCreatetime($connecton, $loginUsername);

    $_SESSION["loginPassword"] = $loginPassword;

    // Relocate back to the first page of the application
    header("Location: project.php");
    exit;

} else {
    // The authentication failed: setup a logout message
    $_SESSION["message"] =
        "Could not connect to the application as '{$loginUsername}'";

    // Relocate to the logout page
    header("Location: 404.php");
    exit;
}
?>

