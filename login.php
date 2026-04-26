<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM students 
        WHERE email='$email' AND password='$password'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();   // 🔥 Get student data

    $_SESSION['student_id'] = $row['id'];   // ✅ Store ID
    $_SESSION['email'] = $row['email'];

    header("Location: student_dashboard.php");
    exit();

} else {
    echo "Invalid Email or Password!";
}
?>