<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$username = htmlspecialchars($_SESSION['user']);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard - Student Management</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
  <header class="topbar">
    <h1>Student Management System</h1>
    <div>
      Welcome, <strong><?php echo $username; ?></strong> |
      <a href="add_student.php">Add Student</a> |
      <a href="view_students.php">View Students</a> |
      <a href="logout.php">Logout</a>
    </div>
  </header>

  <main>
    <h2>Dashboard</h2>
    <p>This is your dashboard. Use the links above to manage students.</p>
  </main>
</div>
</body>
</html>
