<?php
// Include the db_connection.php file to establish a database connection
include "../16_insurance/db_connection.php";

// Check if the latitude and longitude values are received
if (isset($_POST['lat']) && isset($_POST['lng'])) {
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];

    // Perform any necessary validation or sanitization of the coordinates

    // Prepare the SQL statement to insert the location into the database
    $stmt = $conn->prepare("INSERT INTO claim_form (collision_coordinates) VALUES (?)");
    $stmt->bind_param("s", $coordinates);

    // Combine latitude and longitude into a single string
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $coordinates = $lat . ',' . $lng;

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Location saved successfully
        echo "Location saved successfully!";
    } else {
        // Error saving location
        echo "Error saving location.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid or missing latitude and longitude values
    echo "Invalid latitude or longitude.";
}
