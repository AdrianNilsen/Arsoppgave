<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
<!-- login.php -->
<form method="POST" action="login.php">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Log In</button>
</form>

<a href="register.php">Register</a>



<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    // Få resultatet som en array
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        
    if ($user && password_verify($password, $user['password'])) {
        // Passordet stemmer
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        // Feil brukernavn eller passord
        echo "Ugyldig brukernavn eller passord.";
    }
}

}
?>




</body>
</html>
