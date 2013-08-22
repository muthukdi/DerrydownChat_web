<?php
    
    // Check if the user has provided a username
    if (isset($_GET['usernameField']))
    {
        $username = $_GET['usernameField'];
    }
    // Connect to the database
    $db = mysql_connect("localhost", "root", "quincy");
    mysql_select_db("iyerDB", $db);
    //Check if someone is already online with this username
    $query = "SELECT * FROM users;";
    $result = mysql_query($query,$db);
    while ($myrow = mysql_fetch_array($result))
    {
        if ($username == $myrow['username'])
        {
            $status = $myrow['status'];
            // If nobody is using this name
            if ($status == '0')
            {
                // Change the status of this user to online
                $query = "UPDATE users SET status='1' WHERE username='$username';";
                mysql_query($query,$db);
            }
            $jason = array('status'=>$status);
            echo json_encode($jason);
            //echo $status;
            return;
        }
    }
    // If it's neither user A nor user B, then just tell them that they
    // can't sign in with that name
    $jason = array('status'=>'1');
    echo json_encode($jason);
    //echo 1;
    mysql_close ($db);
    
?>