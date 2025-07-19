
<style>
body {
    margin: 0;
    padding: 0;
}

.sidebar {
    width: 30%;
    border-right: 1px solid #333;
}

.sidebar ul {
    list-style: none;
    padding-left: 100;
}

.sidebar ul li {
    font-family: 'Quicksand';
    font-weight: bold;
    padding-bottom: 50px;
}

.sidebar ul li a {
    text-decoration: none;
    color: #333;
    font-size: 16px;
    transition: all 0.3s ease;
}

.sidebar ul li a:hover {
    text-decoration: underline;
    font-size: 17px;
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


        }
    </style>
    
    <div class="sidebar">
        <ul>
        	<li><a href="user_dashboard.php">Main Dashboard</a></li>
            <li><a href="user_events.php">My Events</a></li>
            <li><a href="user_transaction.php">Transaction</a></li>
            <li><a href="user_food.php">Food Donation</a></li>
            <li><a href="user_profile.php">Profile Info</a></li>
            <li><a href="user_rewards.php">Rewards</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>