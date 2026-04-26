<?php
include 'db.php';

$event_name = $_POST['event_name'];
$description = $_POST['description'];
$event_date = $_POST['event_date'];
$venue = $_POST['venue'];
$capacity = $_POST['capacity'];

$sql = "INSERT INTO events (event_name, description, event_date, venue, capacity)
        VALUES ('$event_name', '$description', '$event_date', '$venue', '$capacity')";

$conn->query($sql);

header("Location: admin_dashboard.php");
exit();
?>