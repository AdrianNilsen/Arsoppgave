<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Add workout if form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_workout'])) {
    $date = $_POST['date'];
    $text = $_POST['text'];

    $valgdato = date('Y-m-d', strtotime($date));
    $now = date('Y-m-d');

    if ($now > $valgdato) {
        echo "Du kan ikke legge til en workout i fremtiden!";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO workouts (user_id, workout_date, workout_text) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $date, $text);

    if (!$stmt->execute()) {
        die("Database error: " . $stmt->error);
    }

    $stmt->close();
}

// Fetch workouts
$stmt = $conn->prepare("SELECT workout_date, workout_text FROM workouts WHERE user_id = ? ORDER BY workout_date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result(); // Important!
?>
<!DOCTYPE html>
<html>
<head>
    <title>Workout Tracker</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
<h2>Workout Tracker</h2>

<form method="POST" action="index.php">
    <label>Date:</label><br>
    <input type="date" name="date" required value=<?php echo date('Y-m-d')?>>
    
    <label>Workout:</label><br>
    <input type="text" name="text" required><br><br>

    <button type="submit" name="add_workout">Add Workout</button>
</form>

<h3>Your Workouts:</h3>
<ul>
<?php
while ($row = $result->fetch_assoc()) {
    echo "<li><strong>" . htmlspecialchars($row['workout_date']) . ":</strong> " . htmlspecialchars($row['workout_text']) . "</li>";
}
$stmt->close();
?>
</ul>

<a href="logout.php">Logout</a>

</body>
</html>

