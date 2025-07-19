<?php
include 'mysqli_connect.php';
include 'header.php';

// Initialize variables with default values to prevent undefined array key warnings
$amount = '';
$donor_name = '';
$pronouns = '';
$email_error = '';
$reference_id_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the donation amount
    $amount = isset($_POST['amount']) ? ($_POST['amount'] === 'other' ? $_POST['other_amount'] : $_POST['amount']) : '';
    
    // Validate donor name and handle anonymous case
    $donor_name = isset($_POST['anonymous']) ? 'Anonymous' : (isset($_POST['donor_name']) ? $_POST['donor_name'] : '');
    $pronouns = isset($_POST['anonymous']) ? '' : (isset($_POST['pronouns']) ? $_POST['pronouns'] : '');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Confirmation</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            font-family: 'Lexend Deca', sans-serif;
            font-size: 42px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .qrcode {
            margin: 20px auto;
        }

        .details {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }

        .form-section {
            text-align: left;
            margin: 20px 0;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-size: 16px;
            font-family: 'Quicksand', sans-serif;
        }

        input[type="text"], input[type="email"], input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .submit-button {
            text-align: center;
            margin-top: 20px;
        }

        input[type="submit"] {
            font-family: 'Quicksand', sans-serif;
            padding: 15px 40px;
            font-size: 18px;
            background-color: #D6CF94;
            color: #fff;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        input[type="submit"]:hover {
            background-color: #000;
            color: #D6CF94;
        }

        .thank-you {
            margin: 20px 0;
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
        }

        .thank-you span {
            color: #000;
            font-weight: normal;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom:10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Donation Confirmation</h1>

    <div class="qrcode">
        <img src="./images/qrcode.png" alt="DuitNow QR Code" width="400" height="400">
    </div>

    <div class="details">
        <p><strong>Amount:</strong> RM<?php echo htmlspecialchars($amount); ?></p>
        <p><strong>Donor Name:</strong> <?php echo htmlspecialchars($donor_name); ?></p>
    </div>

    <form action="moneydonation_process.php" method="POST" enctype="multipart/form-data">
        <!-- Hidden fields to pass previous form data -->
        <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
        <input type="hidden" name="donor_name" value="<?php echo htmlspecialchars($donor_name); ?>">
        <input type="hidden" name="anonymous" value="<?php echo isset($_POST['anonymous']) ? 'on' : ''; ?>">

        <div class="form-section">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" required>
            <?php if ($email_error) echo '<p class="error">'.$email_error.'</p>'; ?>
        </div>

        <div class="form-section">
            <label for="reference_id">Reference ID:</label>
            <input type="text" id="reference_id" name="reference_id" placeholder="Enter your payment reference ID" required>
            <?php if (isset($reference_id_error)) echo '<p class="error">'.$reference_id_error.'</p>'; ?>
        </div>

        <div class="form-section">
            <label for="receipt">Upload Donation Receipt (will be saved as 'upload.jpg'):</label>
            <input type="file" id="receipt" name="receipt" accept="image/*,application/pdf" required>
        </div>

        <div class="submit-button">
            <input type="submit" name="submit_donation" value="Submit">
        </div>
    </form>

    <?php
    if (isset($_POST['submit_donation'])) {
        // Validate email
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $email = $_POST['email'];
            if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zAZ0-9.-]+\.[a-zA-Z]{2,6}$/", $email)) {
                $email_error = "Invalid email format.";
            }
        } else {
            $email_error = "Email is required.";
        }
        
        // Validate reference ID
        if (isset($_POST['reference_id']) && !empty($_POST['reference_id'])) {
            $reference_id = $_POST['reference_id'];
            if (!preg_match("/^\d{12}$/", $reference_id)) {
                $reference_id_error = "Reference ID must be exactly 12 digits.";
            }
        } else {
            $reference_id_error = "Reference ID is required.";
        }
        
        // Re-validate amount and donor name from hidden fields
        $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
        $donor_name = isset($_POST['donor_name']) ? $_POST['donor_name'] : '';
        
        // Proceed with form processing if no validation errors
        if (empty($email_error) && empty($reference_id_error)) {
            // Prepare SQL query with correct data
            $query = "INSERT INTO money_donations (amount, donor_name, email, reference_id, receipt) VALUES ('$amount', '$donor_name', '$email', '$reference_id', 'upload.jpg')";
            
            // Execute the query
            $result = @mysqli_query($dbc, $query);

            if ($result) {
                echo '<script type="text/javascript">
                        window.location.href = "thankyou.php";
                      </script>';
                exit;
            } else {
                echo '<div class="thank-you error">Error processing your donation. Please try again.</div>';
            }
        }
    }
    ?>
</div>

<?php include 'footer.php'; ?>

</body>
</html>