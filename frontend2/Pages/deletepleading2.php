<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
    <title>Delete a Pleading</title>
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

$test = $_POST['reference'];
$query = "SELECT * FROM `pleadings` WHERE reference='$test'";

session_start();
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reference = $row['reference'];
        $_SESSION['reference'] = $reference;
        $onepname = $row['onepname'];
        $onedname = $row['onedname'];
        echo "<br><br><div class='body-text1'><h1>You are about to delete - </h1></div>";
        echo "<div class='body-text1'><h1>  $reference - $onepname / $onedname</h1></div>";
        echo "<div class='body-text1'><h1>Are you sure you want to continue?</h1></div><br>";
        echo "<a class='btncorrespondence' href='../Pages/deletepleading3.php'>Yes</a>&nbsp&nbsp&nbsp&nbsp
        <a class='btncorrespondence' href='../Pages/deletepleading1.php'>No</a>";
    }
} else echo "<span class='error'><br>There is no file with that reference number - please try again</span>";
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