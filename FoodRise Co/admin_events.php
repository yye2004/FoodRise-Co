<?php
// Include necessary configuration or database connection files
include 'mysqli_connect.php';  // Ensure this file connects to the database
include 'header.php';

// Connect to the database
$dbc = mysqli_connect($host, $username, $password, $dbname);


// Check if the user is an admin, otherwise redirect
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo '<p class="error">You do not have permission to view this page.</p>';
    exit();
}

// Query to fetch current (future) events
$current_query = "SELECT event_id, event_name, DATE_FORMAT(date, '%M %d, %Y') AS event_date, time, location
                  FROM events
                  WHERE date >= CURDATE()
                  ORDER BY date ASC";
$current_result = @mysqli_query($dbc, $current_query); // Execute the query for current events

// Query to fetch past events
$past_query = "SELECT event_id, event_name, DATE_FORMAT(date, '%M %d, %Y') AS event_date, time, location
               FROM events
               WHERE date < CURDATE()
               ORDER BY date DESC";
$past_result = @mysqli_query($dbc, $past_query); // Execute the query for past events

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .dashboard-container {
            display: flex;
            padding: 20px;
        }

        .dashboard-title {
            font-size: 32px;
            font-weight: bold;
            margin: 30px 100px 30px 100px;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }

        .main-content {
            width: 80%;
            margin-left:20px;
            margin-top: 0px;
        }

        .event-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .event-table th, .event-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .event-table th {
            background-color: #f4f4f4;
        }

        .event-table td button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .event-table td button:hover {
            background-color: #d32f2f;
        }
        
        .event-table td a {
            color: #4CAF50;
            text-decoration: none;
        }

        .event-table td a:hover {
            text-decoration: underline;
        }

        

        .main-content button {
            font-family: 'Quicksand';
            color: #fff;
            padding: 15px 40px;
            margin-top: 20px;
            margin-bottom: 50px;
            font-size: 18px;
            background-color: #000;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.5s ease;
        }

        .main-content button:hover {
            background-color: #fff;
            color: #000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="dashboard-title">Event Management</div>

<div class="dashboard-container">
     <?php include 'admin_sidebar.php';?>

    <div class="main-content">
    
    <?php
    // Display current (future) events
    $current_num = mysqli_num_rows($current_result);
    if ($current_num > 0) { 
        echo "<h2>Upcoming Events</h2>";
        echo "<p>There are currently $current_num upcoming events.</p>";
        echo '<table class="event-table">
                <tr>
                    <th>Event ID</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>';
        while ($row = mysqli_fetch_array($current_result, MYSQLI_ASSOC)) {
            echo '<tr>
                    <td>' . $row['event_id'] . '</td>
                    <td><a href="admin_eventuser.php?event_id=' . $row['event_id'] . '">' . $row['event_name'] . '</a></td>
                    <td>' . $row['event_date'] . '</td>
                    <td>' . $row['time'] . '</td>
                    <td>' . $row['location'] . '</td>
                    <td><a href="edit_event.php?event_id=' . $row['event_id'] . '">Edit</a> | 
                        <a href="delete_event.php?event_id=' . $row['event_id'] . '">Delete</a></td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No upcoming events.</p>';
    }

    // Display past events
    $past_num = mysqli_num_rows($past_result);
    if ($past_num > 0) { 
        echo "<h2>Past Events</h2>";
        echo "<p>There are currently $past_num past events.</p>";
        echo '<table class="event-table">
                <tr>
                    <th>Event ID</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>';
        while ($row = mysqli_fetch_array($past_result, MYSQLI_ASSOC)) {
            echo '<tr>
                    <td>' . $row['event_id'] . '</td>
                    <td><a href="admin_eventuser.php?event_id=' . $row['event_id'] . '">' . $row['event_name'] . '</a></td>
                    <td>' . $row['event_date'] . '</td>
                    <td>' . $row['time'] . '</td>
                    <td>' . $row['location'] . '</td>
                    <td><a href="edit_event.php?event_id=' . $row['event_id'] . '">Edit</a> | 
                        <a href="delete_event.php?event_id=' . $row['event_id'] . '">Delete</a></td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No past events.</p>';
    }

    mysqli_close($dbc); // Close the connection
    ?>
    
    <button class="add" onclick="window.location.href='add_event.php'">Add New Event</button>    
    
    </div>
</div>

<?php
    include 'footer.php';
?>
</body>
</html>
