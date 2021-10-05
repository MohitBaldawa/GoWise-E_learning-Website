<?php
 session_start(); 
 session_destroy(); // This will close the logged in session of user
 echo "<script> location.href='index.php'; </script>";
?>