<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
include 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header("Location: view_students.php");
    exit;
}

// fetch student
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$student = $res->fetch_assoc();
$stmt->close();

if (!$student) {
    header("Location: view_students.php");
    exit;
}

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
        $upd = $conn->prepare("UPDATE students SET name = ?, email = ?, course = ? WHERE id = ?");
        $upd->bind_param("sssi", $name, $email, $course, $id);
        if ($upd->execute()) {
            $success = "Student updated successfully.";
            // refresh student data
            $student['name'] = $name;
            $student['email'] = $email;
            $student['course'] = $course;
        } else {
            $errors[] = "Update failed: " . $upd->error;
        }
        $upd->close();
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Student - Student Management</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container small">
  <h2>Edit Student</h2>

  <?php if ($errors): ?>
    <div class="error"><?php echo implode("<br>", array_map('htmlspecialchars', $errors)); ?></div>
  <?php endif; ?>
  <?php if ($success): ?>
    <div class="success"><?php echo htmlspecialchars($success); ?></div>
  <?php endif; ?>

  <form method="post" action="edit_student.php?id=<?php echo $id; ?>">
    <label>Name</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($student['email']); ?>" required>

    <label>Course</label>
    <input type="text" name="course" value="<?php echo htmlspecialchars($student['course']); ?>" required>

    <button type="submit">Update Student</button>
  </form>

  <p><a href="view_students.php">Back to Students</a></p>
</div>
</body>
</html>
