<?php
session_start();

// Check if the token is set and not empty
if (isset($_GET["token"]) && !empty($_GET["token"])) {
    $token = $_GET["token"];

    // Connect to the database
    include "../16_insurance/db_connection.php";

    // Check if the token exists in the database
    $query = "SELECT * FROM users WHERE temp_token = '$token'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Save the email address associated with the token in a session variable
        $row = mysqli_fetch_assoc($result);
        $_SESSION["email"] = $row["email"];
        $_SESSION["token"] = $token;
        // Redirect to the password reset page
        header("Location: reset_password_1.php");
        exit();
    } else {
        echo "Invalid token.";
    }
} else {
    echo "Token not found.";
}
