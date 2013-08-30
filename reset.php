<?php
    
    // Connect to the database
    $db = mysql_connect("localhost", "root", "quincy");
    mysql_select_db("iyerDB", $db);
    //Reset the values in the users table
    $query = "UPDATE users SET message = 'none', turn = '0', status = '0';";
    mysql_query($query,$db);
    mysql_close ($db);
    
?>