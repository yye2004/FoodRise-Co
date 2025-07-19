<?php
include 'header.php';
require('mysqli_connect.php');
?>

<style>
    body {
        margin: 0;
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
    }

    /* Form Styling */
    form {
        font-family: 'Montserrat';
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-width: 600px;
        margin: auto;
    }

    label {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="date"],
    input[type="time"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 30px;
        font-size: 16px;
        font-family: 'Montserrat';
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
    }

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

    .error {
        color: red;
        font-size: 14px;
    }

    /* Success message and Back button */
    .success {
        width: 90%;
        margin: 20 0 20 0;
        padding: 15px;
        background-color: #4CAF50;
        color: white;
        border-radius: 10px;
        text-align: start;
        font-size: 16px;
    }

    .success a {
        color: white;
    }

</style>

<?php

// Show the title for the page
echo '<div class="dashboard-title">Edit Transaction</div>';

echo '<div class="dashboard-container">';
include 'admin_sidebar.php'; // Include the sidebar

// Check if a transaction ID is passed in the URL
if (isset($_GET['transaction_id']) && is_numeric($_GET['transaction_id'])) {
    $transaction_id = $_GET['transaction_id'];
} else {
    echo '<p class="error">This page was accessed in error.</p>';
    exit();
}

// Retrieve the current transaction details
$q = "SELECT * FROM transactions WHERE transaction_id = $transaction_id";
$r = @mysqli_query($dbc, $q);

if ($r && mysqli_num_rows($r) == 1) {
    // Fetch the current transaction details
    $row = mysqli_fetch_assoc($r);
    $amount = $row['amount'];
    $user_id = $row['user_id'];
    $ref = $row['ref'];
    
    // Close the database connection for now
    mysqli_free_result($r);
} else {
    echo '<p class="error">Could not retrieve transaction details. Please try again later.</p>';
    exit();
}

?>

<div class="main-content">
<?php

// Handle form submission to update the transaction
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_transaction'])) {
    $errors = array();
    
    // Validate amount
    if (empty($_POST['amount'])) {
        $errors[] = 'You forgot to enter the transaction amount.';
    } else {
        $amount = mysqli_real_escape_string($dbc, trim($_POST['amount']));
    }
    
    // Validate user ID
    if (empty($_POST['user_id'])) {
        $errors[] = 'You forgot to enter the user ID.';
    } else {
        $user_id = mysqli_real_escape_string($dbc, trim($_POST['user_id']));
    }

    // Validate points (optional)
    $ref = isset($_POST['ref']) ? mysqli_real_escape_string($dbc, trim($_POST['ref'])) : $ref;
    
    // If there are no errors, update the transaction in the database
    if (empty($errors)) {
        $q = "UPDATE transactions SET user_id = '$user_id', amount = '$amount', ref = '$ref' WHERE transaction_id = $transaction_id";
        $r = @mysqli_query($dbc, $q);
        
        if ($r) {
            echo '<div class="success">Transaction updated successfully. <a href="admin_transaction.php">Back To Transactions?</a></div>';
        } else {
            echo '<p class="error">The transaction could not be updated due to a system error.</p>';
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

// Close the database connection
mysqli_close($dbc);
?>

<!-- Edit Transaction Form -->
<form action="edit_transaction.php?transaction_id=<?php echo $transaction_id; ?>" method="POST">
    <!-- Amount -->
    <label for="amount">Transaction Amount:</label>
    <input type="text" id="amount" name="amount" value="<?php echo htmlspecialchars($amount); ?>" placeholder="Transaction Amount" required>
    
    <!-- User ID -->
    <label for="user_id">User ID:</label>
    <input type="text" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>" placeholder="User ID" required>
    
    <!-- DuitNow Reference No. -->
    <label for="ref">Reference No.:</label>
    <input type="text" id="ref" name="ref" value="<?php echo htmlspecialchars($ref); ?>" placeholder="Reference Number">
    
    <!-- Submit Button -->
    <button type="submit" name="edit_transaction">Update Transaction</button>
</form>

</div>

<?php 
echo '</div>';
include('footer.php'); // Include the footer
?>
