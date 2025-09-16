<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';

$errors = [];
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');

    if ($name === '' || $email === '' || $course === '') {
        $errors[] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email.";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (name, email, course) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $course);
        if ($stmt->execute()) {
            $success = "Student added successfully.";
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Student - Student Management</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container small">
  <h2>Add Student</h2>

  <?php if ($errors): ?>
    <div class="error"><?php echo implode("<br>", array_map('htmlspecialchars', $errors)); ?></div>
  <?php endif; ?>
  <?php if ($success): ?>
    <div class="success"><?php echo htmlspecialchars($success); ?></div>
  <?php endif; ?>

  <form method="post" action="add_student.php">
    <label>Name</label>
    <input type="text" name="name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Course</label>
    <input type="text" name="course" required>

    <button type="submit">Add Student</button>
  </form>

  <p><a href="dashboard.php">Back to Dashboard</a> | <a href="view_students.php">View Students</a></p>
</div>
</body>
</html>
