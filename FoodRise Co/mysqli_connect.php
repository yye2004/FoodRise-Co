<?php


$host = 'localhost';
$dbname = 'foodrise1';
$username = 'root';
$password = '';



// Make the connection:
$dbc = mysqli_connect($host, $username, $password, $dbname);

if (!$dbc) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
} 


// Set the encoding...
mysqli_set_charset($dbc, 'utf8');


?>
