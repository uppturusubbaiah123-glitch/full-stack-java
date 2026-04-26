<?php
session_start();
include 'db.php';

$student_id = $_SESSION['student_id'];
$event_id = $_POST['event_id'];

// Check if already registered
$check = "SELECT * FROM registrations 
          WHERE student_id='$student_id' 
          AND event_id='$event_id'";

$result = $conn->query($check);

if ($result->num_rows > 0) {
    echo "You already registered for this event!";
} else {

    $sql = "INSERT INTO registrations (student_id, event_id)
            VALUES ('$student_id', '$event_id')";

    $conn->query($sql);

    echo "Registered Successfully!";
}

echo "<br><a href='student_dashboard.php'>Back</a>";
?>