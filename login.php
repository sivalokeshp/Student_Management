<?php
session_start();
include 'db.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $errors[] = "Both fields are required.";
    } else {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($row = $res->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user'] = $username;
                header("Location: dashboard.php");
                exit;
            } else {
                $errors[] = "Invalid username or password.";
            }
        } else {
            $errors[] = "Invalid username or password.";
        }
        $stmt->close();
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login - Student Management</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container small">
  <h2>Login</h2>

  <?php if ($errors): ?>
    <div class="error"><?php echo implode("<br>", array_map('htmlspecialchars', $errors)); ?></div>
  <?php endif; ?>

  <form method="post" action="login.php">
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>
  </form>

  <p>No account? <a href="register.php">Register here</a>.</p>
</div>
</body>
</html>
