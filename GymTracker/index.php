<?php
session_start();
require 'db.php'; // This will give access to $conn (MySQLi)

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Handle new workout submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Use $conn (MySQLi) to insert new workout
    $stmt = $conn->prepare("INSERT INTO workouts (user_id, date, exercise, weight, reps) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issii", 
        $_SESSION['user_id'], 
        $_POST['date'], 
        $_POST['exercise'], 
        $_POST['weight'], 
        $_POST['reps']
    );
    $stmt->execute();
    $stmt->close();
}

// Fetch all workouts for the logged-in user
$stmt = $conn->prepare("SELECT * FROM workouts WHERE user_id = ? ORDER BY date DESC");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$workouts = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<h2>Track Your Workouts</h2>

<!-- Form to add new workout -->
<form method="POST">
    <input type="date" name="date" required>
    <input type="text" name="exercise" required placeholder="Exercise">
    <input type="number" name="weight" required placeholder="Weight (kg)">
    <input type="number" name="reps" required placeholder="Reps">
    <button type="submit">Add Workout</button>
</form>

<!-- Table displaying workout history -->
<h3>Your Workout History</h3>
<table border="1">
    <tr>
        <th>Date</th>
        <th>Exercise</th>
        <th>Weight (kg)</th>
        <th>Reps</th>
    </tr>
    <?php foreach ($workouts as $workout): ?>
        <tr>
            <td><?= htmlspecialchars($workout['date']) ?></td>
            <td><?= htmlspecialchars($workout['exercise']) ?></td>
            <td><?= htmlspecialchars($workout['weight']) ?> kg</td>
            <td><?= htmlspecialchars($workout['reps']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="logout.php">Logout</a>
