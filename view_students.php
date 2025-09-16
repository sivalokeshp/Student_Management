<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';

$result = $conn->query("SELECT * FROM students ORDER BY created_at DESC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Students - Student Management</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
  <header class="topbar">
    <h1>Student Management System</h1>
    <div>
      <a href="dashboard.php">Dashboard</a> |
      <a href="add_student.php">Add Student</a> |
      <a href="logout.php">Logout</a>
    </div>
  </header>

  <main>
    <h2>Students</h2>
    <table class="table">
      <thead>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Created</th><th>Actions</th></tr>
      </thead>
      <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo (int)$row['id']; ?></td>
          <td><?php echo htmlspecialchars($row['name']); ?></td>
          <td><?php echo htmlspecialchars($row['email']); ?></td>
          <td><?php echo htmlspecialchars($row['course']); ?></td>
          <td><?php echo htmlspecialchars($row['created_at']); ?></td>
          <td>
            <a class="btn" href="edit_student.php?id=<?php echo (int)$row['id']; ?>">Edit</a>
            <a class="btn danger" href="delete_student.php?id=<?php echo (int)$row['id']; ?>" onclick="return confirm('Delete this student?');">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </main>
</div>
</body>
</html>
