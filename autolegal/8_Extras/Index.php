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
  <title>Extras</title>
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
      <li><a class="nav-link" href="../7_Edit/Index.php">Edit</a></li>
      <li><a class="nav-link active" id="plus" href="../8_Extras/Index.php">+</a></li>
    </ul>
  </nav>
  <label for="heading" class="searchheadings">Extras</label>
  <div class="button-container">
    <div class="row-container">
      <a href="../8_Extras/extras_date_calculator.php" id="button" class="btnnewfiles">Date Calculator</a>
      <a href="../8_Extras/extras_memo_1.php" class="btnnewfiles">Memo</a>
      <a href="../8_Extras/extras_file_note_1.php" class="btnnewfiles">File Note</a>
    </div>
    <div class="row-container">
      <a href="../8_Extras/extras_file_lever_large_1.php" class="btnnewfiles">Lever Arch - L</a>
      <a href="../8_Extras/extras_file_lever_small_1.php" class="btnnewfiles">Lever Arch - S</a>
    </div>
  </div>
  <img src="../11_Images/hex.png" class="hexagonlegislation" alt="Outline of three hexagons">
</body>

</html>