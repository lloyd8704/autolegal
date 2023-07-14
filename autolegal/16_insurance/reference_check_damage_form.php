<?php
// Start the session
session_start();

// Check if the user submitted the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the reference from the form
    $reference = filter_var($_POST["reference"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    // Connect to the database
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "correspdb";
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to check if the reference exists in the database
    $stmt = $conn->prepare("SELECT * FROM damage_claim WHERE reference=?");
    $stmt->bind_param("s", $reference,);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a row in the database with the given reference
    if ($result->num_rows >= 1) {
        // Set the session variable
        $_SESSION["loggedin"] = true;
        $_SESSION["reference"] = $reference;

        // Return a success message
        echo "success";
    } else {
        // Return an error message
        echo "error";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
