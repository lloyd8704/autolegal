<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}

// Check if the user submitted the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the reference from the form
    $reference1 = $_POST["ref"];
    $reference2 = $_POST['email'];
    $reference = $reference1 . $reference2;
    // Connect to the database
    require_once "../../10_Database/connection.php";

    // Prepare the SQL statement to check if the reference exists in the database
    $stmt = $conn->prepare("SELECT * FROM correspondence WHERE test=?");
    $stmt->bind_param("s", $reference);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a row in the database with the given reference
    if ($result->num_rows >= 1) {
        // Set the session variable
        $_SESSION["loggedin"] = true;
        $_SESSION["reference"] = $reference1;

        // Return a success message
        echo "error";
    } else {
        // Return an error message
        echo "success";
        $author = $_POST['author'];
        if ($author == "lloyd") {
            $author_full_name = "Lloyd Manning";
        } else {
            $author_full_name = $_POST['author'];
        }

        $_SESSION["saveLocation"] = $_POST['saveLocation'];
        $_SESSION["email"] = $_POST['email'];
        $_SESSION["subject"] = strtoupper($_POST['subject']);
        $_SESSION["contact"] = $_POST['contact'];
        $_SESSION["theirref"] = $_POST['theirref'];
        $_SESSION["recipient"] = $_POST['recipient'];
        $_SESSION["eparagraph"] = $_POST['eparagraph'];
        $_SESSION["author"] = $_POST['author'];
        $_SESSION["author_full_name"] =  $author_full_name;
        $_SESSION["reference"] = $_POST["ref"];
        if ($_POST['saveLocation'] === "folder") {
            $_SESSION["path1"] = $_POST['path1'];
        }
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
