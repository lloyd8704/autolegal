<!DOCTYPE html>
<html>

<head>
    <title>Edit Booking</title>
</head>

<body>
    <h1>Edit Booking</h1>
    <?php
    // Connect to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "correspdb";
    $conn = new mysqli($servername, $username, $password, $databasename);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the booking ID from the URL parameter
    $booking_id = $_GET['id'];

    // Query the database to retrieve the booking information for the given ID
    $sql = "SELECT * FROM bookings WHERE id = $booking_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Booking not found.");
    }

    // If the form has been submitted, update the booking in the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $date = $_POST['date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        $user_name = $_POST['user_name'];
        $sql = "UPDATE bookings SET user_name = '$user_name', date = '$date', start_time = '$start_time', end_time = '$end_time' WHERE id = $booking_id";
        if ($conn->query($sql) === TRUE) {
            echo "Booking updated successfully.";
        } else {
            echo "Error updating booking: " . $conn->error;
        }
    }
    ?>
    <form method="post" action="">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $row['date']; ?>" required><br><br>
        <label for="start_time">Start time:</label>
        <input type="time" id="start_time" name="start_time" value="<?php echo $row['start_time']; ?>" required><br><br>
        <label for="end_time">End time:</label>
        <input type="time" id="end_time" name="end_time" value="<?php echo $row['end_time']; ?>" required><br><br>
        <label for="user_name">User name:</label>
        <input type="text" id="user_name" name="user_name" value="<?php echo $row['user_name']; ?>" required><br><br>
        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">
        <input type="submit" value="Update booking">
    </form>
</body>

</html>