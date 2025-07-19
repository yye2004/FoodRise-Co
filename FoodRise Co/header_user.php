<?php

session_start(); // Start the session

// Include the database connection
include 'mysqli_connect.php'; // Adjust the path as necessary

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page
    header('Location: login.php');
    exit;
} else {
    // If user is logged in, fetch user role and redirect accordingly
    $role = $_SESSION['role']; // Get the user role from the session

    if ($role == 'admin') {
        // If the user is an admin, redirect to the admin dashboard
        header('Location: admin_dashboard.php');
        exit;
    } elseif ($role == 'user') {
        // If the user is a regular user, redirect to the user dashboard
        header('Location: user_dashboard.php');
        exit;
    } else {
        // If the role is unrecognized, handle it appropriately
        echo "Unrecognized role. Please contact support.";
        exit;
    }
}
?>

