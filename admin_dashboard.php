<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">Admin Dashboard</span>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</nav>

<div class="container mt-4">

    <!-- Add Event Card -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            Add New Event
        </div>
        <div class="card-body">
            <form action="add_event.php" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" name="event_name" class="form-control" placeholder="Event Name" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="date" name="event_date" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="text" name="venue" class="form-control" placeholder="Venue" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <input type="number" name="capacity" class="form-control" placeholder="Capacity" required>
                    </div>

                    <div class="col-12 mb-3">
                        <textarea name="description" class="form-control" placeholder="Description" required></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Add Event</button>
            </form>
        </div>
    </div>

    <!-- Registered Students Table -->
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            All Registered Students
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Event</th>
                            <th>Registered Date</th>
                        </tr>
                    </thead>
                    <tbody>

<?php
$sql = "SELECT students.name, students.email, 
               events.event_name, registrations.reg_date
        FROM registrations
        JOIN students ON registrations.student_id = students.id
        JOIN events ON registrations.event_id = events.id
        ORDER BY registrations.reg_date DESC";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>".$row['name']."</td>
            <td>".$row['email']."</td>
            <td>".$row['event_name']."</td>
            <td>".$row['reg_date']."</td>
          </tr>";
}
?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</body>
</html>