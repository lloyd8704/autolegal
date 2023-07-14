<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../app.css" />
    <title>Create a Pleading</title>
</head>

<body style="background-color: black">
    <navi>
        <div class="heading1">
            <h4>AutoLegal</h4>
        </div>
        <ul class="nav-linker">
            <li><a class="nav-link" href="../../../Index.html">Home</a></li>
            <li><a class="nav-link" href="../../newfile.html">New&nbspFile</a></li>
            <li><a class="nav-link" href="../../correspondence.html">Correspondence</a></li>
            <li><a class="nav-link active" href="../../pleadings.html">Pleadings</a></li>
            <li><a class="nav-link" href="../../contactshome.html">Contacts</a></li>
            <li><a class="nav-link" href="../../dropdownlegislation.php">Legislation</a></li>
            <li><a class="nav-link" href="../../edit.php">Edit</a></li>
        </ul>
    </navi>

</html>
<?php
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
session_start();
$test = $_POST["reference"];
$_SESSION["reference"] = $_POST["reference"];
$query = "SELECT * FROM `pleadings` WHERE reference='$test'";


// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    include('../vendor/page6.php');
} else {
    echo "<span class='error'><br>There is no file with that reference number - please try again</span>";
}

$conn->close();
