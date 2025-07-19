<?php
include 'mysqli_connect.php';
include 'header.php';

// Connect to the database
$dbc = mysqli_connect($host, $username, $password, $dbname);

// Query to fetch current (future) events
$current_query = "SELECT event_id, event_name, DATE_FORMAT(date, '%M %d, %Y') AS event_date, time, location
                  FROM events
                  WHERE date >= CURDATE()
                  ORDER BY date ASC";

$current_result = @mysqli_query($dbc, $current_query); // Execute the query for current events

// Query to fetch past events
$past_query = "SELECT event_id, event_name, DATE_FORMAT(date, '%M %d, %Y') AS event_date, time, location
               FROM events
               WHERE date < CURDATE()
               ORDER BY date DESC";

$past_result = @mysqli_query($dbc, $past_query); // Execute the query for past events

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Overview - FoodRise Co.</title>
    <link rel="stylesheet" href="style.css">
    <!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
    <style>
        /* General Page Styling */
        body {
            margin: 0;
        }

        .volunteer-title {
            font-family:'Lexend Deca' ;
            font-size: 52px;
            font-weight: 900;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
            margin: 50 200 20 200;
        }
        
        .container {
            padding: 0px 0px;
        }

        h1, h2 {
            font-family: 'Lexend Deca';
            color: #333;
        }

        h1 {
            margin-top: 0;
            font-size: 2em;
            font-weight: 900;
            
        }

        h2 {
            margin: 30 0 30 0;
            font-size: 48;
            text-align: center;
        }

        

        .sign-up{
            border-top: 1px solid #333;
            border-bottom: 1px solid #333;
            padding: 10 0 10 0;
            margin: 50 200 20 200;
            text-align: center;
            justify-items: center;
        }
        
        .sign-up h1{
            font-size: 60px;
            margin: 0 0 0 0;
            padding: 20 0 10 0;
        }
        
        .sign-up p{
            font-size: 28px;
            width: 75%;
            margin: 0 0 0 0;
            padding: 40 0 60 0;
        }

        .event-list {
            margin: 0;
        }

        .event {
            display: flex;
            align-items: center;
            margin: 50 200 50 200;
            border-radius: 10px;
        }
        
        .event button {
            font-family: 'Quicksand';
            color: #000;
            padding: 10px 40px;
            font-size: 18px;
            background-color: #fff;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
        }


        .event button:hover {
            background-color: #000;
            color: #fff;
        }
        
        .event-date {
            font-family: 'Lexend Deca';
            width: 80px;
            height: 80px;
            background-color: #fff;
            color: #000;
            padding: 10px 10px 10px 10px;
            text-align: center;
            border-radius: 20px;
            margin-right: 50px;
            font-size: 18px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        
        .event-date h4 {
            font-family: 'Lexend Deca';
            margin: 0;
            border:0;
            font-weight: bold;
            padding: 10 0 3 0;
        }
        .event-date h3{
            font-family: 'Lexend Deca';
            margin: 0;
            border:0;
            font-weight: bold;
            padding: 0 0 0 0;
            font-size: 28px;
        }
        
        .event-info {
        width: 650px;
       
            margin: 0;
           
        }

        .event-info h3 {
        margin: 0;
        font-size: 28px;
        font-family: 'Lexend Deca';
        font-weight: bold;
         text-decoration: underline;
         
            color: #333;
        }

        .event-info p {
            margin: 10 0 0 0;
            color: #555;
        }
        
        

        .news-button{
            display:flex;
            justify-content: center;
            align-items: center;
        }
        
        .news-button button, .sign-up button {
            font-family: 'Quicksand';
            color: #fff;
            padding: 15px 40px;
            margin-bottom: 50px;
            font-size: 18px;
            background-color: #000;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.5s ease;
        }
       
        .news-button button:hover, .sign-up button:hover {
            background-color: #fff;
            color: #000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .swiper-container {
            width: 80%; 
            height: 400px;
            margin: 20px auto;
            overflow: hidden; 
            position: relative;
        }

        .swiper-wrapper {
            display: flex; 
            gap: 20px; 
        }
        
        .swiper-slide {
            flex: 0 0 100%; 
            display: flex;
            justify-content: center; 
            align-items: center; 
        }
        
        .swiper-slide img {
            width: 60%; 
            height: 100%;
            object-fit: cover; 
            border-radius: 10px; 
            margin: 20 20 20 20;
        }
       
    </style>
</head>
<body>
    <!-- Header -->
    

    <!-- Main Content -->
    <div class="volunteer-title">Volunteeering Overview</div>
    <div class="container">
        <h2>Happening Soon!</h2>
        
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $image_query = "SELECT event_id, event_name, DATE_FORMAT(date, '%M %d, %Y') AS event_date, time, location
                  FROM events
                  WHERE event_id IN (18, 5)
                  ORDER BY date ASC";
                $image_result = @mysqli_query($dbc, $image_query);
                while ($row = mysqli_fetch_array($image_result, MYSQLI_ASSOC)) {
                    // Dynamically create image paths
                    $image_path = "./images/event_" . $row['event_id'] . ".png";
                    echo '<div class="swiper-slide">
                            <img src="' . $image_path . '" alt="' . htmlspecialchars($row['event_name']) . '">
                          </div>';
                }
                ?>
            </div>

    <!-- Navigation buttons -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>
</div>
        
	 <!-- Sign Up now -->
        <div class="sign-up">
        	<h1>Sign Up Now!</h1>
        	<p>Register as a member and earn extra 200 reward points on your first contribution.</p>
        	<div class="member-button"><button onclick="window.location.href='signup.php'">Become A Member >></button></div>
        </div>
        
        
    <!-- Upcoming Events -->
<h2>Upcoming Events</h2>
<div class="event-list">
    <?php
    // Display upcoming events
    $current_result = @mysqli_query($dbc, $current_query);
    while ($row = mysqli_fetch_array($current_result, MYSQLI_ASSOC)) {
        echo '<div class="event">
                <div class="event-date">
                    <h4>' . date('d M', strtotime($row['event_date'])) . '</h4>
                    <h3>' . date('D', strtotime($row['event_date'])) . '</h3>
                </div>
                <div class="event-info">
                    <h3>' . $row['event_name'] . '</h3>
                    <p>' . $row['time'] . ' @ ' . $row['location'] . '</p>
                </div>
                <button onclick="window.location.href=\'event_info.php?event_id=' . $row['event_id'] . '\'">Register Now</button>
            </div>';
    }
    ?>
</div>

<!-- Past Events -->
<h2>Past Events</h2>
<div class="event-list">
    <?php
    // Display past events
    $past_result = @mysqli_query($dbc, $past_query);
    while ($row = mysqli_fetch_array($past_result, MYSQLI_ASSOC)) {
        echo '<div class="event">
                <div class="event-date">
                    <h4>' . date('d M', strtotime($row['event_date'])) . '</h4>
                    <h3>' . date('D', strtotime($row['event_date'])) . '</h3>
                </div>
                <div class="event-info">
                    <h3>' . $row['event_name'] . '</h3>
                    <p>' . $row['time'] . ' @ ' . $row['location'] . '</p>
                </div>
            </div>';
    }
    ?>
</div>


        <div class="news-button"><button onclick="window.location.href='news.php'">Read Our Newsletter</button></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/countdown/2.6.0/countdown.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // Initialize Swiper after the DOM is ready
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    });
    </script>
</body>
</html>
<?php 
include 'footer.php'; 
?>
