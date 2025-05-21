<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <!-- register.php -->
<form method="POST" action="register.php">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="register">Register</button>
</form>





<?php

require_once 'db.php'; // include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Step 1: Get the submitted data
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
        exit; // stop further execution
    }

    $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $checkStmt->bind_param("s", $username);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "Brukernavnet er allerede i bruk.";
        $checkStmt->close();
        exit;
    }
    $checkStmt->close();


    // Step 2: Prepare the SQL query
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password); // "ss" means 2 strings

    // Step 3: Execute and handle result
    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Step 4: Clean up
    $stmt->close();
}



?>
</body>
</html>