<?php
// Get form data
// Get form data
$user_name = $_POST['user_name'];
$date = $_POST['date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "correspdb";

// CREATE CONNECTION
$conn = new mysqli($servername, $username, $password, $databasename);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the time slot is available
$sql = "SELECT * FROM bookings WHERE date='$date' AND ((start_time <= '$start_time' AND end_time >= '$start_time') OR (start_time <= '$end_time' AND end_time >= '$end_time'))";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // Booking already exists, redirect to boardroom3.php with error message
    header("Location: boardroom3.php?error=Sorry, this time slot is already booked.");
} else {
    // Add booking to database
    $sql = "INSERT INTO bookings (user_name, date, start_time, end_time) VALUES ('$user_name', '$date', '$start_time', '$end_time')";
    if ($conn->query($sql) === TRUE) {
        // Booking successful, redirect to boardroom3.php with success message
        header("Location: boardroom3.php?success=Booking successful!");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
