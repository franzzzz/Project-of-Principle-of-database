<?php

/**
 * @param $connection
 * @param $username
 * @param $password
 * @return bool
 */
function authenticateUser($connection, $username, $password)
{
    // Test the username and password parameters
    if (!isset($username))
        return false;

    // Create a digest of the password collected from
    // the challenge

    // Formulate the SQL find the user
    $query = "SELECT username FROM user WHERE username = '{$username}' AND password = '{$password}'";

    // Execute the query
    if (!$result = @ mysqli_query($connection, $query))
        showerror();

    // exactly one row? then we have found the user
    if (mysqli_num_rows($result) != 1)
        return false;
    else
        return true;
}

// Connects to a session and checks that the user has
// authenticated and that the remote IP address matches
// the address used to create the session.
function sessionAuthenticate()
{
    // Check if the user hasn't logged in
    if (!isset($_SESSION["loginUsername"])) {
        // The request does not identify a session
        $_SESSION["message"] = "You are not authorized to access the URL 
                            {$_SERVER["REQUEST_URI"]}";

        header("Location: logout.php");
        exit;
    }

    // // Check if the request is from a different IP address to previously
    // if (!isset($_SESSION["loginIP"]) ||
    //     ($_SESSION["loginIP"] != $_SERVER["REMOTE_ADDR"])
    // ) {
    //     // The request did not originate from the machine
    //     // that was used to create the session.
    //     // THIS IS POSSIBLY A SESSION HIJACK ATTEMPT

    //     $_SESSION["message"] = "You are not authorized to access the URL 
    //                         {$_SERVER["REQUEST_URI"]} from the address 
    //                         {$_SERVER["REMOTE_ADDR"]}";

    //     header("Location: logout.php");
    //     exit;
    // }
}

?>
