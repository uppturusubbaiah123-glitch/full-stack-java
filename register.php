<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$department = $_POST['department'];

$sql = "INSERT INTO students (name, email, password, department)
        VALUES ('$name', '$email', '$password', '$department')";

if ($conn->query($sql) === TRUE) {
    echo "Registration Successful!";
} else {
    echo "Error: " . $conn->error;
}
?>