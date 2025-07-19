<?php
include 'mysqli_connect.php';
include 'header.php';
//
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - FoodRise Co.</title>
    
    <style> 
        body{
            margin:0;
        }
        
       .welcome {
            background-image: url('./images/index-bg.png'); /* Replace with your background image path */
            background-size: cover;
            background-position: center top;
            height: 87vh; 
            position: relative;
            display: flex;  
            justify-content: center;
            align-items: center;
        }

        
 
        @keyframes fadeInUp {
            from {
                opacity: 0;                  
                transform: translateY(20px);    
            }
            to {
                opacity: 1;                   
                transform: translateY(0);       
            }
        }


/* Text and content inside .welcome */

        .content {
            padding: 50 400 100 200;
            position: absolute;
            color: white;
            text-align: left;
            animation: fadeInUp 3s forwards;
        }

        .content h1 {
            font-family: 'Lexend Deca';
            font-size: 52px;
            font-weight: 900;
        }

        .welcome button {
            font-family: 'Quicksand';
            position: absolute;
            bottom: 80px;
            right: 150px;
            padding: 15px 40px;
            font-size: 18px;
            background-color: #FDFFC9;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.5s ease;
            animation: fadeInUp 3s forwards;
        }
       
        .welcome button:hover {
            background-color: #000;
            color: #fff;
        }
        
        .impact {
            height: 60vh;
            padding: 100 200 100 200;
        }
        
        .upcoming{
            background-color:EAEBC4;
            height: 60vh;
            padding: 100 200 100 200;
        }
        
        .contribute {
            height: 60vh;
            padding: 100 200 100 200;
        }
        
        .newsletter{
            background-color:EAEBC4;
            height: 70vh;
            padding: 100 200 100 200;
        }
        
        .title {
            font-family:'Lexend Deca' ;
            font-size: 52px;
            font-weight: 900;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
        }
        
        .impact-button{
            display:flex;
            justify-content: center;
            align-items: center;
        }
        
        .impact button {
            font-family: 'Quicksand';
            padding: 15px 40px;
            font-size: 18px;
            background-color: #D6CF94;
            color: #fff;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.5s ease;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }
       
        .impact button:hover {
            background-color: #000;
            color: #D6CF94;
        }
        
        .cards {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-top: 80px;
            margin-bottom: 80px;
            gap: 50px;
        }
        
        .cards .stat {
            background-color: #FFF;
            padding: 20px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            width: 30%;
            transition: transform 0.5s ease;
            animation: fadeInCard 3s forwards;
        }
        
        .cards .stat h1 {
            font-size: 36;
            font-weight: 900;
            color: #333;
            margin-top: 15px;
            margin-bottom: 10px;
        }
        
        .cards .stat h3 {
            font-size: 16;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .cards .stat:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        .event {
            display: flex;
            align-items: center;
            margin-top: 20px;
            margin-bottom: 20px;
            justify-content: flex-start;
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
            transition: transform 0.5s ease;
        }
        
        .event-date:hover {
            transform: scale(1.05);
            background-color: #D6CF94;
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
        
        .event-button{
            display:flex;
            justify-content: center;
            align-items: center;
        }
        
        .event-button button {
            font-family: 'Quicksand';
            margin-top:10px;
            margin-bottom:20px;
            padding: 15px 40px;
            font-size: 18px;
            background-color: #FFFFE7;
            color: #000;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.5s ease;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }
       
        .event-button button:hover {
            background-color: #000;
            color: #fff;
        }
        
        .cards .vol {
            background-image: url('./images/vol-bg.png');
            background-size: cover; 
            background-position: center; 
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            height: 200px;
            transition: transform 0.5s ease;
            display: flex;              /* Use flexbox */
    justify-content: center;    /* Horizontally center content */
    align-items: center;        /* Vertically center content */
    text-align: center;         /* Center the text within h1 */
        }
        
        .cards .don {
            background-image: url('./images/don-bg.png');
            background-size: cover; 
            background-position: center; 
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            height: 200px;
            transition: transform 0.5s ease;
            display: flex;              /* Use flexbox */
    justify-content: center;    /* Horizontally center content */
    align-items: center;        /* Vertically center content */
    text-align: center;         /* Center the text within h1 */
        }
        
        .cards .vol h1, .don h1{
            margin: 0;                  /* Remove default margin */
    font-size: 48px; 
        }
        
        .cards .don:hover, .vol:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }
        
        .newsletter-event-card {
    background-color: #fff;
    margin: 20px 0;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.newsletter-event-card:hover {
    transform: scale(1.02);
}

.newsletter-event-card h2 {
    font-size: 24px;
    font-weight: bold;
    margin: 0 0 10px 0;
}

.newsletter-event-card .event-date {
    font-size: 16px;
    color: #666;
    margin: 0 0 15px 0;
}

.newsletter-event-card .event-description {
    font-size: 16px;
    color: #333;
    line-height: 1.6;
    margin-bottom: 20px;
    width: 80%;
}

.newsletter-event-card .newsletter-button-container {
        display: flex;
        justify-content: flex-end;
    }

.newsletter button {
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

.newsletter button:hover {
    background-color: #eee;
    color: #000;
    </style>
</head>
<body>

	<div class="welcome">
		<div class="content">
		<h1>Welcome to FoodRise Co., an accessible platform where compassionate individuals can volunteer to fight for hunger. Every action you take brings us one step closer to achieving zero hunger.</h1>
		</div>
		
		<button onclick="window.location.href='aboutus.php'">Find Out More</button>
	</div>
	
	<div class="impact">
		<div class="title">Impact At A Glance</div>
		
		<div class="cards">
		
			<div class="stat">
                <h3>Meals Donated</h3>
                <h1>8,000</h1>
                <p>servings</p>
            </div>
            
            <div class="stat">
                <h3>Volunteers Engaged</h3>
                <h1>8,000</h1>
                <p>persons</p>
            </div>
            
            <div class="stat">
                <h3>Food Waste Reduced</h3>
                <h1>200</h1>
                <p>kilograms</p>
            </div>
		
		</div>
		<div class="impact-button"><button onclick="window.location.href='signup.php'">Join Our Movement</button></div>
		
	</div>
	
	<div class="upcoming">
	<?php // Connect to the database
        $dbc = mysqli_connect($host, $username, $password, $dbname);
        
        // Query to fetch current (future) events
        $current_query = "SELECT event_id, event_name, DATE_FORMAT(date, '%M %d, %Y') AS event_date, time, location
                          FROM events
                          WHERE date >= CURDATE()
                          ORDER BY date ASC LIMIT 3";
        
        $current_result = @mysqli_query($dbc, $current_query); ?>
		<div class="title">Upcoming Events</div>
		
		<div class="event-list">
    <?php
    // Display upcoming events
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
          
          <div class="event-button"><button onclick="window.location.href='volunteer.php'">View All</button></div>
	</div>
	
	<div class="contribute">
		<div class="title">How can I contribute in ending hunger?</div>
		<div class="cards">
		
			<div class="vol" onclick="window.location.href='volunteer.php'">
                <h1>Volunteering</h1>
            </div>
            
            <div class="don" onclick="window.location.href='donate.php'">
                <h1>Donating</h1>
            </div>
            
		
		</div>
	</div>
    
    <div class="newsletter">
    <div class="title">Newsletter and Past Events</div>
    <?php 
    $sql = "SELECT news_id, title, posted_date, content FROM news ORDER BY posted_date DESC LIMIT 2";
    
    $result = mysqli_query($dbc, $sql);
    
    $news_list = [];
    if ($result) {
        $news_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        echo "<p>Error fetching news articles: " . mysqli_error($dbc) . "</p>";
    }
    ?>
    <div class="past-events">
    <?php foreach ($news_list as $news): ?>
        <div class="newsletter-event-card">
            <h2><?php echo htmlspecialchars($news['title']); ?></h2>
            <p class="newsletter-event-date"><?php echo htmlspecialchars($news['posted_date']); ?></p>
            <p class="newsletter-event-description">
                <?php 
                    // Display a snippet of the content (150 characters)
                    echo htmlspecialchars(substr($news['content'], 0, 150)) . '...';
                ?>
            </p>
            <div class="newsletter-button-container">
                <button class="read-more" onclick="window.location.href='newscontent.php?news_id=<?php echo $news['news_id']; ?>'">Read More</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>

<?php
    include 'footer.php';
?>
</body>
</html>
