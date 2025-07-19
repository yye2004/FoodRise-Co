<?php 
session_start();
include 'mysqli_connect.php'; 

$user_query = "SELECT role FROM users";
$user_result = @mysqli_query($dbc, $user_query);


$_SESSION['role'] = $user['role'];

// Redirect to the appropriate dashboard based on role
if ($user['role'] == 'admin') {
    header("Location: admin_dashboard.php");
} elseif ($user['role'] == 'user') {
    header("Location: user_dashboard.php");
} else {
    echo "Unrecognized role. Please contact support.";
}


?>