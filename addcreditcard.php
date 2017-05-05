<?php
require 'dbFNS.php';
session_start();

if (!$connection = @ mysqli_connect($hostName, $userName, $password))
    die("Cannot connect");

$card_username = $_SESSION["loginUsername"];

// Clean the data collected in the <form>


$newCardNumber = mysqlclean($_POST, "newCardNumber", 140, $connection);
$nameOnCard = mysqlclean($_POST, "nameOnCard", 140, $connection);
$CVV = mysqlclean($_POST, "CVV", 140, $connection);



if (!mysqli_select_db($connection, $databaseName))
    showerror();

$query = "INSERT INTO `creditcard`(cardnumber,nameoncard,cvv,username)VALUES ('{$newCardNumber}', '{$nameOnCard}', '{$CVV}', '{$card_username}')";

//    echo "$card_username<br>";
//    echo "$newCardNumber<br>";
//    echo "$nameOnCard<br>";
//    echo "$CVV<br>";
//    echo "$query<br>";


// Execute the query
if (!$result = @ mysqli_query($connection, $query))
    header("Location: 404.php");

header("Location: donatePage2.php?donate_amount=".$_POST['donate_amount']);
?>
