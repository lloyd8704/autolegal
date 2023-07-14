<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../9_Style/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
    <title>Edit Pleadings</title>
</head>

<body style="background-color: black">

    <nav>
        <div class="heading1">
            <h4>AutoLegal</h4>
        </div>
        <ul class="nav-linker">
            <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
            <li><a class="nav-link" href="../2_New_file/Index.php">New&nbspFile</a></li>
            <li><a class="nav-link" href="../3_Correspondence/Index.php">Correspondence</a></li>
            <li><a class="nav-link" href="../4_Pleadings/Index.php">Pleadings</a></li>
            <li><a class="nav-link" href="../5_Contacts/Index.php">Contacts</a></li>
            <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
            <li><a class="nav-link active" href="../7_Edit/Index.php">Edit</a></li>
            <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
        </ul>
    </nav>
</body>

<?php

require_once '../10_Database/connection.php';
$reference =  $_SESSION['reference'];
$savelocation = $_POST['saveLocation'];


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//if the user fails to make a selection.
if ($savelocation == "prompt") {
    $number = "";

    $sql = "UPDATE pleadings SET save = '$number' WHERE reference= '$reference'";
}
if ($savelocation == "folder") {
    $number = $_POST['path1'];


    $sql = "UPDATE pleadings SET save = '$number' WHERE reference= '$reference'";
}

// Check connection
//updating database - updating attorneyone and opponents column


if ($conn->query($sql) === TRUE) {
    echo "<span class='success'><br>Your file was sucessfully created!</span>";
} else {
    //msg if error
    echo "Error updating record: " . $conn->error;
}
?>

</html>