<?php
    
    // Check if the user has provided a username
    if (isset($_GET['usernameField']))
    {
        $username = $_GET['usernameField'];
    }
    // Determine who the other user is
    if ($username == "userA") $otheruser = "userB";
    if ($username == "userB") $otheruser = "userA";
    // Connect to the database
    $db = mysql_connect("localhost", "root", "quincy");
    mysql_select_db("iyerDB", $db);
    //Check the status of the other user
    $query = "SELECT * FROM users;";
    $result = mysql_query($query,$db);
    while ($myrow = mysql_fetch_array($result))
    {
        if ($otheruser == $myrow['username'])
        {
            $turn = $myrow['turn'];
            // The other user has finished sending their message
            // so it's no longer their turn.
            if ($turn == '0')
            {
                // Retrieve their latest message
                $message =  $myrow['message'];
                $jason = array('message'=>$message);
                // Update your turn to 1
                $query = "UPDATE users SET turn='1' WHERE username='$username';";
                mysql_query($query,$db);
                echo json_encode($jason);
                //echo $turn;
                mysql_close ($db);
            }
            // It's still their turn
            else
            {
                $jason = array('message'=>$turn);
                echo json_encode($jason);
                //echo $turn;
                mysql_close ($db);
            }
        }
    }
    
?>