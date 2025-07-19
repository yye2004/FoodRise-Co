<?php
include('header.php');
require('mysqli_connect.php');?>
<html>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
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
        text-align: center;
    }
    
    /* Success Message */
    .success {
        width: 90%;
        margin: 20px 0;
        padding: 15px;
        background-color: #4CAF50;
        color: white;
        border-radius: 10px;
        text-align: start;
        font-size: 16px;
    }

    .success a {
        color: white;
        text-decoration: underline;
    }

    /* Confirmation Card */
    .confirmation-card {
        width: 60%;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .confirmation-card h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .confirmation-card p {
        font-size: 18px;
        margin-bottom: 30px;
    }

    .confirmation-card button {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        margin: 0 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .confirmation-card .yes {
        background-color: #FF5733;
        color: white;
    }

    .confirmation-card .yes:hover {
        background-color: #D9452F;
    }

    .confirmation-card .no {
        background-color: #4CAF50;
        color: white;
    }

    .confirmation-card .no:hover {
        background-color: #45a049;
    }
</style>



<?php 

echo '<div class="dashboard-title">Cancel Event Registration / Delete Record </div>';

echo '<div class="dashboard-container">';
include 'user_sidebar.php'; ?>

<div class="main-content">

<?php 



if (!isset($_SESSION['user_id'])) {
    echo '<p class="error">You must be logged in to delete / cancel an event registration.</p>';
    exit();
}


$user_id = $_SESSION['user_id'];

// Check if event_id is passed via GET
if (isset($_GET['event_id']) && is_numeric($_GET['event_id'])) {
    $event_id = intval($_GET['event_id']);
    
    // Fetch event details to display event name
    $q = "SELECT event_name FROM events WHERE event_id=$event_id";
    $r = @mysqli_query($dbc, $q);
    
    if ($r && mysqli_num_rows($r) == 1) {
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
        $event_name = $row['event_name'];
        
        // Show the confirmation card
        if (!isset($_GET['confirm'])) {
            // Show confirmation card
            echo '
            <div class="confirmation-card">
                <h2>Are you sure you want to delete record / cancel your registration for this event?</h2>
                <p><strong>' . htmlspecialchars($event_name) . '</strong></p>
                <a href="cancel_event.php?event_id=' . $event_id . '&confirm=yes"><button class="yes">Yes, I am sure</button></a>
                <a href="user_events.php"><button class="no">No, Go Back</button></a>
            </div>
            ';
        } elseif ($_GET['confirm'] == 'yes') {
            // Proceed with cancellation if "Yes" is clicked
            $q = "DELETE FROM user_event WHERE user_id=$user_id AND event_id=$event_id";
            $r = @mysqli_query($dbc, $q);
            
            if ($r && mysqli_affected_rows($dbc) == 1) {
                echo '<div class="success">Your registration/record for the event has been deleted successfully. <a href="user_events.php">Back to My Events?</a></div>';
            } else {
                echo '<p class="error">The registration could not be canceled due to a system error.</p>';
            }
        }
    } else {
        echo '<p class="error">This event does not exist or you are not registered for it.</p>';
    }
} else {
    echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);

?>
</div>
</html>
<?php 
echo '</div>';
include ('footer.php'); ?>
