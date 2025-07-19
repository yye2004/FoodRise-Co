<?php
// Start session and destroy it to log the user out
session_start();
$_SESSION = array();
session_destroy();  // Destroys the session
header("Location: index.php"); 
exit;
?>