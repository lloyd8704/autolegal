<?php
// Start the session
session_start();

// Connect to the database
include "../16_insurance/db_connection.php";

// Check if the user submitted the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the reference from the form
    $reference = $_POST["reference"];
    $_SESSION['reference'] =  $reference;
    // Prepare the SQL statement to check if the reference exists in the claim_form table
    $stmt = $conn->prepare("SELECT * FROM claim_form WHERE reference = ?");
    $stmt->bind_param("s", $reference);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a row in the database with the given reference
    if ($result->num_rows == 1) {
        // Set the session variable
        $_SESSION["reference"] = $reference;

        // Return a success message
        echo "success";
        $redirect_url = "../16_insurance/chart_google_maps_4.php";
    } else {
        // Return an error message
        echo "error";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
