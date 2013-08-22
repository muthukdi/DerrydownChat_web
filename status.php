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
            $status = $myrow['status'];
            // The other user is not online yet
            if ($status == '0')
            {
                // It's your turn!
                $query = "UPDATE users SET turn='1' WHERE username='$username';";
                mysql_query($query,$db);
            }
            $jason = array('status'=>$status);
            echo json_encode($jason);
            //echo $status;
            mysql_close ($db);
            return;
        }
    }
    
?>