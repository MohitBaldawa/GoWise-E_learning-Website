<?php

// For Development connection in localhost (local machine)
 //$db_host = "localhost:3307";
 //$db_user = "root";
 //$db_password = "";
 //$db_name = "lms_db";

// Remote Database Connection
 $db_host = "remotemysql.com";
 $db_user = "3zLkwr6ptq";
 $db_password = "OypWImdkpx";
 $db_name = "3zLkwr6ptq";

// Create Connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check Connection
if($conn->connect_error) {
 die("connection failed");
} 
// else {
//  echo"connected";
// }
?>
