
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
        margin-left: 20px;
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
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 50px;
        font-size: 16px;
        font-family: 'Montserrat';
        box-sizing: border-box;
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

echo '<div class="dashboard-title">Your Profile</div>';
echo '<div class="dashboard-container">';
include 'user_sidebar.php'; // User-specific sidebar

echo '<div class="main-content">';

// Initialize success and error messages
$success_message = '';
$error_message = '';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo '<p class="error">You must be logged in to view and edit your profile.</p>';
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$q = "SELECT username, email, role FROM users WHERE user_id=$user_id";
$r = @mysqli_query($dbc, $q);

// Ensure a valid result is returned
if (mysqli_num_rows($r) == 1) {
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
} else {
    // Invalid user, redirect with error message
    echo '<p class="error">This user does not exist.</p>';
    exit();
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_profile'])) {
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

    // Validate password (optional, only update if changed)
    if (!empty($_POST['password'])) {
        $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    }

    // If there are no errors, update the user's profile in the database
    if (empty($errors)) {
        // If password is provided, update it
        if (!empty($password)) {
            $q = "UPDATE users SET username='$username', email='$email', password='$hashed_password' WHERE user_id=$user_id";
        } else {
            // If password is not provided, don't update it
            $q = "UPDATE users SET username='$username', email='$email' WHERE user_id=$user_id";
        }

        $r = @mysqli_query($dbc, $q);

        if ($r) {
            // Set success message and stop displaying the form
            $success_message = '<p class="success">Profile updated successfully.</p>';
        } else {
            $error_message = '<p class="error">Your profile could not be updated due to a system error.</p>';
            $error_message .= '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message
        }
    } else {
        // Display errors
        $error_message = '<p class="error">The following error(s) occurred:<br />';
        foreach ($errors as $msg) { // Print each error
            $error_message .= " - $msg<br />\n";
        }
        $error_message .= '</p><p>Please try again.</p>';
    }
}

// Only show the form if there is no success message
if (empty($success_message)) {
?>

    <form action="user_profile.php" method="POST">
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">

        <!-- Username -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Username" value="<?= htmlspecialchars($row['username']) ?>" required>

        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Email" value="<?= htmlspecialchars($row['email']) ?>" required>

        <!-- Password (Optional) -->
        <label for="password">Password (Leave blank if not changing):</label>
        <input type="password" id="password" name="password" placeholder="New Password">

        <!-- Submit Button -->
        <button type="submit" name="edit_profile">Update Profile</button>
    </form>

<?php
} else {
    // Display success or error messages
    echo $success_message;
    echo $error_message;
}

echo '</div>';
echo '</div>';
include('footer.php');
?>
