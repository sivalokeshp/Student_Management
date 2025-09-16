<?php
// db.php - Database connection
$DB_HOST = 'localhost';
$DB_USER = 'root';      // change if necessary
$DB_PASS = 'PSL2026';          // change if necessary
$DB_NAME = 'student_db';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// set charset
$conn->set_charset("utf8mb4");
?>
