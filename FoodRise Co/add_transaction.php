<?php
include 'header.php';
require('mysqli_connect.php'); ?>

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
            margin-left:20px;
            margin-top: 0px;
        }
        
        form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    max-width: 600px;
    margin: auto;
}

/* Label styling */
label {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
}

/* Input and textarea styling */
input{
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 50px;
    font-size: 16px;
    font-family: 'Montserrat';
    box-sizing: border-box;
}

textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 30px;
    font-size: 16px;
    font-family: 'Montserrat';
    box-sizing: border-box;
}

/* Textarea styling */
textarea {
    resize: vertical;
}

/* Button styling */
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

/* Error message styling */
.error {
    color: red;
    font-size: 14px;
}

.success{
        width:90%;
        margin: 20 0 20 0;
        padding: 15px;
        background-color: #4CAF50;
        color: white;
        border-radius: 10px;
        text-align: start;
        font-size: 16px;
        }
        
        
.success a{
        color: white;
        }
        
</style>

<?php 

// Show the title for the page
echo '<div class="dashboard-title">Add New Transaction</div>';

echo '<div class="dashboard-container">';
include 'admin_sidebar.php'; // Include the sidebar
?>
<div class="main-content">
<?php 

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_transaction'])) {
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

    // Validate points (optional, default to 0 if not provided)
    $ref = isset($_POST['ref']) ? mysqli_real_escape_string($dbc, trim($_POST['ref'])) : 0;
    
    // If there are no errors, insert the transaction into the database
    if (empty($errors)) {
        $q = "INSERT INTO transactions (user_id, amount, ref) VALUES ('$user_id', '$amount', '$ref')";
        $r = @mysqli_query($dbc, $q);
        
        if ($r) {
            echo '<p class="success">Transaction added successfully. <a href="admin_transaction.php">Back To Transactions?</a></p>';
        } else {
            echo '<p class="error">The transaction could not be added due to a system error.</p>';
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

        <!-- Transaction Form -->
        <form action="add_transaction.php" method="POST">
            <!-- Amount -->
            <label for="amount">Transaction Amount:</label>
            <input type="text" id="amount" name="amount" placeholder="Transaction Amount" required>
    
            <!-- User ID -->
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" placeholder="User ID" required>
    
    		<!-- DuitNow Reference No. -->
            <label for="ref">Reference No.:</label>
            <input type="text" id="ref" name="ref" placeholder="reference Number">
            
            <!-- Submit Button -->
            <button type="submit" name="add_transaction">Add Transaction</button>
        </form>
</div>

<?php 
echo '</div>';
include('footer.php'); // Include the footer
?>
