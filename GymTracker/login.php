<?php
session_start();
require 'db.php'; // Make sure db.php includes the $conn connection (MySQLi)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Forbered og bind spørringen (MySQLi)
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); // Bind parameteren for username
    $stmt->execute();

    // Hent resultatene
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $hashed_password); // Bind resultater
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Logg inn
            $_SESSION['user_id'] = $user_id;
            header('Location: index.php');
            exit;
        } else {
            echo "Feil passord.";
        }
    } else {
        echo "Bruker finnes ikke.";
    }

    $stmt->close(); // Husk å lukke statementet
}
?>

<h2>Login</h2>
<form method="POST">
    <input type="text" name="username" required placeholder="Username">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit">Login</button>
</form>
<a href="signup.php">Don't have an account? Signup</a>

