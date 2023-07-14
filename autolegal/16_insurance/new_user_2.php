<?php
// Start the session
session_start();
// Connect to the database
include "../16_insurance/db_connection.php";
// Check if the user submitted the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /// Get the username, password and email from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];


    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement to add a new user
    $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $email);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Return a success message
        echo "New user added successfully";
    } else {
        // Return an error message
        echo "Error adding new user: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
