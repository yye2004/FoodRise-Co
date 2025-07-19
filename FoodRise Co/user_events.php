<?php
// Include necessary configuration or database connection files
include 'mysqli_connect.php';  // Ensure this file connects to the database
include 'header.php';

// Connect to the database
$dbc = mysqli_connect($host, $username, $password, $dbname);

// Get the logged-in user ID (assuming the user is logged in)
//$user_id = 9;
$user_id = $_SESSION['user_id'];  // Assuming user ID is stored in session after login

// Query to fetch future (current) events the user has signed up for
$current_events_query = "SELECT e.event_id, e.event_name, DATE_FORMAT(e.date, '%M %d, %Y') AS event_date, e.time, e.location
                         FROM events e
                         JOIN user_event ue ON e.event_id = ue.event_id
                         WHERE ue.user_id = $user_id AND e.date >= CURDATE()
                         ORDER BY e.date ASC";
$current_events_result = @mysqli_query($dbc, $current_events_query); // Execute the query for future events

// Query to fetch past events the user has signed up for
$past_events_query = "SELECT e.event_id, e.event_name, DATE_FORMAT(e.date, '%M %d, %Y') AS event_date, e.time, e.location
                      FROM events e
                      JOIN user_event ue ON e.event_id = ue.event_id
                      WHERE ue.user_id = $user_id AND e.date < CURDATE()
                      ORDER BY e.date DESC";
$past_events_result = @mysqli_query($dbc, $past_events_query); // Execute the query for past events
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - My Events</title>
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
            margin-left: 20px;
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

<div class="dashboard-title">My Volunteering Events</div>

<div class="dashboard-container">
    <?php include 'user_sidebar.php'; ?>

    <div class="main-content">

    <?php
    // Display future events
    $current_events_num = mysqli_num_rows($current_events_result);
    if ($current_events_num > 0) { 
        echo "<h2>Upcoming Events</h2>";
        echo "<p>You are currently signed up for $current_events_num upcoming event(s).</p>";
        echo '<table class="event-table">
                <tr>
                    <th>Event ID</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>';
        while ($row = mysqli_fetch_array($current_events_result, MYSQLI_ASSOC)) {
            echo '<tr>
                    <td>' . $row['event_id'] . '</td>
                    <td>' . $row['event_name'] . '</td>
                    <td>' . $row['event_date'] . '</td>
                    <td>' . $row['time'] . '</td>
                    <td>' . $row['location'] . '</td>
                    <td><a href="cancel_event.php?event_id=' . $row['event_id'] . '">Cancel Registration</a></td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo '<p>You have not signed up for any upcoming events yet.</p>';
    }

    // Display past events
    $past_events_num = mysqli_num_rows($past_events_result);
    if ($past_events_num > 0) { 
        echo "<h2>Past Events</h2>";
        echo "<p>You have participated in $past_events_num past event(s).</p>";
        echo '<table class="event-table">
                <tr>
                    <th>Event ID</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>';
        while ($row = mysqli_fetch_array($past_events_result, MYSQLI_ASSOC)) {
            echo '<tr>
                    <td>' . $row['event_id'] . '</td>
                    <td>' . $row['event_name'] . '</td>
                    <td>' . $row['event_date'] . '</td>
                    <td>' . $row['time'] . '</td>
                    <td>' . $row['location'] . '</td>
                    <td><a href="cancel_event.php?event_id=' . $row['event_id'] . '">Delete Record</a></td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo '<p>You have not signed up for any past events.</p>';
    }

    mysqli_close($dbc); // Close the connection
    ?>

    </div>
</div>

<?php
    include 'footer.php';
?>
</body>
</html>
