<?php
// Assuming you have already included db_connection.php
include "../16_insurance/db_connection.php";
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Retrieve the reference from the GET parameters
    $reference = $_GET["reference"];

    // Prepare a SELECT query to retrieve the latest update based on the reference
    $selectQuery = "SELECT `update` FROM claim_form WHERE reference = ?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $reference);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a result
    if ($result->num_rows > 0) {
        // Fetch the latest update
        $row = $result->fetch_assoc();
        $latestUpdate = $row['update'];

        // Display the latest update
        echo "Latest Update: $latestUpdate";
    } else {
        // No update found
        echo "No update found for the given reference.";
    }
}
