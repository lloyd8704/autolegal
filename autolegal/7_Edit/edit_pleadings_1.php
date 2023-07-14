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
    <title>Edit</title>
</head>

<body style="background-color: black">
    <nav>
        <h4 class="heading1">AutoLegal</h4>

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
    </nav><br>
    <h1 class="body-text1">What part of the pleadings do you want to edit?</h1><br>

    <img src="../11_Images/hex.png" class="hexagons3" alt="Outline of three hexagons">
    <div class="container">
        <a href="../7_Edit/edit_pleadings_1a.php">General Details</a>
        <a href="../7_Edit/edit_pleadings_1b.php">Names of the Parties</a>
        <a href="../7_Edit/edit_pleadings_1c.php">Attorney Details</a>
        <a href="../7_Edit/edit_pleadings_1d.php">Save Location</a>
        <a href="../7_Edit/edit_pleadings_1e.php">Add a Party </a>
        <a class="btn-back" href="../7_Edit/Index.php">❮ Back&nbsp</a>
    </div>

    <style>
        body {
            overflow-y: hidden;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: -353px;
        }

        .container a.btn-back {
            width: 150px;
        }

        .container a {
            display: block;
            width: 250px;
            height: 55px;
            margin-bottom: 17px;
            text-align: center;
            line-height: 50px;
            background-color: black;
            color: white;
            border: 2px solid white;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            font-family: "Montserrat", sans-serif;
        }

        .container a:hover {
            background-color: white;
            color: black;
            cursor: pointer;
        }




        .body-text1 {

            position: relative;
            top: 20px;
        }
    </style>
</body>

</html>