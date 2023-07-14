<?php
// Start the session
session_start();

// Connect to the database
include "../16_insurance/db_connection.php";

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

    // Check if there is a row in the database with the given username
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        // Check if the entered password matches the hashed password
        if (password_verify($password, $hashed_password)) {
            // Set the session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            $_SESSION["timestamp"] = time(); // Set the timestamp
            $_SESSION["expire_time"] = time() + (2 * 60 * 60); // Set the expiration time to 2 hours from now


            // Return a success message
            echo "success";
            $redirect_url = "../16_insurance/index.php";
        } else {
            // Return an error message
            echo "error";
        }
    } else {
        // Return an error message
        echo "error";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
