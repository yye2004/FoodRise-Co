<?php
// Include necessary configuration or database connection files
include 'mysqli_connect.php';  // Ensure this file connects to the database
include 'header.php';

// Check if the user is an admin, otherwise redirect
/**if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo '<p class="error">You do not have permission to view this page.</p>';
    exit();
}*/

// Query to fetch all transactions
$query = "SELECT t.transaction_id, u.username, t.amount, t.transaction_date, t.ref
          FROM transactions t
          JOIN users u ON t.user_id = u.user_id";
$result = @mysqli_query($dbc, $query); // Execute the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Transactions</title>
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

        td button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        td button:hover {
            background-color: #d32f2f;
        }

        td a {
            color: #4CAF50;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="dashboard-title">Transaction Management</div>

<div class="dashboard-container">
    <?php include 'admin_sidebar.php'; ?>

    <div class="main-content">
        <?php
        // Check if the query was successful and there are results
        if ($result && mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>Username</th><th>Amount</th><th>Datetime</th><th>Ref No.</th><th>Actions</th></tr>';

            // Fetch and display each transaction record
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['transaction_id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['username']) . '</td>';
                echo '<td>' . htmlspecialchars($row['amount']) . '</td>';
                echo '<td>' . htmlspecialchars($row['transaction_date']) . '</td>';
                echo '<td>' . htmlspecialchars($row['ref']) . '</td>';
                echo '<td>
                        <a href="edit_transaction.php?transaction_id=' . $row['transaction_id'] . '">Edit</a> | 
                        <a href="delete_transaction.php?transaction_id=' . $row['transaction_id'] . '" onclick="return confirm(\'Are you sure you want to delete this transaction?\')">Delete</a>
                      </td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No transactions found.</p>';
        }

        mysqli_close($dbc); // Close the connection
        ?>
        
        <button class="add" onclick="window.location.href='add_transaction.php'">Add New Transaction</button>    
    </div>
</div>

<?php
include 'footer.php';
?>

</body>
</html>
