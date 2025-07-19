<?php
// Include necessary configuration or database connection files
include 'mysqli_connect.php';  // Ensure this file connects to the database
include 'header.php';

// Query to fetch all contact form submissions
$query = "SELECT contactform_id, email, name, enquiry_type, message_details, submitted_at FROM contactform ORDER BY submitted_at DESC";
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
    <title>Admin Dashboard - Manage Enquiries</title>
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

        .enquiry-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .enquiry-table th, .enquiry-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .enquiry-table th {
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

<div class="dashboard-title">Manage Contact Enquiries</div>

<div class="dashboard-container">
    <?php include 'admin_sidebar.php'; ?>

    <div class="main-content">
    
    <?php
    // Display enquiries
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) { 
        echo "<h2>All Enquiries</h2>";
        echo "<p>There are currently $num_rows enquiries submitted.</p>";
        echo '<table class="enquiry-table">
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Enquiry Type</th>
                    <th>Message</th>
                    <th>Submitted At</th>
                </tr>';
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr>
                    <td>' . $row['contactform_id'] . '</td>
                    <td><a href="mailto:' . $row['email'] . '?subject=Re: ' . ($row['message_details']) . '">' . $row['email'] . '</a></td>
 
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['enquiry_type'] . '</td>
                    <td>' . htmlspecialchars($row['message_details']) . '</td>
                    <td>' . $row['submitted_at'] . '</td>
                  </tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No enquiries available.</p>';
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
