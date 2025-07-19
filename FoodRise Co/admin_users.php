<?php
// Include necessary configuration or database connection files
include 'mysqli_connect.php';  // Ensure this file connects to the database
include 'header.php';

// Connect to the database
$dbc = mysqli_connect($host, $username, $password, $dbname);

// Query to fetch all users
$user_query = "SELECT user_id, username, email FROM users WHERE role != 'admin' ORDER BY user_id ASC";
$user_result = @mysqli_query($dbc, $user_query); // Execute the query for users

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
    <title>Admin Dashboard - Manage Users</title>
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

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .user-table th, .user-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .user-table th {
            background-color: #f4f4f4;
        }

        .user-table td button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .user-table td button:hover {
            background-color: #d32f2f;
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

<div class="dashboard-title">User Management</div>

<div class="dashboard-container">
    <?php include 'admin_sidebar.php'; ?>

    <div class="main-content">
    
    <?php
    // Display users
    $user_num = mysqli_num_rows($user_result);
    if ($user_num > 0) { 
        echo "<h2>All Users</h2>";
        echo "<p>There are currently $user_num users.</p>";
        echo '<table class="user-table">
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>';
        while ($row = mysqli_fetch_array($user_result, MYSQLI_ASSOC)) {
            echo '<tr>
                    <td>' . $row['user_id'] . '</td>
                    <td>' . $row['username'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td><a href="edit_user.php?user_id=' . $row['user_id'] . '">Edit</a> | 
                        <a href="delete_user.php?user_id=' . $row['user_id'] . '">Delete</a></td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No users available.</p>';
    }

    mysqli_close($dbc); // Close the connection
    ?>
    
    <button class="add" onclick="window.location.href='add_user.php'">Add New User</button>    
    
    </div>
</div>

<?php
    include 'footer.php';
?>
</body>
</html>
