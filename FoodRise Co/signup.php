<?php
include 'mysqli_connect.php';
include 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Reset */
        body {
    margin:0;
    
}
        /* Main Signup Section */
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
        }

        main h1 {
            font-size: 36px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        main hr {
            width: 60px;
            border: 1px solid #333;
            margin: 10px 0 30px 0;
            font-family: 'Lexend Deca';
        }

        form {
        font-family: 'Lexend Deca';
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        form label {
         
            display: block;
            text-align: left;
            font-size: 16px;
            margin-bottom: 5px;
            color: #555;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
        font-family: 'Lexend Deca';
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 40px;
            font-size: 14px;
        }

        form button {
        font-family: 'Lexend Deca';
            background-color: #000;
            color: #fff;
            border: none;
            margin: 20 20 20 20;
            padding: 10px 20px;
            border-radius: 40px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #333;
        }

        form a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            font-size: 14px;
            color: #333;
        }

        form a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();
    
    if (empty($_POST['username'])) {
        $errors[] = 'You forgot to enter your username.';
    } else {
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $username_pattern = "/^[a-zA-Z\d][a-zA-Z\d_-]{4,9}$/";
        if (!preg_match($username_pattern, $username)) {
            $errors[] = 'Invalid username. It must be 5–10 characters long and can include letters, digits, underscores, or hyphens.';
        }
    }
    
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter your email.';
    } else {
        $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
        $email_pattern = "/^[a-zA-Z\d._%+-]+@[a-zA-Z\d.-]+\.[a-zA-Z]{2,}$/";
        if (!preg_match($email_pattern, $email)) {
            $errors[] = 'Invalid email format.';
        }
    }
    
    if (empty($_POST['password'])) {
        $errors[] = 'You forgot to enter your password.';
    } else {
        $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
        $password_pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/";
        if (!preg_match($password_pattern, $password)) {
            $errors[] = 'Invalid password. It must be at least 6 characters long and include at least one letter and one digit.';
        }
    }
    
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $q = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', 'user')";
        $r = @mysqli_query($dbc, $q);
        
        if ($r) {
            echo '<p class="success">Registration successful. <a href="login.php">Log in now?</a></p>';
        } else {
            echo '<p class="error">The user could not be registered due to a system error.</p>';
            echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>';
        }
    } else {
        echo '<p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) {
            echo " - $msg<br />\n";
        }
        echo '</p><p>Please try again.</p>';
    }
}
mysqli_close($dbc);
?>


<body>
<main>
    <h1>Sign Up</h1>
    <hr>
    <form action="signup.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Create a password" required>
        <button type="submit">Sign Up</button>
    </form>
</main>
<?php include 'footer.php'; ?>
</body>
</html>


