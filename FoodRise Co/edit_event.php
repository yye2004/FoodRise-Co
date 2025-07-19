<?php
include('header.php');

require('mysqli_connect.php'); ?>
<style>
    body {
        margin: 0;
    }

    /* Dashboard Styles */
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

    /* Form Styling */
    form {
        font-family: 'Montserrat';
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-width: 600px;
        margin: auto;
    }

    label {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="date"],
    input[type="time"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 30px;
        font-size: 16px;
        font-family: 'Montserrat';
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
    }

    button[type="submit"] {
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

    button[type="submit"]:hover {
        background-color: #fff;
        color: #000;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .error {
        color: red;
        font-size: 14px;
    }
/* Success message and Back button */
    .success{
        width:90%;
        margin: 20 0 20 0;
        padding: 15px;
        background-color: #4CAF50;
        color: white;
        border-radius: 10px;
        text-align: start;
        font-size: 16px;
        }
        
        
.success a{
        color: white;
        }
    
   
    }
</style>



<?php 
echo '<div class="dashboard-title">Edit Event</div>';

echo '<div class="dashboard-container">';
include 'admin_sidebar.php'; ?>

<div class="main-content">

<?php 

// Check for a valid event ID via GET or POST
if (isset($_GET['event_id']) && is_numeric($_GET['event_id'])) { // Check for event_id in URL
    $id = intval($_GET['event_id']);
    $q = "SELECT event_name, description, date, time, location FROM events WHERE event_id=$id";
    $r = @mysqli_query($dbc, $q);
    
    if (mysqli_num_rows($r) == 1) {
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    } else {
        echo '<p class="error">This event does not exist.</p>';
        exit();
    }
} elseif (isset($_POST['event_id']) && is_numeric($_POST['event_id'])) {
    // Handle form submission and set the event_id from POST
    $id = intval($_POST['event_id']);
} else {
    echo '<p class="error">This page has been accessed in error.</p>';
    exit();
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();
    
    // Validate event name
    if (empty($_POST['event_name'])) {
        $errors[] = 'You forgot to enter the event name.';
    } else {
        $event_name = mysqli_real_escape_string($dbc, trim($_POST['event_name']));
    }
    
    // Validate description
    if (empty($_POST['description'])) {
        $errors[] = 'You forgot to enter the event description.';
    } else {
        $description = mysqli_real_escape_string($dbc, trim($_POST['description']));
    }
    
    // Validate event date
    if (empty($_POST['date'])) {
        $errors[] = 'You forgot to enter the event date.';
    } else {
        $date = mysqli_real_escape_string($dbc, trim($_POST['date']));
    }
    
    // Validate event time
    if (empty($_POST['time'])) {
        $errors[] = 'You forgot to enter the event time.';
    } else {
        $time = mysqli_real_escape_string($dbc, trim($_POST['time']));
    }
    
    // Validate event location
    if (empty($_POST['location'])) {
        $errors[] = 'You forgot to enter the event location.';
    } else {
        $location = mysqli_real_escape_string($dbc, trim($_POST['location']));
    }
    
    // If there are no errors, update the event
    if (empty($errors)) {
        $q = "UPDATE events SET event_name='$event_name', description='$description', date='$date', time='$time', location='$location' WHERE event_id=$id";
        $r = @mysqli_query($dbc, $q);
        
        if ($r) {
            echo '<div class="success">Event updated successfully. <a href="admin_events.php">Back To Events?</a></div>';
        } else {
            echo '<p class="error">The event could not be updated due to a system error.</p>';
            echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message
        }
    } else {
        // Display errors
        echo '<p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p>';
    }
}

mysqli_close($dbc);
?>


    <form action="edit_event.php" method="post">
        <input type="hidden" name="event_id" value="<?= htmlspecialchars($id) ?>">

        <!-- Event Name -->
        <label for="event_name">Event Name:</label>
        <input type="text" id="event_name" name="event_name" value="<?= htmlspecialchars($row['event_name'] ?? '') ?>" required>

        <!-- Event Description -->
        <label for="description">Event Description:</label>
        <textarea id="description" name="description" rows="4" cols="50" required><?= htmlspecialchars($row['description'] ?? '') ?></textarea>

        <!-- Event Date -->
        <label for="date">Event Date:</label>
        <input type="date" id="date" name="date" value="<?= htmlspecialchars($row['date'] ?? '') ?>" required>

        <!-- Event Time -->
        <label for="time">Event Time:</label>
        <input type="time" id="time" name="time" value="<?= htmlspecialchars($row['time'] ?? '') ?>" required>

        <!-- Event Location -->
        <label for="location">Event Location:</label>
        <input type="text" id="location" name="location" value="<?= htmlspecialchars($row['location'] ?? '') ?>" required>

        <!-- Submit Button -->
        <button type="submit" name="submit">Update Event</button>
    </form>
</div>

<?php 
echo '</div>';
include ('footer.php'); ?>
