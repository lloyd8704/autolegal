<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
    <title>Delete Correspondence</title>
</head>

<body style="background-color: black">
    <div id="test">
        <navi>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../Index.html">Home</a></li>
                <li><a class="nav-link" href="../Pages/newfile.html">New&nbspFile</a></li>
                <li><a class="nav-link" href="../Pages/correspondence.html">Correspondence</a></li>
                <li><a class="nav-link" href="../Pages/pleadings.html">Pleadings</a></li>
                <li><a class="nav-link" href="../Pages/contactshome.html">Contacts</a></li>
                <li><a class="nav-link" href="../Pages/dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-link active" href="edit.php">Edit</a></li>
            </ul>
        </navi>
</body>
<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'correspdb';


$conn = new mysqli($server, $user, $pass, $db);
session_start();
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$file = $_SESSION['reference'];
// sql to delete a record
$sql = "DELETE FROM correspondence WHERE test='$file'";

if (mysqli_query($conn, $sql)) {
    echo "<span class='success'><br>Your file was successfully deleted</span>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>