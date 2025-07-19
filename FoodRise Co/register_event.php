<?php
include ('header.php');
include('mysqli_connect.php');


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<p>You must log in to register for an event.<a href=\"login.php\">Login Now?</a></p>";
    exit();
}

// Check if event_id is passed in the URL
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    $user_id = $_SESSION['user_id'];
    
    // Check if user already registered for the event
    $check_query = "SELECT * FROM user_event WHERE user_id = $user_id AND event_id = $event_id";
    $check_result = mysqli_query($dbc, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "<p>You have already registered for this event.</p>";
    } else {
        // Insert new registration into user_event table
        $query = "INSERT INTO user_event (user_id, event_id, registration_date) VALUES ($user_id, $event_id, NOW())";
        if (mysqli_query($dbc, $query)) {
            echo "<p>Registration successful! You have been registered for the event.</p>";
        } else {
            echo "<p>Registration failed: " . mysqli_error($dbc) . "</p>";
        }
    }
} else {
    echo "<p>No event selected.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
</head>
<body>
    <a href="index.php">Go Back to Home</a>
</body>
</html>
