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

    // Formulate the SQL find the user
    $query = "INSERT INTO `user` VALUES ('{$username}', '{$truename}', '{$password}', 
        '{$email}', '{$gender}', '{$hometown}', '{$time}')";

    // Execute the query
    if (!$result = @ mysqli_query($connection, $query))
        //-------------show a window of it!!-------------
        showerror();
    else
        return true;
}


?>
