<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$student_email = $_SESSION['email'];

// Get student id
$student_query = $conn->query("SELECT id FROM students WHERE email='$student_email'");
$student = $student_query->fetch_assoc();
$student_id = $student['id'];

// Register logic
if (isset($_GET['register'])) {

    $event_id = $_GET['register'];

    $check = $conn->query("SELECT * FROM registrations 
                           WHERE student_id='$student_id' 
                           AND event_id='$event_id'");

    if ($check->num_rows == 0) {
        $conn->query("INSERT INTO registrations (student_id, event_id) 
                      VALUES ('$student_id', '$event_id')");
        $message = "Successfully Registered!";
    } else {
        $message = "You already registered for this event!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand">Campus Event Portal</span>
        <span class="text-white">Welcome <?php echo $_SESSION['email']; ?></span>
    </div>
</nav>

<div class="container mt-5">

    <?php if(isset($message)) echo "<div class='alert alert-info'>$message</div>"; ?>

    <h2>Available Events</h2>

    <div class="row mt-4">

        <?php
        $result = $conn->query("SELECT * FROM events");

        while ($row = $result->fetch_assoc()) {
        ?>

        <div class="col-md-4">
            <div class="card p-3 mb-4 shadow-sm">
                <h5><?php echo $row['event_name']; ?></h5>
                <p><strong>Date:</strong> <?php echo $row['event_date']; ?></p>
                <p><strong>Venue:</strong> <?php echo $row['venue']; ?></p>
                <p><strong>Capacity:</strong> <?php echo $row['capacity']; ?></p>

                <?php
                $check = $conn->query("SELECT * FROM registrations 
                                       WHERE student_id='$student_id' 
                                       AND event_id='".$row['id']."'");

                if ($check->num_rows > 0) {
                    echo "<button class='btn btn-secondary w-100' disabled>Registered</button>";
                } else {
                    echo "<a href='?register=".$row['id']."' class='btn btn-success w-100'>Register</a>";
                }
                ?>
            </div>
        </div>

        <?php
        }
        ?>

    </div>

    <a href="logout.php" class="btn btn-danger">Logout</a>

</div>

</body>
</html>