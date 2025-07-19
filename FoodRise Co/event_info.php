<?php
include('header.php');
include('mysqli_connect.php');

// Check if event_id is passed in the URL
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    
    // Fetch event details
    $query = "SELECT * FROM events WHERE event_id = $event_id";
    $result = mysqli_query($dbc, $query);
    
    // Check if event exists
    if (mysqli_num_rows($result) > 0) {
        $event = mysqli_fetch_assoc($result);
    } else {
        echo "<p>Event not found.</p>";
        exit();
    }
    
    // Fetch the count of users registered for this event
    $count_query = "SELECT COUNT(*) AS user_count FROM user_event WHERE event_id = $event_id";
    $count_result = mysqli_query($dbc, $count_query);
    $count_row = mysqli_fetch_assoc($count_result);
    $user_count = $count_row['user_count'];
    
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
    <title><?php echo $event['event_name']; ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat';
            margin: 0;
        }
        main{
            width:100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .event-card {
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            width: 40%;
            text-align: center;
            margin: 20px;
        }

        .event-card h1 {
            font-size: 24px;
            color: #333;
        }

        .event-card p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
        }

        .event-card p strong {
            color: #000;
        }

        .event-card a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .event-card a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<main>
    <div class="event-card">
        <h1><?php echo $event['event_name']; ?></h1>
        <p><strong>Description:</strong> <?php echo $event['description']; ?></p>
        <p><strong>Date:</strong> <?php echo $event['date']; ?></p>
        <p><strong>Time:</strong> <?php echo $event['time']; ?></p>
        <p><strong>Location:</strong> <?php echo $event['location']; ?></p>
        <p><strong>Created At:</strong> <?php echo $event['created_at']; ?></p>
        <p><strong>Updated At:</strong> <?php echo $event['updated_at']; ?></p>
        <p><strong>Number of Users Registered:</strong> <?php echo $user_count; ?></p>
        <a href="register_event.php?event_id=<?php echo $event['event_id']; ?>">Register Now</a>
    </div>
</main>
</body>
</html>
<?php include('footer.php');?>
