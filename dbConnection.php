<?php

// For Development connection in localhost (local machine)
 //$db_host = "localhost:3307";
 //$db_user = "root";
 //$db_password = "";
 //$db_name = "lms_db";

// Remote Database Connection
 $db_host = "sql6.freemysqlhosting.net";
 $db_user = "sql6464366";
 $db_password = "5y1sn4jmlc";
 $db_name = "sql6464366";

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
