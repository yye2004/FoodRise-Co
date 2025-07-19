<?php
include('header.php');

// Database connection
include('mysqli_connect.php');  // Make sure you have this file set up for DB connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $email = mysqli_real_escape_string($dbc, $_POST['email']);
    $foodType = mysqli_real_escape_string($dbc, $_POST['foodType']);
    $quantity = mysqli_real_escape_string($dbc, $_POST['quantity']);
    $manufacturedDate = mysqli_real_escape_string($dbc, $_POST['manufacturedDate']);
    $expiryDate = mysqli_real_escape_string($dbc, $_POST['expiryDate']);
    $details = mysqli_real_escape_string($dbc, $_POST['details']);
    
    // Validate expiry date
    if (strtotime($expiryDate) < time()) {
        echo "<p class='error'>The expiry date cannot be in the past.</p>";
    } else {
        $_SESSION['donation_data'] = [
            'email' => $email,
            'foodType' => $foodType,
            'quantity' => $quantity,
            'manufacturedDate' => $manufacturedDate,
            'expiryDate' => $expiryDate,
            'details' => $details
        ];
        
        // Redirect to the confirmation page
        header("Location: fooddonation_confirmation.php");
        exit();
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Food Donation - FoodRise</title>
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
            display: flexbox;
            justify-content: center;
            align-items: center;
        }

        .form h2 {
            text-align: center;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            font-weight: 500;
        }

        label {
            font-family: 'Quicksand';
            padding: 10px;
        }

        input, textarea, select {
            font-family: 'Quicksand';
            width: calc(100% - 20px);
            margin-top: 10px;
            margin-bottom: 20px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 20px;
        }

        .submit {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        input[type="submit"] {
            width: 30%;
            font-family: 'Quicksand';
            padding: 15px 40px;
            font-size: 18px;
            background-color: #D6CF94;
            color: #fff;
            border: none;
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
    </style>
</head>

<body>

<div class="donate-container">
    <div class="donate-title">Food Donation</div>

    <div class="donate-desc">
        <h3>Donations must adhere strictly to our guidelines:</h3>
        <ul>
            <li>Acceptable Food Types: Only specific types of food can be donated, which are listed in our food type. </li>
            <li>Expiration Dates: All donated items must have expiration dates within the acceptable range within 2 years. </li>
            <li>Packaging Restrictions: Food must be properly packaged and labeled with nutrition facts or allergens. </li>
            <li>Prohibited Items: Certain food items are not allowed for donation, as listed in our prohibited food section. </li>
        </ul>
    </div>

    <div class="form">
        <h2>Leave your details and we will further contact by email in 2-4 working days.</h2>
        <form action="" method="POST">
            <label for="email">Email Address:</label><br>
            <input type="email" id="email" name="email" placeholder="example123@gmail.com" required><br>

            <label for="foodType">Food Type:</label><br>
            <select id="foodType" name="foodType" required>
                <option value="grains">Grains and Cereals</option>
                <option value="fruits">Canned Fruits</option>
                <option value="meat">Canned Meat</option>
                <option value="vege">Canned Vegetables and Beans</option>
                <option value="other">Other (state in details section)</option>
            </select><br>

            <label for="quantity">Food Quantity (in kg or units):</label><br>
            <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" min="1" required><br>

            <label for="manufacturedDate">Manufactured Date:</label><br>
            <input type="date" id="manufacturedDate" name="manufacturedDate" required><br>

            <label for="expiryDate">Expiry Date:</label><br>
            <input type="date" id="expiryDate" name="expiryDate" required><br>

            <label for="details">Product Details:</label><br>
            <textarea id="details" name="details" rows="5" placeholder="Product information, brands, etc." required></textarea><br>

            <div class="submit"><input type="submit" value="Submit"></div>
        </form>
    </div>
</div>

<?php 
include('footer.php'); 
?>

</body>
</html>
