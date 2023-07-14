<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
  // Session does not exist or has expired, redirect to login page
  header("Location: login_auto.html");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="../9_Style/style.css">
  <link rel="icon" type="image/x-icon" href="../12_Icons/favicon.ico">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
  <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Aclonica' type='text/css' />
  <style>
    body {
      background-color: black;
    }

    .container {
      text-align: center;
    }

    .heading_index {
      position: relative;
      color: white;
      text-transform: uppercase;
      letter-spacing: 5px;
      font-family: Orbitron;
      text-align: center;
      margin-top: 20%;
      font-size: 50px;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <nav>
    <div class="heading1">
      <h4>AutoLegal</h4>
    </div>
    <ul class="nav-linker">
      <li><a class="nav-link active" href="../1_Home/Index.php">Home</a></li>
      <li><a class="nav-link" href="../2_New_file/Index.php">New&nbspFile</a></li>
      <li><a class="nav-link" href="../3_Correspondence/Index.php">Correspondence</a></li>
      <li><a class="nav-link" href="../4_Pleadings/Index.php">Pleadings</a></li>
      <li><a class="nav-link" href="../5_Contacts/Index.php">Contacts</a></li>
      <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
      <li><a class="nav-link" href="../7_Edit/Index.php">Edit</a></li>
      <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
    </ul>
  </nav>
  <div class="container">

    <div class="heading_index">
      <img src="../11_Images/AUTO_LEGAL_LOGO.jpg" alt="Image" class="image">
    </div>
  </div>
  </div>
</body>

</html>