<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, destroy session and redirect to login page
    session_destroy();
    header("Location: login.html");
    exit;
}

// Check if the user submitted the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the reference from the form
    $reference = filter_var($_POST["reference"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Connect to the database
    include "../16_insurance/db_connection.php";
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
