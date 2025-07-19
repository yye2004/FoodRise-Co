<?php
include('header.php');
require('mysqli_connect.php');

// Modify query to select the necessary fields
$sql = "SELECT news_id, title, posted_date, content FROM news ORDER BY posted_date DESC";

$result = mysqli_query($dbc, $sql);

$news_list = [];
if ($result) {
    $news_list = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "<p>Error fetching news articles: " . mysqli_error($dbc) . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Our Updates - FoodRise</title>
    <style>
        .past-events {
            margin: 50px 200px 100px 200px;
            font-family: 'Quicksand', sans-serif;
        }

        .news-title {
            font-family: 'Lexend Deca';
            font-size: 52px;
            font-weight: 900;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
            margin: 50px 200px 20px 200px;
        }

        .event-card {
            background-color: #fff;
            margin: 20px 0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .event-card:hover {
            transform: scale(1.02);
        }

        .event-card h2 {
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 10px 0;
        }

        .event-card .event-date {
            font-size: 16px;
            color: #666;
            margin: 0 0 15px 0;
        }

        .event-card .event-description {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
            margin-bottom: 20px;
            width: 80%;
        }

        .event-card .button-container {
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
    </style>
</head>
<body>

<div class="news-title">Our Updates</div>

<div class="past-events">
    <?php foreach ($news_list as $news): ?>
        <div class="event-card">
            <h2><?php echo htmlspecialchars($news['title']); ?></h2>
            <p class="event-date"><?php echo htmlspecialchars($news['posted_date']); ?></p>
            <p class="event-description">
                <?php 
                    // Display a snippet of the content (150 characters)
                    echo htmlspecialchars(substr($news['content'], 0, 150)) . '...';
                ?>
            </p>
            <div class="button-container">
                <button class="read-more" onclick="window.location.href='newscontent.php?news_id=<?php echo $news['news_id']; ?>'">Read More</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php 
include('footer.php');
?>

</body>
</html>
