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

<form action="../7_Edit/edit_pleadings_2d.php" method="post">
    <label for="heading" class="searchheading">Edit Save Location:</label>
    <div class="searchlable">
        <label for="cname">Reference number:</label>
    </div>
    <div class="col-75">
        <input type="text" class="input4" id="reference" autocomplete='off' style="text-transform:capitalize" name="reference" value="" autofocus="on" required>
    </div>
    <div><br><br><br><br><br><br>
        <input type="submit" tabindex="2" class="inputcreate" value="Next&nbsp ❯">
    </div>
    <div>
        <a class="btnsearch" tabindex="1" href="../7_Edit/edit_pleadings_1.php">❮&nbsp&nbspBack</a>
    </div>
    </div>
    <img src="../11_Images/hex.png" class="hexagons" alt="Outline of three hexagons">
    <img src="../11_Images/hex2.png" class="hexagons2" alt="Outline of two hexagons">
    <style>
        .searchheading {
            left: 606px;
        }

        body {
            overflow: hidden;
        }
    </style>

</html>