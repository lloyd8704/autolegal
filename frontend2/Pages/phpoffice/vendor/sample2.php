<?php
// Connect to the database


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "correspdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select all rows from the database
$sql = "SELECT * FROM Pleadings";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Output each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Ref: " . $row["reference"] . " - Number: " . $row["number"] . "<br>";
    }
} else {
    echo "0 results";
}

// Close the connection
mysqli_close($conn);
