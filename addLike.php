<?php
require 'dbFNS.php';
session_start();

if (!$connection = @ mysqli_connect($hostName, $userName, $password))
    die("Cannot connect");

$like_pid = $_SESSION["pid_detail"];
$like_username = $_SESSION["loginUsername"];


if (!mysqli_select_db($connection, $databaseName))
    showerror();

$query = "INSERT INTO `likes` VALUES ('{$like_username}', '{$like_pid}')";

//    echo "$comment_username<br>";
//    echo "$comment_pid<br>";
//    echo "$comment_time<br>";
//    echo "$comment_content<br>";
//    echo "$query<br>";


// Execute the query
if (!$result = @ mysqli_query($connection, $query))
    header("Location: 404.php");

header("Location: detail.php?pid_detail= $like_pid");
?>
