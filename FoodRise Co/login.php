<?php
include 'mysqli_connect.php';
include 'header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_or_username = mysqli_real_escape_string($dbc, trim($_POST['email-or-username']));
    $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
    
    if (empty($email_or_username) || empty($password)) {
        $errors[] = "Both fields are required.";
    }
    
    if (empty($errors)) {
        $query = "SELECT user_id, email, username, password, role FROM users WHERE email = '$email_or_username' OR username = '$email_or_username'";
        $result = mysqli_query($dbc, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            
            if (password_verify($password, $user['password'])) {
                include 'session.php';
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                if ($user['role'] == 'admin') {
                    header("Location: admin_dashboard.php");
                } elseif ($user['role'] == 'user') {
                    header("Location: user_dashboard.php");
                } else {
                    echo "Unrecognized role. Please contact support.";
                }
                exit;
            } else {
                $errors[] = "Incorrect password.";
            }
        } else {
            $errors[] = "No user found with that email or username.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Reset */
        body {
            margin: 0;
        }
        /* Main Login Section */
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px 20px;
            font-family: 'Lexend Deca';
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
        }
        form {
            font-family: 'Montserrat';
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
        form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 40px;
            font-size: 14px;
            font-family: 'Lexend Deca';
        }
        form button {
            font-family: 'Lexend Deca';
            background-color: #000;
            color: #fff;
            border: none;
            margin: 20px;
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
<body>
    <main>
        <h1>Login</h1>
        <hr>
        <form method="POST" action="login.php">
            <label for="email-or-username">Email Address or Username:</label>
            <input type="text" id="email-or-username" name="email-or-username" placeholder="Enter your email or username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <a href="signup.php">Not a member? Sign up here</a>
            <button type="submit">Login</button>
        </form>

        <?php
        if (!empty($errors)) {
            echo '<ul>';
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo '</ul>';
        }
        ?>
    </main>
</body>
<?php 
include 'footer.php'; 
?>
</html>
