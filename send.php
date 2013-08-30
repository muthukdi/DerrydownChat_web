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
    mysql_select_db("iyerDB", $db);/*
	// Check your status first to make sure that it hasn't been reset!
	// This can happen if the other user exists the app
	$query = "SELECT * FROM users;";
    $result = mysql_query($query,$db);
    while ($myrow = mysql_fetch_array($result))
    {
        if ($username == $myrow['username'])
        {
            $status = $myrow['status'];
            // Your status has been reset!
            if ($status == '0')
            {
                // Reset the values in the users table and return a reset response
                $query = "UPDATE users SET message = 'none', turn = '0', status = '0';";
                mysql_query($query,$db);
				$jason = array('result'=>'reset');
				echo json_encode($jason);
				return;
            }
            break;
        }
    }*/
    //Update your message in the database
    $query = "UPDATE users SET message='$message' WHERE username='$username';";
    mysql_query($query,$db);
    //Update your turn to 0 in the database
    $query = "UPDATE users SET turn='0' WHERE username='$username';";
    mysql_query($query,$db);
    //Update the other user's turn to 1 in the database
    $query = "UPDATE users SET turn='1' WHERE username='$otheruser';";
    mysql_query($query,$db);
	$jason = array('result'=>'sent');
	echo json_encode($jason);
    mysql_close ($db);
    return;
    
?>