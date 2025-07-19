<?php
// Include necessary configuration or database connection files
include 'mysqli_connect.php';  // Ensure this file connects to the database
include 'header.php';

// Query to fetch all money donation submissions
$query = "SELECT money_id, amount, donor_name, email, reference_id, money_donation_date FROM money_donations ORDER BY money_donation_date DESC";
$result = @mysqli_query($dbc, $query); // Execute the query

// Check if the user is an admin, otherwise redirect
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo '<p class="error">You do not have permission to view this page.</p>';
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Money Donations</title>
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

        .money-donation-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .money-donation-table th, .money-donation-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .money-donation-table th {
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
    </style>
</head>
<body>

<div class="dashboard-title">Manage Money Donations</div>

<div class="dashboard-container">
    <?php include 'admin_sidebar.php'; ?>

    <div class="main-content">
    
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message']; // Display the success or error message
        unset($_SESSION['message']); // Clear the message after displaying
    }
    
    // Display money donations
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) { 
        echo "<h2>All Money Donations</h2>";
        echo "<p>There are currently $num_rows money donations submitted.</p>";
        echo '<table class="money-donation-table">
                <tr>
                    <th>ID</th>
                    <th>Donor Name</th>
                    <th>Email</th>
                    <th>Amount (RM)</th>
                    <th>Reference ID</th>
                    <th>Donation Date</th>
                </tr>';
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>
                    <td>' . $row['money_id'] . '</td>
                    <td>' . htmlspecialchars($row['donor_name']) . '</td>
                    <td><a href="mailto:' . $row['email'] . '?subject=Re: Donation Details"> ' . $row['email'] . '</a></td>
                    <td>' . $row['amount'] . '</td>
                    <td>' . htmlspecialchars($row['reference_id']) . '</td>
                    <td>' . $row['money_donation_date'] . '</td>
                    
                    </form>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No money donations available.</p>';
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
