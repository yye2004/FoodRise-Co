<?php 
include 'mysqli_connect.php';
include 'session.php';
?>
<html>
    <head>
    <link href='https://fonts.googleapis.com/css?family=MuseoModerno' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Lexend Deca' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
        <style>

            header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                background-color: #FDFFC9;
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }

            .logo {
                font-family: 'MuseoModerno';
                font-size: 24px;
                font-weight: bold;
                padding-left: 15px;
            }
            
            .logo a{
                text-decoration: none;
                color: #000;
            }

            nav ul {
            font-family: 'Montserrat';
                background-color: #Fff;
                list-style: none;
                justify-content: center;
                display: flex;
                gap: 50px;
                border-bottom: 1px solid #ddd;
                margin: 0;
                padding-top: 10px;
                padding-bottom: 10px;
            }

            nav ul li a {
                text-decoration: none;
                color: #333;
                font-size: 14px;
                transition: color 0.5s ease;
            }

            nav ul li a:hover {
                color: #000;
                text-decoration: underline;
            }

            .user, .user a {
                color: #000;
                display: flex;
                align-items: center;
                font-size: 18px;
                padding-right: 10px;
                text-decoration: none;
                gap: 10px;
            }
    
        </style>
    </head>
    
    <?php 
    
    $user_query = "SELECT user_id, username, email, role FROM users WHERE role != 'admin'";
    $user_result = @mysqli_query($dbc, $user_query);
    
    // Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $name = 'Login'; // Default for users not logged in
} else {
    // If user is logged in, fetch user details from the database
    $user_id = $_SESSION['user_id']; // Get user_id from session
    $role = $_SESSION['role']; // Get user role from session

    // Query based on role
    if ($role == 'admin') {
        $name = 'Admin'; // If user is admin, show 'Admin'
    } elseif ($role == 'user') {
        // Fetch username from database for regular users
        $query = "SELECT username FROM users WHERE user_id = '$user_id'";
        $result = mysqli_query($dbc, $query);

        // Check if the query was successful
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['username']; // Set the name to the user's username
        } else {
            $name = 'Unknown'; // If no result, set name to 'Unknown'
        }
    } else {
        $name = 'Unknown'; // Fallback if role is not recognized
    }
}
?>
    
    <header>
        <div class="logo"><a href="index.php">FoodRise Co.</a></div>
        
        <div class="user">
            
            <a href="header_user.php" rel="noopener noreferrer">
                <img src="./images/profile.png" alt="ProfileIcon" width="30" height="30"><?php echo $name ?>
            </a>
            
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="volunteer.php">Volunteer</a></li>
            <li><a href="donate.php">Donate</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
        </ul>
    </nav>
    
</html>