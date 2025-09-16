<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef2f7; margin: 0; }
        .navbar {
            background: #343a40; padding: 15px; display: flex; justify-content: space-between; align-items: center;
        }
        .navbar a {
            color: white; margin: 0 10px; text-decoration: none; font-weight: bold;
        }
        .navbar a:hover { color: #ffc107; }
        .content { padding: 40px; text-align: center; }
        .card {
            background: white; padding: 20px; margin: 20px auto; width: 300px;
            border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="navbar">
        <span style="color:white;">Welcome, <?php echo $_SESSION['username']; ?> 👋</span>
        <div>
            <a href="add.php">Add</a>
            <a href="view.php">View</a>
            <a href="profile.php">My Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="content">
        <h1>Dashboard</h1>
        <div class="card">
            <h3>Quick Access</h3>
            <p>Use the navigation above to manage students.</p>
        </div>
    </div>
</body>
</html>
