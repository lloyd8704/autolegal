<?php
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

// Get the booking ID from the URL parameter
$booking_id = $_GET['id'];

// Delete the booking from the database
$sql = "DELETE FROM bookings WHERE id = '$booking_id'";
if ($conn->query($sql) === TRUE) {
    echo "Booking deleted successfully";
} else {
    echo "Error deleting booking: " . $conn->error;
}

// Redirect the user to boardroom3.php
header("Location: boardroom3.php");
exit();

$conn->close();
