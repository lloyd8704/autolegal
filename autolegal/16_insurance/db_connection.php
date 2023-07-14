<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "correspdb";
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
