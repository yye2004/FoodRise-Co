<?php
// Include necessary configuration or database connection files
include 'mysqli_connect.php';  // Ensure this file connects to the database
include 'header.php';

// Query to fetch user's confirmed food donation submissions
$user_id = $_SESSION['user_id'];  // Assuming user is already logged in
$email = $_SESSION['email']; 
$email = mysqli_real_escape_string($dbc, $email);
$query = "SELECT fd.fooddonation_id, fd.email, fd.food_type, fd.quantity, fd.manufactured_date, fd.expiry_date, fd.details, fd.submitted_at, fd.status
          FROM food_donations fd
          WHERE fd.email = '$email' AND fd.status = 'confirmed'
          ORDER BY submitted_at DESC";

$result = @mysqli_query($dbc, $query); // Execute the query

// Check if the user is logged in, otherwise redirect
if (!isset($_SESSION['user_id'])) {
    echo '<p class="error">You must be logged in to view this page.</p>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - My Food Donations</title>
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
    </style>
</head>
<body>

<div class="dashboard-title">My Food Donation History</div>

<div class="dashboard-container">
    <?php include 'user_sidebar.php'; ?>

    <div class="main-content">
    
    <?php
    // Display food donations
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) { 
        echo "<h2>My Confirmed Food Donations</h2>";
        echo "<p>You have $num_rows confirmed donations.</p>";
        echo '<table class="food-donation-table">
                <tr>
                    <th>ID</th>
                    <th>Food Type</th>
                    <th>Quantity</th>
                    <th>Manufactured Date</th>
                    <th>Expiry Date</th>
                    <th>Details</th>
                    <th>Submitted At</th>
                    <th>Status</th>
                </tr>';
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>
                    <td>' . $row['fooddonation_id'] . '</td>
                    <td>' . htmlspecialchars($row['food_type']) . '</td>
                    <td>' . $row['quantity'] . '</td>
                    <td>' . $row['manufactured_date'] . '</td>
                    <td>' . $row['expiry_date'] . '</td>
                    <td>' . htmlspecialchars($row['details']) . '</td>
                    <td>' . $row['submitted_at'] . '</td>
                    <td>' . $row['status'] . '</td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No confirmed food donations available.</p>';
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
