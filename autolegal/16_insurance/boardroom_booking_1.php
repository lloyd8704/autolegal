<!DOCTYPE html>
<html>

<head>
	<title>Boardroom Booking Calendar</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
			margin: 10px auto;
		}

		td {
			border: 1px solid #ccc;
			height: 40px;
			text-align: center;
			vertical-align: middle;
			width: 0%;
			position: relative;
		}

		.booked {
			background-color: blue;
		}
	</style>
</head>

<body>
	<h1>Boardroom Booking Calendar</h1>
	<br>
	<table>

		<?php
		// Connect to the database and fetch the bookings
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "correspdb";

		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		$query = "SELECT * FROM bookings";
		$result = mysqli_query($conn, $query);
		$bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);

		// Define the hours of the day
		$hours = array(
			'08:00', '09:00', '10:00', '11:00', '12:00',
			'13:00', '14:00', '15:00', '16:00', '17:00'
		);

		// Create a table to display the schedule
		echo '<table>';
		echo '<tr><th>Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th></tr>';

		foreach ($hours as $hour) {
			echo '<tr>';
			echo '<td>' . $hour . '</td>';

			// Loop through the days of the week
			for ($day = 1; $day <= 5; $day++) {
				$isBooked = false;

				// Check if there is a booking for this hour and day
				foreach ($bookings as $booking) {
					if ($booking['date'] == date('Y-m-d', strtotime('Monday this week') + ($day - 1) * 86400) && $booking['start_time'] <= $hour . ':00:00' && $booking['end_time'] > $hour . ':00:00') {
						$isBooked = true;
						$bookedBy = $booking['name'];
						break;
					}
				}

				// Mark the hour as booked if there is a booking
				if ($isBooked) {
					echo '<td style="background-color: blue; color: white"> ' . $bookedBy . '</td>';
				} else {
					echo '<td></td>';
				}
			}

			echo '</tr>';
		}

		echo '</table>';
		?>

	</table>
	<!-- Add your booking form here -->
</body>

</html>