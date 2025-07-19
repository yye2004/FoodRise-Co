<?php

// Include necessary configuration or database connection files
include 'mysqli_connect.php';  // Ensure this file connects to the database
include 'header.php';



/////////!!!!!!!!!!!!!!!!!!!
// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo '<p class="error">You must be logged in to view your transaction history.</p>';
    exit();
}



// Query to fetch the user's donation history
$query = "SELECT t.transaction_id, t.amount, t.transaction_date, t.ref
          FROM transactions t
          WHERE t.user_id = $user_id
          ORDER BY t.transaction_date DESC";  // Fetch transactions for the logged-in user
$result = @mysqli_query($dbc, $query);  // Execute the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
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
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
        }

        td a {
            color: #4CAF50;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="dashboard-title">Your Money Donation History</div>

<div class="dashboard-container">
    <?php include 'user_sidebar.php'; ?> <!-- Include user sidebar for navigation -->

    <div class="main-content">
        <?php
        // Check if the query was successful and there are results
        if ($result && mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr><th>Transaction ID</th><th>Amount</th><th>Transaction Date</th><th>Reference Number</th></tr>';

            // Fetch and display each transaction record
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['transaction_id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['amount']) . '</td>';
                echo '<td>' . htmlspecialchars($row['transaction_date']) . '</td>';
                echo '<td>' . htmlspecialchars($row['ref']) . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No transactions found.</p>';
        }

        mysqli_close($dbc); // Close the connection
        ?>
    </div>
</div>

<?php
include 'footer.php';  // Include the footer of the page
?>

</body>
</html>
