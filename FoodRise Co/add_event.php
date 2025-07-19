 /
<?php
include 'header.php';
require('mysqli_connect.php'); ?>
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
        
        form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    max-width: 600px;
    margin: auto;
}

/* Label styling */
label {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
}

/* Input and textarea styling */
input[type="text"],
input[type="date"],
input[type="time"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 50px;
    font-size: 16px;
    font-family: 'Montserrat';
    box-sizing: border-box;
}

textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 30px;
    font-size: 16px;
    font-family: 'Montserrat';
    box-sizing: border-box;
}

/* Textarea styling */
textarea {
    resize: vertical;
}

/* Button styling */
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

/* Error message styling */
.error {
    color: red;
    font-size: 14px;
}

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
        
</style>


<?php 

echo '<div class="dashboard-title">Add New Event</div>';

echo '<div class="dashboard-container">';
include 'admin_sidebar.php'; ?>
<div class="main-content">
<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_event'])) {
    $errors = array();
    
    // Validate event name
    if (empty($_POST['event_name'])) {
        $errors[] = 'You forgot to enter the event name.';
    } else {
        $event_name = mysqli_real_escape_string($dbc, trim($_POST['event_name']));
    }
    
    // Validate event description
    if (empty($_POST['event_description'])) {
        $errors[] = 'You forgot to enter the event description.';
    } else {
        $event_description = mysqli_real_escape_string($dbc, trim($_POST['event_description']));
    }
    
    // Validate event date
    if (empty($_POST['event_date'])) {
        $errors[] = 'You forgot to enter the event date.';
    } else {
        $event_date = mysqli_real_escape_string($dbc, trim($_POST['event_date']));
    }
    
    // Validate event time
    if (empty($_POST['event_time'])) {
        $errors[] = 'You forgot to enter the event time.';
    } else {
        $event_time = mysqli_real_escape_string($dbc, trim($_POST['event_time']));
    }
    
    // Validate event location
    if (empty($_POST['event_location'])) {
        $errors[] = 'You forgot to enter the event location.';
    } else {
        $event_location = mysqli_real_escape_string($dbc, trim($_POST['event_location']));
    }
    
    // If there are no errors, insert the event into the database
    if (empty($errors)) {
        $q = "INSERT INTO events (event_name, description, date, time, location) VALUES ('$event_name', '$event_description', '$event_date', '$event_time', '$event_location')";
        $r = @mysqli_query($dbc, $q);
        
        if ($r) {
            echo '<p class="success">Event added successfully. <a href="admin_events.php">Back To Events?</a></p>';
        } else {
            echo '<p class="error">The event could not be added due to a system error.</p>';
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


        <form action="add_event.php" method="POST">
            <!-- Event Name -->
        <label for="event_name">Event Name:</label>
        <input type="text" id="event_name" name="event_name" placeholder="Event Name" required>
    
        <!-- Event Description -->
        <label for="event_description">Event Description:</label>
        <textarea id="event_description" name="event_description" placeholder="Event Description" rows="4" cols="50" required></textarea>
    
        <!-- Event Date -->
        <label for="event_date">Event Date:</label>
        <input type="date" id="event_date" name="event_date" required>
    
        <!-- Event Time -->
        <label for="event_time">Event Time:</label>
        <input type="time" id="event_time" name="event_time" required>
    
        <!-- Event Location -->
        <label for="event_location">Event Location:</label>
        <input type="text" id="event_location" name="event_location" placeholder="Event Location" required>

        <!-- Submit Button -->
        <button type="submit" name="add_event">Add Event</button>
    </form>
</div>

<?php 
echo '</div>';
include ('footer.php'); ?>
