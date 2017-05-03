<?php
    require 'dbFNS.php';
    session_start();

    if (!$connection = @ mysqli_connect($hostName, $userName, $password))
        die("Cannot connect");

    // Clean the data collected in the <form>
    $comment_content = mysqlclean($_POST, "comment", 140, $connection);
    $comment_username = $_SESSION["loginUsername"];
    $comment_pid = $_SESSION["pid_detail"];


    date_default_timezone_set('America/New_York');
    $comment_time = date("Y-m-d H:i:s");

    if (!mysqli_select_db($connection, $databaseName))
        showerror();

    $query = "INSERT INTO `comments`(username,pid,commenttime,content)VALUES ('{$comment_username}', '{$comment_pid}', '{$comment_time}', '{$comment_content}')";

//    echo "$comment_username<br>";
//    echo "$comment_pid<br>";
//    echo "$comment_time<br>";
//    echo "$comment_content<br>";
//    echo "$query<br>";


    // Execute the query
    if (!$result = @ mysqli_query($connection, $query))
        header("Location: 404.php");;

    header("Location: detail.php");
?>

