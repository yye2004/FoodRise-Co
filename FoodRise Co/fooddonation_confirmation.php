<?php
include('header.php');
include('mysqli_connect.php');  // Database connection

// Check if donation data exists in session
if (!isset($_SESSION['donation_data'])) {
    echo "<p class='error'>No donation data found. Please submit the form first.</p>";
    exit();
}

// Retrieve donation data from session
$donationData = $_SESSION['donation_data'];

// Check if the form is confirmed
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
    // Extract data from session
    $email = $donationData['email'];
    $foodType = $donationData['foodType'];
    $quantity = $donationData['quantity'];
    $manufacturedDate = $donationData['manufacturedDate'];
    $expiryDate = $donationData['expiryDate'];
    $details = $donationData['details'];
    
    // Insert data into the database
    $query = "INSERT INTO food_donations (email, food_type, quantity, manufactured_date, expiry_date, details, status)
              VALUES ('$email', '$foodType', '$quantity', '$manufacturedDate', '$expiryDate', '$details', 'pending')";
    
    if (mysqli_query($dbc, $query)) {
        // Get the last inserted food donation ID
        $donation_id = mysqli_insert_id($dbc);
        
        // Step 2: Update the food_donations table with the user_id from the users table
        // Run the update query to associate the user_id with the donation based on the email
        $update_query = "UPDATE food_donations fd
                         JOIN users u ON fd.email = u.email
                         SET fd.user_id = u.user_id
                         WHERE fd.fooddonation_id = '$donation_id'";
        
        if (mysqli_query($dbc, $update_query)) {
            // Donation updated successfully with user_id
            echo '<script type="text/javascript">
                    window.location.href = "thankyou.php";
                  </script>';
            exit();
        } else {
            // Handle error for the UPDATE query
            echo "<p class='error'>Error updating the donation. Please try again later.</p>";
        }
    } else {
        // Display error message if the query fails
        echo "<p class='error'>Error submitting your donation. Please try again later.</p>";
    }
}

// Handle cancellation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel'])) {
    unset($_SESSION['donation_data']);  // Clear the session data
    echo "<p class='message'>Donation has been canceled.</p>";
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Confirm Your Donation - FoodRise</title>
    <style>
        .donate-container {
            margin: 50px 200px 100px 200px;
            font-family: 'Quicksand', sans-serif;
        }

        .donate-title {
            font-family: 'Lexend Deca';
            font-size: 52px;
            font-weight: 900;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }

        .donate-desc {
            padding: 20px 0 30px 50px;
            border-bottom: 1px solid #333;
        }

        .form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form h2 {
            text-align: center;
        }

        .donation-details {
            margin: 20px 0;
        }

        .donation-details label {
            font-weight: bold;
        }

        .submit {
        width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        input[type="submit"] {
            
            font-family: 'Quicksand';
            padding: 15;
            font-size: 18px;
            background-color: #D6CF94;
            color: #fff;
            border:none;
            margin-left: 10px;
            margin-right: 10px;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.5s ease;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        input[type="submit"]:hover {
            background-color: #000;
            color: #D6CF94;
        }

        .message {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid green;
            background-color: #eaffea;
            color: green;
            border-radius: 5px;
        }

        .error {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid red;
            background-color: #ffdddd;
            color: red;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="donate-container">
    <div class="donate-title">Confirm Your Food Donation</div>

    <div class="donation-details">
        <h2>Donation Details</h2>
        <p><strong>Email:</strong> <?php echo $donationData['email']; ?></p>
        <p><strong>Food Type:</strong> <?php echo ucfirst($donationData['foodType']); ?></p>
        <p><strong>Quantity:</strong> <?php echo $donationData['quantity']; ?> kg</p>
        <p><strong>Manufactured Date:</strong> <?php echo $donationData['manufacturedDate']; ?></p>
        <p><strong>Expiry Date:</strong> <?php echo $donationData['expiryDate']; ?></p>
        <p><strong>Details:</strong> <?php echo $donationData['details']; ?></p>
    </div>

    <div class="submit">
        <form action="" method="POST">
            <input type="submit" name="confirm" value="Confirm Donation">
            <input type="submit" name="cancel" value="Cancel Donation">
        </form>
    </div>
</div>

<?php 
include('footer.php'); 
?>

</body>
</html>
