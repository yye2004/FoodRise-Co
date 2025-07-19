<?php
//to let admin view who signed up.
include 'mysqli_connect.php';  
include 'header.php';

// Connect to the database
$dbc = mysqli_connect($host, $username, $password, $dbname);

// Check if the user is an admin, otherwise redirect
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
 echo '<p class="error">You do not have permission to view this page.</p>';
 exit();
 }

// Check if event_id is provided
if (!isset($_GET['event_id'])) {
    echo "<p>No event selected.</p>";
    exit();
}

$event_id = $_GET['event_id'];

// Query to fetch event details
$event_query = "SELECT event_name, DATE_FORMAT(date, '%M %d, %Y') AS event_date, time, location
                FROM events
                WHERE event_id = $event_id";
$event_result = @mysqli_query($dbc, $event_query);

// Fetch event details
if ($event_result && mysqli_num_rows($event_result) > 0) {
    $event = mysqli_fetch_assoc($event_result);
} else {
    echo "<p>Event not found.</p>";
    exit();
}

// Query to fetch registered users for the event
$user_query = "SELECT ue.event_id, u.user_id, u.username, u.email
               FROM user_event ue
               INNER JOIN users u ON ue.user_id = u.user_id
               WHERE ue.event_id = $event_id";
$user_result = @mysqli_query($dbc, $user_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users for <?php echo $event['event_name']; ?></title>
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

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .user-table th, .user-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .user-table th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<div class="dashboard-title">Registered Users for <?php echo $event['event_name']; ?></div>

<div class="dashboard-container">
     <?php include 'admin_sidebar.php';?>

    <div class="main-content">
        <h2>Event Details</h2>
        <p><strong>Event Name:</strong> <?php echo $event['event_name']; ?></p>
        <p><strong>Event Date:</strong> <?php echo $event['event_date']; ?></p>
        <p><strong>Time:</strong> <?php echo $event['time']; ?></p>
        <p><strong>Location:</strong> <?php echo $event['location']; ?></p>

        <h2>Registered Users</h2>
        <?php
        if (mysqli_num_rows($user_result) > 0) {
            echo '<table class="user-table">
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                    </tr>';
            while ($row = mysqli_fetch_array($user_result, MYSQLI_ASSOC)) {
                echo '<tr>
                        <td>' . $row['user_id'] . '</td>
                        <td>' . $row['username'] . '</td>
                        <td>' . $row['email'] . '</td>
                      </tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No users have registered for this event.</p>';
        }

        mysqli_close($dbc); // Close the connection
        ?>
        <a href="admin_events.php">Back to Events</a>
    </div>
</div>

<?php
    include 'footer.php';
?>
</body>
</html>
