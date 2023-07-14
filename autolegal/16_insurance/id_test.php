<!DOCTYPE html>
<html>

<head>
    <title>South African ID Number Parser</title>
</head>

<body>
    <h1>South African ID Number Parser</h1>

    <form method="POST" action="">
        <label for="identity">South African ID Number:</label>
        <input type="text" name="identity" id="identity" required>
        <br>
        <input type="submit" value="Submit">
    </form>

    <?php
    $identity = $_POST['identity'];

    // Extracting date of birth
    $date_of_birth = substr($identity, 0, 6); // Extract the first 6 characters
    $day = substr($date_of_birth, 4, 2);
    $month = substr($date_of_birth, 2, 2);
    $year_prefix = (substr($date_of_birth, 0, 2) <= 30) ? '20' : '19';
    $year = $year_prefix . substr($date_of_birth, 0, 2);
    $formatted_date_of_birth = $day . ' ' . date("F", mktime(0, 0, 0, $month, 1)) . ' ' . $year; // Format the date of birth as "12 December 2022"

    // Extracting gender
    $gender_digits = substr($identity, 6, 4); // Extract the 7th to 10th characters
    $gender = ($gender_digits >= 0 && $gender_digits <= 4999) ? 'Female' : 'Male'; // Determine gender based on assigned number range

    // Extracting SA citizen status
    $citizen_status = substr($identity, 10, 1); // Extract the 11th character
    $citizen = ($citizen_status == 0) ? 'SA Citizen' : 'Permanent Resident'; // Determine SA citizen status based on the assigned digit

    // Extracting the checksum digit (Z)
    $checksum_digit = substr($identity, -1); // Extract the last character

    // Calculating current age
    $current_year = date('Y'); // Get the current year
    $age = $current_year - $year;

    // Output the results
    echo "<h2>Results:</h2>";
    echo "Date of Birth: $formatted_date_of_birth <br>";
    echo "Gender: $gender <br>";
    echo "SA Citizen Status: $citizen <br>";
    echo "Checksum Digit: $checksum_digit <br>";
    echo "Age: $age <br>";

    ?>
</body>

</html>