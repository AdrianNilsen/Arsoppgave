<?php
$host = "10.2.2.247";  
$user = "adrian";        
$pass = "oslo2021";  
$dbname = "user_system";     

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

