<?php

require_once '../16_insurance/vendor/autoload.php';

use Phpml\Classification\KNearestNeighbors;

// Prepare the training data
$samples = [];
$labels = [];

// Connect to the database
include "../16_insurance/db_connection.php";

// Prepare the SQL statement to fetch the training data
$stmt = $conn->prepare("
    SELECT location, COUNT(*) as count
    FROM claim_form
    GROUP BY location
");

$stmt->execute();
$result = $stmt->get_result();

// Build the training data
while ($row = $result->fetch_assoc()) {
    $location = $row['location'];
    $count = $row['count'];

    $samples[] = [$count];
    $labels[] = $location;
}

// Close the database connection
$stmt->close();
$conn->close();

// Create and train the classifier
$classifier = new KNearestNeighbors();
$classifier->train($samples, $labels);

// Prepare a new sample for prediction
$newSample = [[10]]; // Adjust the value according to your data

// Make a prediction
$predictions = $classifier->predict($newSample);

// Handle multiple predictions
if (is_array($predictions)) {
    $prediction = array_shift($predictions); // Take the first prediction
} else {
    $prediction = $predictions;
}

// Output the predicted location
echo "Predicted Location: " . $prediction;
