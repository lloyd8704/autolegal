<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "correspdb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $date = $_POST["date"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];

    // Check if slot is available
    $sql = "SELECT * FROM bookings WHERE date='$date' AND start_time<='$start_time' AND end_time>='$end_time'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "This time slot is already booked.";
        echo "<h2>Booked Slots:</h2>";
        echo "<table>";
        echo "<tr><th>Name</th><th>Start Time</th><th>End Time</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["name"] . "</td><td>" . $row["start_time"] . "</td><td>" . $row["end_time"] . "</td></tr>";
        }
        echo "</table>";
    }
} else {
    // Book the slot
    $sql = "INSERT INTO bookings (name, date, start_time, end_time) VALUES ('$name', '$date', '$start_time', '$end_time')";
    if ($conn->query($sql) === TRUE) {
        echo "Booking successful.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Get booked slots for selected date
if (isset($_GET["date"])) {
    $date = $_GET["date"];
    $sql = "SELECT * FROM bookings WHERE date='$date'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<h2>Booked Slots:</h2>";
        echo "<table>";
        echo "<tr><th>Name</th><th>Start Time</th><th>End Time</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["name"] . "</td><td>" . $row["start_time"] . "</td><td>" . $row["end_time"] . "</td></tr>";
        }
        echo "</table>";
    }
}
$conn->close();
