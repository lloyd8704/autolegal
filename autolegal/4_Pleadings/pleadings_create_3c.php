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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../9_Style/style.css" />
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
    <title>Create a Pleading</title>
</head>

<body style="background-color: black">
    <nav>
        <div class="heading1">
            <h4>AutoLegal</h4>
        </div>
        <ul class="nav-linker">
            <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
            <li><a class="nav-link" href="../2_New_file/Index.html">New&nbspFile</a></li>
            <li><a class="nav-link" href="../3_Correspondence/Index.html">Correspondence</a></li>
            <li><a class="nav-link active" href="../4_Pleadings/Index.html">Pleadings</a></li>
            <li><a class="nav-link" href="../5_Contacts/Index.html">Contacts</a></li>
            <li><a class="nav-link" href="../6_Legislation/Index.html">Legislation</a></li>
            <li><a class="nav-link" href="../7_Edit/Index.html">Edit</a></li>
            <li><a class="nav-link" id="plus" href="../8_Extras/Index.html">+</a></li>
        </ul>
    </nav>
</body>

<body>
    <form action="../4_Pleadings/pleadings_create_4c.php" method="post">
        <label for="heading" class="searchheading" id="searchheading">Create a Pleading:</label>
        <div class="searchlable">
            <label for="cname">Reference number:</label>
        </div>
        <div class="col-75">
            <input type="text" class="input4" id="reference" style="text-transform:capitalize" name="reference" value="" autofocus="on" required autocomplete="off">
        </div>
        <div><br><br><br><br><br><br>
            <input type="submit" tabindex="2" class="inputsearch" value="Next ❯" name="register">
        </div>
        <?php
        session_start();
        $whichcourt = $_SESSION['whichcourt'];
        if ($whichcourt == "MC") {
            echo "<div>
                <a class='btnsearch' id='btnsearchpleadings' href='../4_Pleadings/pleadings_create_2a.html'>❮&nbsp&nbspBack</a>
            </div>
            </div>";
        }
        if ($whichcourt == "HC") {
            echo "<div>
                <a class='btnsearch' id='btnsearchpleadings' href='../4_Pleadings/pleadings_create_2b.html'>❮&nbsp&nbspBack</a>
            </div>
            </div>";
        }
        ?>
        <img src="../11_Images/hex.png" class="hexagons" alt="Outline of three hexagons">
        <img src="../11_Images/hex2.png" class="hexagons2" alt="Outline of two hexagons">
</body>


</html>