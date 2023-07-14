<!DOCTYPE html>
<html>

<head>
    <title>Book a Room</title>
    <style>
        .free {
            background-color: #00FF00;
        }

        .booked {
            background-color: #FF0000;
            cursor: not-allowed;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Get the current date
            var date = new Date();
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            if (month < 10) {
                month = '0' + month;
            }
            var day = date.getDate();
            if (day < 10) {
                day = '0' + day;
            }
            var today = year + '-' + month + '-' + day;

            // Set the default date to today
            $('#date').val(today);

            // Load the room availability for the current week
            loadAvailability(today);
        });

        function loadAvailability(date) {
            // Get the room availability for the given date
            $.ajax({
                url: 'get_availability.php',
                type: 'GET',
                data: {
                    date: date
                },
                success: function(response) {
                    // Update the table with the new availability
                    $('#availability').html(response);

                    // Add click event listeners to the free slots
                    $('.free').click(function() {
                        var startTime = $(this).attr('data-start-time');
                        var endTime = $(this).attr('data-end-time');
                        var bookingName = prompt('Enter a name for your booking:');
                        if (bookingName) {
                            // Submit the booking form
                            $('#booking-form input[name="start_time"]').val(startTime);
                            $('#booking-form input[name="end_time"]').val(endTime);
                            $('#booking-form input[name="user_name"]').val(bookingName);
                            $('#booking-form').submit();
                        }
                    });
                }
            });
        }
    </script>
</head>

<body>
    <h1>Book a Room</h1>
    <form id="booking-form" method="post" action="save_booking.php">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required><br><br>
        <input type="hidden" name="start_time" value="">
        <input type="hidden" name="end_time" value="">
        <label for="user_name">Your name:</label>
        <input type="text" id="user_name" name="user_name" required><br><br>
        <input type="submit" value="Book">
    </form>
    <br>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
        </thead>
        <tbody id="availability">
        </tbody>
    </table>
</body>

</html>