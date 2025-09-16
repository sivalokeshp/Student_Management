<?php
session_start();
include("db.php");
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $roll = $_POST['roll'];

    $query = "INSERT INTO students (name, roll) VALUES ('$name', '$roll')";
    if ($conn->query($query)) {
        echo "<script>alert('Student added successfully');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>
    <h2>Add Student</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Student Name" required><br>
        <input type="text" name="roll" placeholder="Roll Number" required><br>
        <button type="submit">Add Student</button>
    </form>
    <br>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
