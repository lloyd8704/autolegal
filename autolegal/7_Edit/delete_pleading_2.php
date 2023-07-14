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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../9_Style/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
    <title>Delete a Pleading</title>
</head>

<body style="background-color: black">
    <div id="test">
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
include "../16_insurance/db_connection.php";

$test = $_SESSION['reference'];
$query = "SELECT * FROM `pleadings` WHERE reference='$test'";


$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reference = $row['reference'];
        $_SESSION['reference'] = $reference;
        $onepname = $row['onepname'];
        $onedname = $row['onedname'];
        echo "<div class='body-text1'><h1><br>You are about to delete - </h1></div>";
        echo "<div class='body-text1'><h1>  $reference - $onepname / $onedname</h1></div>";
        echo "<div class='body-text1'><h1>Are you sure you want to continue?</h1></div><br>";
        echo "<a class='btncorrespondence' href='../7_Edit/delete_pleading_1.php'>No</a>&nbsp&nbsp&nbsp&nbsp
        <a class='btncorrespondence' href='../7_Edit/delete_pleading_3.php'>Yes</a>";
    }
}
?>
<style>
    a.btncorrespondence:link,
    a.btncorrespondence:visited,
    a.btncorrespondence:hover,
    a.btncorrespondence:active {
        color: white;
        text-decoration: none;
        font-family: "Montserrat", sans-serif;
        font-weight: bold;
        font-size: large;
        padding: 18px 48px;
        border: none;
        border-radius: 4px;
        border: 2px solid white;
        cursor: pointer;
        position: relative;
        left: 538px;
        top: 38px;
        width: 25mm;
    }
</style>