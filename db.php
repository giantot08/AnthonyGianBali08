<?php
$host = 'localhost'; // Change this if your database is hosted elsewhere
$dbname = 'salon'; // Your database name
$user = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>