<?php
$host = "192.168.86.24";  
$user = "adrian";        
$pass = "oslo2021";  
$dbname = "user_system";     

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

http://192.168.86.24/
