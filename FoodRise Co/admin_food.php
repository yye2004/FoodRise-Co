<?php
// Include necessary configuration or database connection files
include 'mysqli_connect.php';  // Ensure this file connects to the database
include 'header.php';

// Query to fetch all food donation submissions
$query = "SELECT fooddonation_id, user_id, email, food_type, quantity, manufactured_date, expiry_date, details, submitted_at, status FROM food_donations ORDER BY submitted_at DESC";
$result = @mysqli_query($dbc, $query); // Execute the query

// Check if the user is an admin, otherwise redirect
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo '<p class="error">You do not have permission to view this page.</p>';
    exit();
}

// Handle status update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $new_status = $_POST['status'];
    
    $update_query = "UPDATE food_donations SET status = '$new_status' WHERE fooddonation_id = $id";
    $result_update = mysqli_query($dbc, $update_query);
    
    if ($result_update) {
        $_SESSION['message'] = '<p class="success">Status updated successfully.</p>'; // Set the success message
        header('Location: ' . $_SERVER['PHP_SELF']); // Redirect to refresh the page
        exit();
    } else {
        $_SESSION['message'] = '<p class="error">Failed to update status.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Food Donations</title>
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

        .food-donation-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .food-donation-table th, .food-donation-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .food-donation-table th {
            background-color: #f4f4f4;
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
        
        td{
        max-width: 20vh;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: wrap;
        }
    </style>
</head>
<body>

<div class="dashboard-title">Manage Food Donations</div>

<div class="dashboard-container">
    <?php include 'admin_sidebar.php'; ?>

    <div class="main-content">
    
    <?php
    
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message']; // Display the success or error message
        unset($_SESSION['message']); // Clear the message after displaying
    }
    
    // Display food donations
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) { 
        echo "<h2>All Food Donations</h2>";
        echo "<p>There are currently $num_rows food donations submitted.</p>";
        echo '<table class="food-donation-table">
                <tr>
                    <th>ID</th>
                    <th>User Email</th>
                    <th>Food Type</th>
                    <th>Quantity</th>
                    <th>Manufactured Date</th>
                    <th>Expiry Date</th>
                    <th>Details</th>
                    <th>Submitted At</th>
                    <th>Status</th>
                    <th>Update</th>
                </tr>';
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>
                    <td>' . $row['fooddonation_id'] . '</td>
                    <td><a href="mailto:' . $row['email'] . '?subject=Re: Donation Details"> ' . $row['email'] . '</a></td>
                    <td>' . htmlspecialchars($row['food_type']) . '</td>
                    <td>' . $row['quantity'] . '</td>
                    <td>' . $row['manufactured_date'] . '</td>
                    <td>' . $row['expiry_date'] . '</td>
                    <td>' . htmlspecialchars($row['details']) . '</td>
                    <td>' . $row['submitted_at'] . '</td>
                    <td><form method="POST" action="">
                            <input type="hidden" name="id" value="' . $row['fooddonation_id'] . '">
                            <select name="status">
                                <option value="pending"' . ($row['status'] === 'pending' ? ' selected' : '') . '>Pending</option>
                                <option value="confirmed"' . ($row['status'] === 'confirmed' ? ' selected' : '') . '>Confirmed</option>
                                <option value="rejected"' . ($row['status'] === 'rejected' ? ' selected' : '') . '>Rejected</option>
                            </select></td>
                    <td>
                        
                            <button type="submit" name="update_status">Update</button>
                        </form>
                    </td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No food donations available.</p>';
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
