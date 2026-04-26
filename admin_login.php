<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Hardcoded admin credentials
if ($email === "admin@gmail.com" && $password === "admin123") {
    $_SESSION['admin'] = $email;
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Invalid Admin Login!";
}
?>