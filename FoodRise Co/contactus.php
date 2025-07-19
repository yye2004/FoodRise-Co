<?php
include 'mysqli_connect.php';
include 'header.php';

if (isset($_GET['submitted'])) {
    // Retrieve and sanitize form inputs
    $email = mysqli_real_escape_string($dbc, trim($_GET['email']));
    $name = mysqli_real_escape_string($dbc, trim($_GET['name']));
    $enquiry = mysqli_real_escape_string($dbc, trim($_GET['enquiry']));
    $details = mysqli_real_escape_string($dbc, trim($_GET['details']));

    $errors = [];

    // Basic validation
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please provide a valid email address.";
    }

    if (empty($name)) {
        $errors[] = "Name cannot be empty.";
    }

    if (empty($details)) {
        $errors[] = "Message details cannot be empty.";
    }

    if (empty($errors)) {
        // Insert data into the database
        $query = "INSERT INTO contactform (email, name, enquiry_type, message_details) 
                  VALUES ('$email', '$name', '$enquiry', '$details')";

        if (mysqli_query($dbc, $query)) {
            echo "<div class='success-message'><h1>Thank you! Your enquiry has been submitted successfully.</h1></div>";
        } else {
            echo "<div class='error-message'>An error occurred while submitting your enquiry. Please try again later.</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='error-message'>$error</div>";
        }
    }
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Same styling as provided */
        body {
            margin: 0;
        }

        .contactmain {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .contact-title {
            font-family: 'Lexend Deca';
            font-size: 52px;
            font-weight: 900;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
            margin: 50 200 50 200;
        }

        h3 {
            font-family: 'Lexend Deca';
            font-size: 32px;
            font-weight: 900;
            width: 30%;
            text-align: center;
            margin-top: 0;
            margin-bottom: 30px;
        }

        .formcontainer {
            font-family: 'Quicksand';
            background-color: #fff;
            margin: 20 20 100 20;
            padding: 20px 100px 30px 100px;
            border-radius: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        .formcontainer label {
            display: block;
            text-align: left;
            margin-top: 20px;
            margin-bottom: 10px;
            margin-left: 5px;
            color: #555;
            font-size: 16px;
            font-weight: 500;
        }

        .formcontainer input[type="text"],
        .formcontainer input[type="tel"],
        .formcontainer input[type="email"],
        .formcontainer select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 30px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .formcontainer textarea {
            width: 100%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 30px;
            box-sizing: border-box;
            font-size: 14px;
            resize: none;
        }

        .formcontainer input[type="submit"] {
            background-color: #555555;
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 10px;
            margin-top: 20px;
            cursor: pointer;
            width: 30%;
            transition: background-color 0.3s ease;
            font-size: 16px;
            font-family: 'Quicksand';
        }

        .formcontainer input[type="submit"]:hover {
            background-color: #202020;
        }

        input::placeholder, textarea::placeholder {
            color: #aaa;
            font-style: italic;
        }

        .success-message {
            text-align: center;
            margin-top: 20px;
        }

        .success-message h1 {
            color: #28a745;
        }

        .error-message {
            margin-bottom: 2px;
            text-align: start;
            font-size: small;
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="contact-title">Contact Us</div>

    <div class="contactmain" id="contact-main">
        <h3>Leave your enquiries and we will get back to you by email in 2-4 working days.</h3>
        <div class="formcontainer" id="formContainer">
            <form id="contactForm" method="GET">
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" placeholder="example123@gmail.com">
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name">
                </div>

                <div class="form-group">
                    <label for="enquiry">Enquiry Type:</label>
                    <select id="enquiry" name="enquiry">
                        <option value="volunteer">Volunteering</option>
                        <option value="events">Events</option>
                        <option value="food">Food Donation</option>
                        <option value="money">Money Donation</option>
                        <option value="others">Others</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="details">Message:</label>
                    <textarea id="details" name="details" rows="4" placeholder="Leave your comment here :)"></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" name="submitted" value="Submit">
                </div>
            </form>
        </div>
    </div>
</body>
<?php 
include 'footer.php'; 
?>
