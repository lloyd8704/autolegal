<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../app.css" />
    <title>Create Letter</title>
</head>



<?php
$template = "echo '/frontend2/Documents/warning.png' ?>" >
    $servername = "localhost";
$username = "root";
$password = "";
$databasename = "correspdb";

// CREATE CONNECTION
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $databasename,
);


// GET CONNECTION ERRORS
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// SQL QUERY
$test = $_POST["reference"];
$query = "SELECT * FROM `pleadings` WHERE test='$test'";


// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {
        $number = $row["number"];
        $msg = $_POST["reference"];
        if ($number == "1") {
            echo "<br>1";
        } else if ($number == "2") {
            echo "2";
        } else if ($number == 3) {
            include 'index2.php';
        }
    }
}
