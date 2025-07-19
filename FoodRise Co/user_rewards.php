<?php
include 'header.php';
include 'mysqli_connect.php';
include ('rewards.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Royalty Program</title>
    <style>
        body {
            margin: 0;
            padding: 0;
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
        
        .container{
            display: flex;
            padding: 20 20 20 20;
        }

        .rewards-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2em;
            color: #333;
            text-align: center;
        }

        .points-section {
            text-align: center;
            margin: 20px 0;
        }

        .points-section h2 {
            font-size: 1.5em;
            color: #4CAF50;
        }

        .tier-info {
            background: #f0f8ff;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .tier-info h3 {
            font-size: 1.2em;
            color: #333;
        }

        .tier-info p {
            margin: 10px 0;
            color: #555;
            font-size: 1em;
        }

        .next-tier {
            background: #fffbe0;
            border: 1px solid #ffeeba;
            padding: 15px;
            border-radius: 8px;
            color: #856404;
        }

        /* Progress Bar Styles */
        .progress-bar-container {
            background-color: #e0e0e0;
            border-radius: 8px;
            width: 100%;
            height: 30px;
            margin-top: 20px;
        }

        .progress-bar {
            height: 100%;
            background-color: #4CAF50;
            text-align: center;
            color: white;
            line-height: 30px;
            border-radius: 8px;
            width: <?= round($progress_percentage) ?>%;
        }

        /* Rewards Section */
        .rewards-section {
            margin-top: 30px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .rewards-section h3 {
            font-size: 1.3em;
            color: #333;
            text-align: center;
        }

        .rewards-section ul {
            list-style-type: none;
            padding: 0;
        }

        .rewards-section li {
            font-size: 1em;
            margin: 10px 0;
        }

        .rewards-section .available-rewards {
            font-weight: bold;
            color: #4CAF50;
        }
    </style>
</head>
<body>

<div class="dashboard-title">My Rewards</div>
<div class="container">

<?php include 'user_sidebar.php';?>

    <div class="rewards-container">
        <h1>Rising Program</h1>

        <div class="points-section">
            <h2>You Have Earned <?= $user_points ?> Rising Points</h2>
        </div>

        <div class="tier-info">
            <h3>Your Current Tier: <?= $current_tier ?></h3>
            <?php if ($next_tier): ?>
                <div class="next-tier">
                    <p><strong>Next Tier: <?= $next_tier ?></strong></p>
                    <p>You need <strong><?= $points_to_next_tier ?> more rising points</strong> to reach <?= $next_tier ?> tier.</p>
                </div>
                
                <!-- Progress Bar -->
                <div class="progress-bar-container">
                    <div class="progress-bar">
                        <?= round($progress_percentage) ?>% to <?= $next_tier ?>
                    </div>
                </div>
            <?php else: ?>
                <p>Congratulations! You have achieved the highest tier: <strong>Platinum</strong>.</p>
            <?php endif; ?>
        </div>

        <div class="tier-info">
            <h3>How Points Are Earned</h3>
            <p><strong>Past Volunteering Events:</strong> Earn 10 points per volunteering.</p>
            <p><strong>Food Donation:</strong> Earn 1 point for every RM1 donated.</p>
            <p><strong>Money Donation:</strong> Earn 1 point for every 1kg or each unit donated.</p>
        </div>

        <!-- Rewards Section -->
        <div class="rewards-section">
            <h3>Redeem Your Rising Points for Rewards!</h3>
            <p>Based on the points you've earned, you can redeem the following rewards:</p>
            <ul>
                <?php foreach ($rewards as $reward => $points_required): ?>
                    <li>
                        <strong><?= $reward ?>:</strong> Requires <?= $points_required ?> points.
                        <?php if ($user_points >= $points_required): ?>
                            <span class="available-rewards">Available! Click to Redeem.</span>
                        <?php else: ?>
                            <span>Not enough points yet.</span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    </div>
</body>
</html>

<?php include 'footer.php';?>
