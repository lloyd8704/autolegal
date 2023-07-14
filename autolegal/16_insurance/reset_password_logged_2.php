<?php
// Start the session
session_start();
// Connect to the database
include "../16_insurance/db_connection.php";

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, destroy session and redirect to login page
    session_destroy();
    header("Location: login.html");
    exit;
}

// Check if the user submitted the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the current user's username
    $username = $_SESSION['username'];

    // Get the new password from the form
    $new_password = $_POST["new_password"];
    $confirm_new_password = $_POST["confirm_new_password"];

    // Check if the new password matches the confirm password
    if ($new_password !== $confirm_new_password) {
        session_start();
        $_SESSION["message"] = "The passwords do not match.";
        header("Location: ../16_insurance/reset_password_logged_4.php");

        exit();
    }

    // Verify the new password meets the requirements
    $uppercase = preg_match('@[A-Z]@', $new_password);
    $number = preg_match('@[0-9]@', $new_password);
    if (strlen($new_password) < 8 || !$uppercase || !$number) {
        session_start();
        $_SESSION["message"] = "New password must be at least 8 characters long and contain at least one uppercase letter and one number.";
        header("Location: ../16_insurance/reset_password_logged_4.php");
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $hashed_password, $username);
        $stmt->execute();

        // Return a success message
        session_start();
        $_SESSION["message"] = "Password was successfully changed.";
        header("Location: ../16_insurance/reset_password_logged_3.php");
    }

    // Close the database connection
    if ($stmt) {
        $stmt->close();
    }
    $conn->close();
}
