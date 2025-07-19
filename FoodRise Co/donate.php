<?php
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Donation - FoodRise</title>
    <style>
    .donate-container {
    margin: 50 200 100 200;
    font-family: 'Quicksand', sans-serif;
}
.donate-title {
            font-family:'Lexend Deca' ;
            font-size: 52px;
            font-weight: 900;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }
        
        .donate-desc{
            padding: 20 0 30 50;
            border-bottom: 1px solid #333;
        }
        
.donate-card {
    background-color: #fff;
    margin: 20px 0;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.donate-card:hover {
    transform: scale(1.02);
}

.donate-card h2 {
    font-size: 24px;
    font-weight: bold;
    margin: 0 0 10px 0;
}



.donate-card .donate-description {
    font-size: 16px;
    color: #333;
    line-height: 1.6;
    margin-bottom: 20px;
    width: 80%;
}

.donate-card .button-container {
        display: flex;
        justify-content: flex-end;
    }

button {
    display: inline-block;
    font-family: 'Quicksand', sans-serif;
    background-color: #000;
    border: 1px solid #000;
    color: #fff;
    padding: 10px 30px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    text-decoration: none;
    font-size: 16px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

button:hover {
    background-color: #eee;
    color: #000;
    }
    
    .donate-image {
    width: 20%;
  height: 20%;
  object-fit: contain;
    }
 
    </style>
</head>
<body>




<div class="donate-container">

<div class="donate-title">Donation Drive</div>

<div class="donate-desc">
<h1>You can make a difference.</h1>
<p>Join us in making the world a better place.</p>
</div>
    <div class="donate-card">
        <h2>Food Donation</h2>
        <p class="donate-description">Contribute by donating non-perishable food items that will be distributed to local shelters and families in need. Your donations directly help fight hunger and ensure nutritious meals for those in crisis.</p>
        <img src="images/fooddonate.png" class="donate-image" />
        <div class="button-container">
        <button class="read-more" onclick="window.location.href='fooddonation.php'">Learn More</button>
        </div>
    </div>

    <div class="donate-card">
        <h2>Money Donation</h2>
        <p class="donate-description">Support our mission by making a financial contribution. Every penny helps provide meals, fund food distribution, and sustain long-term hunger relief programs.
        </p>
        <img src="images/moneydonate.png" class="donate-image" />
        <div class="button-container">
        <button class="read-more" onclick="window.location.href='moneydonation.php'">Donate Now</button>
        </div>
    </div>
</div>




    
    <?php 
    include('footer.php'); 
    ?>
    
  </body>
</html>
