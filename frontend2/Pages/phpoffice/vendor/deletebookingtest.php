<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "correspdb";

// CREATE CONNECTION
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $databasename,
);
$conn = new mysqli($servername, $username, $password, $databasename);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete a booking if the delete button is pressed
if (isset($_POST['delete'])) {
    $id = $_POST['booking_id'];
    $sql = "DELETE FROM bookings WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $success = "Booking deleted successfully";
    } else {
        $error = "Error deleting booking: " . $conn->error;
    }
}

// Add a booking if the form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['user_name'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Check if the selected time slot is available
    $sql = "SELECT * FROM bookings WHERE date = '$date' AND start_time <= '$start_time' AND end_time > '$start_time'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error = "The selected time slot is already booked";
    } else {
        $sql = "INSERT INTO bookings (user_name, date, start_time, end_time) VALUES ('$name', '$date', '$start_time', '$end_time')";

        if ($conn->query($sql) === TRUE) {
            $success = "Booking created successfully";
        } else {
            $error = "Error creating booking: " . $conn->error;
        }
    }
}

// Get current date and time
$today = date('Y-m-d');
$start_time = '08:00:00';
$end_time = '17:00:00';

// Get bookings for current day and between 8:00 and 17:00 hours
$sql = "SELECT * FROM bookings WHERE date = '$today' AND start_time >= '$start_time' AND end_time <= '$end_time'";
$result = $conn->query($sql);

// Create calendar view
$bookings = array();
while ($row = $result->fetch_assoc()) {
    $start_hour = (int) substr($row['start_time'], 0, 2);
    $end_hour = (int) substr($row['end_time'], 0, 2);
    $bookings[$start_hour][] = array('name' => $row['user_name'], 'duration' => $end_hour - $start_hour, 'id' => $row['id']);
}

echo '<div class="calendar">';

// Create header row
echo '<div class="row header">';
echo '<div class="cell time"></div>';

for ($j = 0; $j < 7; $j++) {
    $date = date('Y-m-d', strtotime("+$j day"));
    $dayOfWeek = date('D', strtotime($date));
    $header = $dayOfWeek . ' ' . date('d/m', strtotime($date));
    echo '<div class="cell">' . $header . '</div>';
}
echo '</div>';
function getTimeslots()
{
    $timeslots = array();
    $start_time = strtotime('08:00');
    $end_time = strtotime('18:00');
    $interval = 60 * 30; // 30 minutes

    for ($i = $start_time; $i <= $end_time; $i += $interval) {
        $timeslots[] = date('h:i A', $i);
    }

    return $timeslots;
}


function getBookings($start_date, $end_date)
{
    // Connect to the database
    $db = new mysqli('localhost', 'root', '', 'correspdb');

    // Check for errors
    if ($db->connect_errno) {
        echo "Failed to connect to MySQL: " . $db->connect_error;
        exit();
    }

    // Query the database
    $query = "SELECT * FROM bookings WHERE date >= '$start_date' AND date <= '$end_date' ORDER BY date, start_time";
    $result = $db->query($query);

    // Create an array to hold the bookings
    $bookings = array();

    // Loop through the result set and add each row to the bookings array
    while ($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }

    // Close the database connection
    $db->close();

    // Return the bookings array
    return $bookings;
}

// Create content rows
$timeslots = getTimeslots();

for ($i = 0; $i < count($timeslots); $i++) {
    echo '<div class="row">';
    echo '<div class="cell time">' . $timeslots[$i] . '</div>';
    for ($j = 0; $j < 7; $j++) {
        $date = date('Y-m-d', strtotime("+$j day"));
        $bookings = getBookings($date, $timeslots[$i]);
        $booked = false;
        $booking_id = '';
        $booking_name = '';
        $booking_description = '';
        if (!empty($bookings)) {
            $booked = true;
            $booking_id = $bookings[0]['id'];
            $booking_name = $bookings[0]['name'];
            $booking_description = $bookings[0]['description'];
        }
        echo '<div class="cell ' . ($booked ? 'booked' : '') . '" data-date="' . $date . '" data-timeslot="' . $timeslots[$i] . '">';
        echo $booked ? '<a class="booking" href="edit_booking.php?id=' . $booking_id . '">' . $booking_name . '</a><br/>' : '';
        echo $booked ? $booking_description . '<br/>' : '';
        echo $booked ? '<button class="delete-booking" data-id="' . $booking_id . '">Delete</button>' : '<a class="add-booking" href="add_booking.php?date=' . $date . '&timeslot=' . $timeslots[$i] . '">Add Booking</a>';
        echo '</div>';
    }
    echo '</div>';
}


?>

<style>
    .calendar {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 20px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .header {
        background-color: #eee;
        font-weight: bold;
    }

    .cell {
        border: 1px solid #ccc;
        width: calc(100% / 9);
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .cell.time {
        flex-basis: 10%;
        font-weight: bold;
    }

    .cell.booked {
        background-color: #f00;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center
    }

    .cell.booked span {
        color: #fff;
    }

    .cell.available {
        background-color: #0f0;
    }

    .calendar {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 20px;
        width: 80%;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .header {
        background-color: #eee;
        font-weight: bold;
    }

    .cell {
        border: 1px solid #ccc;
        width: calc(100% / 10);
    }

    .cell.time {
        flex-basis: 10%;
        font-weight: bold;
    }

    .cell.booked {
        background-color: #f00;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cell.booked span {
        color: #fff;
    }

    .cell.available {
        background-color: #0f0;
    }

    .today {
        font-weight: bold;
        color: blue;
    }
</style>