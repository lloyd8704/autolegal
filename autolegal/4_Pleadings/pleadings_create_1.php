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
  <title>MC or HC</title>
  <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
</head>

<body>
  <div id="test">
    <nav>
      <div class="heading1">
        <h4>AutoLegal</h4>

        <body style="background-color: black">
      </div>
      <ul class="nav-linker">
        <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
        <li><a class="nav-link" href="../2_New_file/Index.php">New&nbspFile</a></li>
        <li><a class="nav-link" href="../3_Correspondence/Index.php">Correspondence</a></li>
        <li><a class="nav-link active" href="../4_Pleadings/Index.php">Pleadings</a></li>
        <li><a class="nav-link" href="../5_Contacts/Index.php">Contacts</a></li>
        <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
        <li><a class="nav-link" href="../7_Edit/Index.php">Edit</a></li>
        <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
      </ul>
    </nav>
    <div class="body-text1">
      <h1><br>Which court?</h1>
    </div>
    <br>
    <div class="buttons">
      <a class="btncorrespondence" href="../4_Pleadings/pleadings_create_2a.php">Magistrates Court</a>&nbsp&nbsp&nbsp&nbsp
      <a class="btncorrespondence" href="../4_Pleadings/pleadings_create_2b.php">&nbsp&nbsp&nbsp&nbspHigh Court&nbsp&nbsp&nbsp&nbsp</a>
    </div>
    <div class="image-container">
      <img src="../11_Images/hex.png" class="hexagons" alt="Outline of three hexagons">
      <img src="../11_Images/hex2.png" class="hexagons2" alt="Outline of two hexagons">
    </div>
</body>

</html>
<style>
  .image-container {
    width: 363px;
    height: 412px;

    position: relative;
  }


  .spinning-image {
    transition: transform 3s linear;
  }

  .image-container:hover .spinning-image {
    transform: rotate(180deg);
  }

  .image-container:hover .spinning-image {
    transform: rotate(-180deg);
  }
</style>