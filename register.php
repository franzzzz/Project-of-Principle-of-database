<?php

/**
 * @param $connection
 * @param $username
 * @param $password
 * @return bool
 */
function registerUser($connection, $username, $email, $password, $hometown, 
        $truename, $gender, $time)
{
    // Test the username and password parameters
    if (!isset($username) || !isset($gender))
        return false;

    //echo date("Y-m-d H:i:s");

    // if (!isset($hometown) && !isset(truename))
    //     $query = "INSERT INTO `user` VALUES ('{$username}', null, '{$password}', 
    //     '{$email}', '{$gender}', null, '2014-01-03 12:04:23')";
    // else if (!isset($hometown) && isset(truename))
    //     $query = "INSERT INTO `user` VALUES ('{$username}', '{$truename}', '{$password}', 
    //     '{$email}', '{$gender}', null, '2014-01-03 12:04:23')";
    // else if (!isset($hometown) && !isset(truename))
    //     $query = "INSERT INTO `user` VALUES ('{$username}', null, '{$password}', 
    //     '{$email}', '{$gender}', '{$hometown}', '2014-01-03 12:04:23')";

    // Formulate the SQL find the user
    else $query = "INSERT INTO `user` VALUES ('{$username}', '{$truename}', '{$password}', 
        '{$email}', '{$gender}', '{$hometown}', '{$time}')";

    // Execute the query
    if (!$result = @ mysqli_query($connection, $query))
        //-------------show a window of it!!-------------
        showerror();
    else
        return true;
}


?>
