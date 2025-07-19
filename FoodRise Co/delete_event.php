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
include('header.php');
require('mysqli_connect.php');

echo '<div class="dashboard-title">Edit Event</div>';

echo '<div class="dashboard-container">';
include 'admin_sidebar.php'; ?>

<div class="main-content">

<?php 


// Check if event_id is passed via GET
if (isset($_GET['event_id']) && is_numeric($_GET['event_id'])) {
    $id = intval($_GET['event_id']);
    
    // Fetch event details to display the name
    $q = "SELECT event_name FROM events WHERE event_id=$id";
    $r = @mysqli_query($dbc, $q);
    
    if ($r && mysqli_num_rows($r) == 1) {
        $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
        $event_name = $row['event_name'];
        
        // Show the confirmation card
        if (!isset($_GET['confirm'])) {
            // Show confirmation card
            echo '
            <div class="confirmation-card">
                <h2>Are you sure you want to delete this event?</h2>
                <p><strong>' . htmlspecialchars($event_name) . '</strong></p>
                <a href="delete_event.php?event_id=' . $id . '&confirm=yes"><button class="yes">Yes, Delete</button></a>
                <a href="admin_events.php"><button class="no">No, Cancel</button></a>
            </div>
            ';
        } elseif ($_GET['confirm'] == 'yes') {
            // Proceed with deletion if "Yes" is clicked
            $q = "DELETE FROM events WHERE event_id=$id";
            $r = @mysqli_query($dbc, $q);
            
            if ($r && mysqli_affected_rows($dbc) == 1) {
                echo '<div class="success">Event has been deleted successfully. <a href="admin_events.php">Back To Events?</a></div>';
            } else {
                echo '<p class="error">The event could not be deleted due to a system error.</p>';
            }
        }
    } else {
        echo '<p class="error">This event does not exist.</p>';
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