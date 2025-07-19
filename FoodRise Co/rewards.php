<?php
// to calc rewards point. rm1/1kg = 1 point, volunteer 1 event = 10 points.

$user_id = $_SESSION['user_id']; 
$email = $_SESSION['email'];

// Fetch past event count (each event = 10 points)
$event_query = "SELECT COUNT(*) AS event_count FROM user_event ue JOIN events e ON ue.event_id = e.event_id
                WHERE ue.user_id = $user_id AND e.date < CURDATE();";
$event_result = @mysqli_query($dbc, $event_query);
$event_row = mysqli_fetch_assoc($event_result);
$event_points = $event_row['event_count'] * 10; // Each event = 10 points

// Fetch transaction history (RM1 = 1 point)
$transaction_query = "SELECT SUM(amount) AS total_amount FROM transactions WHERE user_id = $user_id";
$transaction_result = @mysqli_query($dbc, $transaction_query);
$transaction_row = mysqli_fetch_assoc($transaction_result);
$transaction_points = $transaction_row['total_amount']; // Each RM1 = 1 point

// Fetch food history (1kg/unit = 1 point)
$food_query = "SELECT SUM(quantity) AS total_quantity 
               FROM food_donations fd
               WHERE fd.email = '$email' AND fd.status = 'confirmed'";
$food_result = @mysqli_query($dbc, $food_query);
$food_row = mysqli_fetch_assoc($food_result);
$food_points = $food_row['total_quantity'];
 


// Total points
$user_points = $event_points + $transaction_points + $food_points;

$tier_data = [
    'Bronze' => 0,
    'Silver' => 200,
    'Gold' => 500,
    'Platinum' => 1000
];

// Determine the current tier and points needed for the next tier
$current_tier = 'Bronze';
$next_tier = null;
$points_to_next_tier = 0;
$progress_percentage = 0;

foreach ($tier_data as $tier => $points_required) {
    if ($user_points >= $points_required) {
        $current_tier = $tier;
    } elseif ($user_points < $points_required && $next_tier === null) {
        $next_tier = $tier;
        $points_to_next_tier = $points_required - $user_points;
        $progress_percentage = ($user_points / $points_required) * 100; // Calculate progress as percentage
    }
}

// Define the rewards based on points
$rewards = [
    'Tealive RM3 Voucher' => 300, // Points required for cash voucher redemption
    'Starbucks RM5 Vouchers' => 500, // Points required for gift card redemption
    'Touch N Go RM10 Cash Voucher' => 1000 // Points required for premium voucher redemption
];




?>