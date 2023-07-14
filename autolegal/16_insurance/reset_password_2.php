<?php
// Start the session
session_start();
// Connect to the database
include "../16_insurance/db_connection.php";

// Check if the user is logged in
if (!isset($_SESSION['token']) || !$_SESSION['token']) {
    header('Location: login.html');
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
        $_SESSION["message"] = "New password and confirm password do not match.";
        header("Location: ../16_insurance/reset_password_4.php");

        exit();
    }

    // Check if the user has a valid token
    if (!isset($_SESSION['token']) || $_SESSION['token'] !== $_POST['token']) {
        session_start();
        $_SESSION["message"] = "Invalid token.";
        header("Location: ../16_insurance/reset_password_4.php");
        exit();
    }

    // Verify the new password meets the requirements
    $uppercase = preg_match('@[A-Z]@', $new_password);
    $number = preg_match('@[0-9]@', $new_password);
    if (strlen($new_password) < 8 || !$uppercase || !$number) {
        session_start();
        $_SESSION["message"] = "New password must be at least 8 characters long and contain at least one uppercase letter and one number.";
        header("Location: ../16_insurance/reset_password_4.php");
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $hashed_password, $username);
        $stmt->execute();

        // Return a success message
        session_start();
        $_SESSION["message"] = "Password changed successfully.";
        header("Location: ../16_insurance/reset_password_3.php");
    }

    // Close the database connection
    if ($stmt) {
        $stmt->close();
    }
    $conn->close();
}
