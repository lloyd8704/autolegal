<?php
// Connect to the database
include "../16_insurance/db_connection.php";
// Start the session
session_start();

// Check if the user submitted the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare the SQL statement to check the username and password
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a row in the database with the given username and password
    if ($result->num_rows == 1) {
        // Set the session variable
        $stmt->fetch();
        if (password_verify($password, $pw));
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;

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
