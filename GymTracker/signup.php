<?php
require 'db.php'; // Inneholder nå $conn (MySQLi)

// Sjekk om skjemaet er sendt inn
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Forbered spørring
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    
    // Bind og kjør
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->close();

    // Send videre til login
    header('Location: login.php');
    exit;
}
?>

<h2>Signup</h2>
<form method="POST">
    <input type="text" name="username" required placeholder="Username">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit">Signup</button>
</form>
<a href="login.php">Already have an account? Login</a>

