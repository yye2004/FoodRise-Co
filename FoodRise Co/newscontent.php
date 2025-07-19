<?php
include('header.php');
include('mysqli_connect.php');

$news = null;
if (isset($_GET['news_id']) && is_numeric($_GET['news_id'])) {
    $news_id = $_GET['news_id'];
    $sql = "SELECT title, content, posted_date FROM news WHERE news_id = $news_id";
    $result = mysqli_query($dbc, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $news = mysqli_fetch_assoc($result);
    } else {
        $error_message = "News item not found.";
    }
} else {
    $error_message = "Invalid or missing news ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Details</title>
    <style>
        .news-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            font-family: 'Montserrat';
        }
        .news-title {
            font-size: 24px;
            font-weight: bold;
        }
        .news-date {
            font-size: 12px;
            color: #555;
            margin-top: 10px;
        }
        .news-content {
            margin-top: 20px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
<div class="news-container">
    <?php if ($news): ?>
        <h1 class="news-title"><?php echo $news['title']; ?></h1>
        <p class="news-date">Posted on: <?php echo $news['posted_date']; ?></p>
        <div class="news-content"><?php echo '<br>'.($news['content']); ?></div>
    <?php else: ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
</div>
<?php include('footer.php'); ?>
</body>
</html>
