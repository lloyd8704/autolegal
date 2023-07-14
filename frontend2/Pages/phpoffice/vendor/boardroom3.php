<form method="post" action="boardroom2.php">
    <div id="container">
        <div class="form-group">
            <label for="user_name">Name:</label>
            <input type="text" name="user_name" required autocomplete="off"><br>

            <label for="date">Date:</label>
            <input type="date" name="date" required><br>

            <label for="start_time">Start Time:</label>
            <select name="start_time" id="start_time" required></select><br>

            <label for="end_time">End Time:</label>
            <select name="end_time" id="end_time" required></select><br>

            <input type="submit" value="Book">
        </div>
</form>
<script>
    const startTimeSelect = document.getElementById('start_time');
    const endTimeSelect = document.getElementById('end_time');

    for (let i = 8; i <= 17; i++) {
        const startOption = document.createElement('option');
        startOption.value = i + ':00';
        startOption.textContent = i + ':00';
        startTimeSelect.appendChild(startOption);

        const endOption = document.createElement('option');
        endOption.value = (i + 1) + ':00';
        endOption.textContent = (i + 1) + ':00';
        endTimeSelect.appendChild(endOption);
    }
</script>
<?php

if (isset($_GET['error'])) {
    echo $_GET['error'];
}
if (isset($_GET['success'])) {
    echo $_GET['success'];
}
?>
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
    $bookings[$start_hour][] = array('name' => $row['user_name'], 'duration' => $end_hour - $start_hour);
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

// Create content rows
for ($i = 8; $i <= 17; $i++) {
    echo '<div class="row">';
    echo '<div class="cell time">' . $i . ':00</div>';

    for ($j = 0; $j < 7; $j++) {
        $date = date('Y-m-d', strtotime("+{$j} day"));

        // Get bookings for the current date and hour
        $sql = "SELECT * FROM bookings WHERE date = '$date' AND start_time <= '{$i}:00:00' AND end_time >= '" . ($i) . ":00:00'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $class = 'booked';
            $text = '';
            while ($row = $result->fetch_assoc()) {
                $text .= $row['user_name'] . ' ';
            }
        } else {
            $class = 'available';
            $text = '';
        }

        echo '<div class="cell ' . $class . '">' . $text . '</div>';
    }

    echo '</div>';
}




$conn->close();
?>

<style>
    .container {
        position: relative;
    }

    .form-group {
        position: relative;
    }

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