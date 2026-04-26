<?php
$conn = new mysqli("localhost", "root", "", "campus_portal");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM students 
            WHERE email='$email' 
            AND password='$password' 
            AND role='admin'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        echo "Login Success";
        // header("Location: admin_dashboard.php");
    } else {
        echo "Invalid Admin Login!";
    }
}
?>