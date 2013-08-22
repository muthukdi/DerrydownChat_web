<?php
    
    // Check if the user has provided a username
    if (isset($_GET['usernameField']))
    {
        $username = $_GET['usernameField'];
    }
    // Check if the user has provided a message
    if (isset($_GET['messageField']))
    {
        $message = $_GET['messageField'];
    }
    // Determine who the other user is
    if ($username == "userA") $otheruser = "userB";
    if ($username == "userB") $otheruser = "userA";
    // Connect to the database
    $db = mysql_connect("localhost", "root", "quincy");
    mysql_select_db("iyerDB", $db);
    //Uodate your message in the database
    $query = "UPDATE users SET message='$message' WHERE username='$username';";
    mysql_query($query,$db);
    //Update your turn to 0 in the database
    $query = "UPDATE users SET turn='0' WHERE username='$username';";
    mysql_query($query,$db);
    //Update the other user's turn to 1 in the database
    $query = "UPDATE users SET turn='1' WHERE username='$otheruser';";
    mysql_query($query,$db);
    mysql_close ($db);
    return;
    
?>