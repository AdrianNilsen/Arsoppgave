<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Legg til workout hvis form sendt
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_workout'])) {
    $date = $_POST['date'];
    $text = $_POST['text'];

    $stmt = $conn->prepare("INSERT INTO workouts (user_id, workout_date, workout_text) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $date, $text);
    $stmt->execute();
    $stmt->close();
}

// Hent workouts
$stmt = $conn->prepare("SELECT workout_date, workout_text FROM workouts WHERE user_id = ? ORDER BY workout_date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result(); // Viktig at denne er her!

?>
<!DOCTYPE html>
<html>
<head><title>Workout Tracker</title></head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
<body>
<h2>Workout Tracker</h2>

<form method="POST" action="index.php">
    <label>Date:</label><br>
    <input type="date" name="date" required><br><br>

    <label>Workout:</label><br>
    <input type="text" name="text" required><br><br>

    <button type="submit" name="add_workout">Add Workout</button>
</form>

<h3>Your Workouts:</h3>
<ul>
<?php
while ($row = $result->fetch_assoc()) {
    echo "<li><strong>" . $row['workout_date'] . ":</strong> " . htmlspecialchars($row['workout_text']) . "</li>";
}
$stmt->close();
?>
</ul>

<a href="logout.php">Logout</a>

</body>
</html>
