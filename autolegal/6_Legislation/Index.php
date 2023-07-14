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
    <title>Legislation</title>
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
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
            <li><a class="nav-link active" href="../6_Legislation/Index.php">Legislation</a></li>
            <li><a class="nav-link" href="../7_Edit/Index.php">Edit</a></li>
            <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
        </ul>
    </nav>
    </div>
    <br>
    <label for="heading" class="searchheadings">Select the first letter of the legislation you want to view:</label>

    <div class="button_container_legislation">

        <a href="../6_Legislation/legislationa-c.php" class="btnnewfiles">A - C</a>
        <a href="../6_Legislation/legislationd-f.php" class="btnnewfiles">D - F&nbsp</a>
        <a href="../6_Legislation/legislationg-i.php" class="btnnewfiles">G - I&nbsp</a>
        <a href="../6_Legislation/legislationj-l.php" class="btnnewfiles">J - L&nbsp</a>
        <a href="../6_Legislation/legislationm-o.php" class="btnnewfiles">M - O</a>
        <a href="../6_Legislation/legislationp-r.php" class="btnnewfiles">P - R</a>
        <a href="../6_Legislation/legislations-u.php" class="btnnewfiles">S - U</a>
        <a href="../6_Legislation/legislationv-x.php" class="btnnewfiles">V - X&nbsp</a>
        <a href="#" class="btnnewfiles1" disabled>Y - Z</a>
    </div>
    <br><br><br>
    <img src="../11_Images/hex.png" class="hexagonlegislation" alt="Outline of three hexagons">

    <style>
        .searchheadings {
            color: white;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            font-size: x-large;
            position: relative;
            left: 360px;
            top: 45px;
            text-align: center;
            width: 800px;

        }

        .button_container_legislation {
            width: 624px;
            height: 456px;

            overflow-y: auto;
            margin-left: 447px;
            display: flex;
            flex-direction: row;
            align-items: center;
            flex-wrap: wrap;
            align-content: center;
            text-align: center;
            margin-top: -113px;
        }

        .button_container_legislation>a,
        .button_container_legislation>button {
            width: 170px;
            height: 60px;
            background-color: black;
            color: white;
            font-weight: bold;
            padding: 12px 25px;
            border: none;
            margin: 15px;
        }

        .btnnewfiles {
            background-color: black;
            color: white;
            font-weight: bold;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            border: 2px solid white;
            cursor: pointer;
        }

        .btnnewfiles1 {
            background-color: black;
            color: gray;
            font-weight: bold;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            border: 2px solid gray;
            cursor: default;
        }

        /*back button hover*/
        .btnnewfiles:hover {
            background-color: white;
            color: black;
            border: solid 2px black;
            background: #fff;
            color: #1f1f1f !important;
        }

        a.btnnewfiles:link,
        a.btnnewfiles:visited,
        a.btnnewfiles:hover,
        a.btnnewfiles:active {
            color: white;
            text-decoration: none;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            font-size: large;
            padding: 18px 38px;
            border: none;
            border-radius: 4px;
            border: 2px solid white;
            cursor: pointer;
            position: relative;
            top: 100px;
        }

        a.btnnewfiles1:link,
        a.btnnewfiles1:visited,
        a.btnnewfiles1:hover,
        a.btnnewfiles1:active {
            color: gray;
            text-decoration: none;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            font-size: large;
            padding: 18px 38px;
            border: none;
            border-radius: 4px;
            border: 2px solid grey;
            cursor: default;
            position: relative;
            top: 100px;
        }

        /* disabled button styling */
        a.btnnewfiles1 {
            pointer-events: none;
            opacity: 0.5;
        }

        .btnnewfiles1 {
            display: block;
            width: 170px;
            height: 60px;
            background-color: black;
            color: gray;
            font-weight: bold;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            border: 2px solid grey;
            cursor: default;
            margin: 15px;
        }

        /* hexagon image styling */
    </style>
</body>

</html>