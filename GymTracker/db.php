<?php
$servername = "10.2.3.130";  // Your database server IP
$username = "adrian";        // Your database username
$password = "oslo2021";  // Your database password
$dbname = "gym";     // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>

