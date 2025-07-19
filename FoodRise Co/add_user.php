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
input[type="text"],
input[type="email"],
input[type="password"], select {
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
include 'header.php';
require('mysqli_connect.php');

echo '<div class="dashboard-title">Add New User</div>';

echo '<div class="dashboard-container">';
include 'admin_sidebar.php'; ?>
<div class="main-content">
<?php 
$dbc = mysqli_connect($host, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $errors = array();
    
    // Validate username
    if (empty($_POST['username'])) {
        $errors[] = 'You forgot to enter the username.';
    } else {
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    }

    // Validate email
    if (empty($_POST['email'])) {
        $errors[] = 'You forgot to enter the email.';
    } else {
        $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    }

    // Validate password
    if (empty($_POST['password'])) {
        $errors[] = 'You forgot to enter the password.';
    } else {
        $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
    }

    // Validate role
    if (empty($_POST['role'])) {
        $errors[] = 'You forgot to select the role.';
    } else {
        $role = mysqli_real_escape_string($dbc, trim($_POST['role']));
    }


    // If there are no errors, insert the user into the database
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password before saving it
        
        $q = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', '$role' )";
        $r = @mysqli_query($dbc, $q);
        
        if ($r) {
            echo '<p class="success">User added successfully. <a href="admin_users.php">Back To Users?</a></p>';
        } else {
            echo '<p class="error">The user could not be added due to a system error.</p>';
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

mysqli_close($dbc);

?>

        <form action="add_user.php" method="POST">
            <!-- Username -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
        
            <!-- Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" required>
        
            <!-- Password -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
        
            <!-- Role -->
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="">Select Role</option>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        
            
            <!-- Submit Button -->
            <button type="submit" name="add_user">Add User</button>
        </form>
</div>

<?php 
echo '</div>';
include ('footer.php'); ?>
