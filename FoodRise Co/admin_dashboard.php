<?php
// Include necessary configuration or database connection files
include 'mysqli_connect.php';
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FoodRise Co.</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
       

        
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

        .stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stats .card {
            width: 45%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .card p {
            margin: 5px 0 0;
            font-size: 14px;
        }

        .charts {
            display: flex;
            justify-content: space-between;
        }

        .chart {
            width: 45%;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        
    </style>
</head>
<body>

<div class="dashboard-title">Admin Dashboard</div>

<div class="dashboard-container">
    
    <?php include 'admin_sidebar.php';?>

    <div class="main-content">
        <div class="stats">
            <div class="card">
                <h3>Total Volunteers</h3>
                <p>2,000 volunteers</p>
            </div>
            <div class="card">
                <h3>Total Visitors</h3>
                <p>30,000 viewers</p>
            </div>
        </div>

        <div class="charts">
            <div class="chart">
                <h3>Engagement</h3>
                <canvas id="engagementChart"></canvas>
            </div>
            <div class="chart">
                <h3>Membership Type</h3>
                <canvas id="membershipChart"></canvas>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Engagement Chart
    const ctxEngagement = document.getElementById('engagementChart').getContext('2d');
    new Chart(ctxEngagement, {
        type: 'line',
        data: {
            labels: ['Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Engagement',
                data: [10, 20, 30, 40, 50],
                borderColor: '#333',
                fill: false
            }]
        }
    });

    // Membership Type Chart
    const ctxMembership = document.getElementById('membershipChart').getContext('2d');
    new Chart(ctxMembership, {
        type: 'pie',
        data: {
            labels: ['Silver', 'Bronze', 'Gold', 'Platinum'],
            datasets: [{
                label: 'Membership Type',
                data: [30, 20, 40, 10],
                backgroundColor: ['#aaa', '#bbb', '#ccc', '#ddd']
            }]
        }
    });
</script>

</body>
</html>
<?php include('footer.php');?>