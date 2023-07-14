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
    <title>Edit</title>
</head>

<body>

    <nav>
        <div class="heading1">
            <h4>AutoLegal</h4>

            <body style="background-color: black">
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
</body>
</nav>

<h1 class="body-text1"><br>What would you like to edit?</h1>

<img src="../11_Images/hex.png" class="hexagons3edit" alt="Outline of three hexagons">
<br>
<div>
    <a class="btnedit1" href="../7_Edit/edit_pleadings_1.php">&nbsp&nbsp&nbsp&nbsp&nbspEdit Pleadings&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>
</div>
<div>
    <a class="btnedit2" href="../7_Edit/edit_correspondence_1.php">Edit Correspondence</a>
</div>
<div>
    <a class="btnedit3" href="../7_Edit/edit_contacts_1.php">&nbsp&nbsp&nbsp&nbsp&nbspEdit a Contact&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>
</div>
<div>
    <a class="btndelete" href="../7_Edit/delete.php">&nbsp&nbspDelete a File</a>
</div>

</html>