
<?php
include 'mysqli_connect.php';
include 'header.php';
include 'rewards.php';
//
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - FoodRise Co.</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        

        .dashboard-container {
            display: flex;
            padding: 20 20 20 20;
        }

        .dashboard-header {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 40px;
            gap: 50px
        }

        .dashboard-header h1 {
            font-size: 28px;
            color: #333;
        }
        
        .header-content{
            width: 80%;
        }
        
        .profile-icon {
            width: 200px;
            height: 200px;
            border-radius: 10%;
            background-image: url('./images/profile.png');
            background-size: 80% 80%;
            background-repeat: no-repeat;
            background-position: center;
            border: 0;
            cursor: pointer;
        }

        .profile-icon:hover {
            opacity: 0.8;
        }

        input[type="file"] {
            display: none;
        }

        .progress-bar-container {
            background-color: #d0d0d0;
            border-radius: 20px;
            width: 100%;
            height: 20px;
            margin-top: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            height: 100%;
            background-color: #000;
            border-radius: 20px;
            width: 66.67%; /* Example width for progress */
        }

        .points {
            font-size: 16px;
            margin-top: 5px;
        }
        
        .dashboard-title {
            font-size: 32px;
            font-weight: bold;
            margin: 30 100 30 100;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }
        
        .main-content {
            width: 80%;
            padding: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .user-info .profile-icon {
            font-size: 50px;
        }

        .user-info .points {
            font-size: 16px;
            color: #555;
        }

        .links-section {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .link-card {
            flex: 1 1 calc(33.333% - 20px);
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .link-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .link-card img {
            width: 50px;
            margin-bottom: 10px;
        }

        .link-card h3 {
            font-size: 18px;
            margin: 10px 0 0;
        }
        
        /* Progress Bar Styles */
        

        
    </style>
</head>
<body>

<div class="dashboard-title">My Account

	<!-- profile header -->
	<div class="dashboard-header">
                <div class="profile-icon" id="profile-icon"></div>
                <input type="file" id="profile-upload" accept="image/*">
                
                <?php 
                $query = "SELECT username FROM users WHERE user_id = '$user_id'";
                $result = mysqli_query($dbc, $query);
                $row = mysqli_fetch_assoc($result);
                $name = $row['username'];
                ?>
               <div class="header-content">
                    <p><strong>Hello, <?= str_pad($name, 4, '0', STR_PAD_LEFT) ?></strong></p>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="width: <?= round($progress_percentage) ?>%;">
                            
                        </div>
                    </div>
                    <p class="points">
                        <?= $user_points ?>/<?= $tier_data[$next_tier] ?? $user_points ?> rising points - <?= $current_tier ?> Tier
                        <br>
                        <?= round($progress_percentage) ?>% to <?= $next_tier ?>
                    </p>
                </div>
            </div>  
</div>

<div class="dashboard-container">
	
	<?php include 'user_sidebar.php';?>
    

	<div class="main-content">
        <div class="links-section">
            <div class="link-card" onclick="window.location.href='user_events.php'">
                <img src="./images/user-events.png" alt="My Events" >
                <h3>My Events</h3>
            </div>
            <div class="link-card" onclick="window.location.href='user_transaction.php'">
                <img src="./images/user-donate.png" alt="Donation History">
                <h3>Transaction History</h3>
            </div>
            <div class="link-card" onclick="window.location.href='user_profile.php'">
                <img src="./images/user-profile.png" alt="Profile Info">
                <h3>Profile Info</h3>
            </div>
            <div class="link-card" onclick="window.location.href='user_rewards.php'">
                <img src="./images/user-rewards.png" alt="Rewards">
                <h3>Rewards</h3>
            </div>
           
        </div>
     </div>
</div>


</body>
</html>
<?php
    include 'footer.php';
?>
