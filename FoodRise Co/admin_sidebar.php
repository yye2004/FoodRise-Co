<style>
        .dashboard-container {
            display: flex;
            padding: 20 20 20 20;
        }

        .sidebar {
            width: 20%;
            border-right: 1px solid #333;
        }

        .sidebar ul {
            list-style: none;
            padding-left: 70;
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
</style>    

<div class="sidebar">
        <ul>
        	<li><a href="admin_dashboard.php">Main Dashboard</a></li>
            <li><a href="admin_events.php">Events</a></li>
            <li><a href="admin_users.php">Users</a></li>
            <li><a href="admin_transaction.php">Transactions</a></li>
            <li><a href="admin_food.php">Pending Food Donation</a></li>
            <li><a href="admin_money.php">Pending Money Donation</a></li>
            <li><a href="admin_contactus.php">All Enquiries </a></li>
            <li><a href="logout.php"><strong>Logout</strong></a></li>
        </ul>
    </div>    