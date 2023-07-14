<?php

session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}
require_once "../10_Database/connection.php";

// GET CONNECTION ERRORS
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL QUERY
session_start();
$test = filter_var($_POST["reference"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$_SESSION["reference"] = $_POST["reference"];
$query = "SELECT * FROM `pleadings` WHERE reference='$test'";


// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    include('../4_Pleadings/pleadings_create_5e.php');
} else {
    echo "<span class='error'><br>There is no file with that reference number - please try again</span>";
}

$conn->close();
