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
  <title>Legislation V - X</title>

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
  </head>
  <div class="container">

    <div class="list-container">
      <ul>
        <li><a class="nav-linklegislation" href="">&nbspV&nbsp</a></li><br>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Voluntary Disclosure Programme and Taxation Laws Second Amendment Act 8 of 2010.pdf">○ Voluntary Disclosure Programme and Taxation Laws Second Amendment Act 8 of 2010</a></li>
        <li><a class="nav-linklegislation" href="">&nbspW&nbsp</a></li><br>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Water Services Act 108 of 1997.pdf">○ Water Services Act 108 of 1997</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Wills Act 7 of 1953.pdf">○ Wills Act 7 of 1953</a></li>
      </ul>
    </div>
  </div>
  <div class="image-container">
    <img src="../11_Images/hex.png" class="spinning-image" alt="Outline of three hexagons">
  </div>
  <style>
    .container {
      display: flex;
      align-items: center;
      justify-content: center;
      overflow-x: hidden;
      overflow-y: hidden;
      margin-top: 0px;

    }

    .image-container {
      order: 2;
      flex: 1;
      display: flex;
      align-items: center;

      margin-bottom: -142px;
      cursor: pointer;
      margin-top: -150px;
      margin-left: 920px;
    }

    .spinning-image {
      transition: transform 2s linear;

    }

    .image-container:hover .spinning-image {
      transform: rotate(90deg);
    }

    .list-container {
      order: 1;
      /* Change the order to display the list on the left */
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      /* Change justify-content to move the list to the left */

    }

    ul {
      margin: 0;
      padding: 0;
      list-style: none;
      width: 100%;
    }

    li a.nav-linklegislation1 {
      display: block;
      color: white;
      padding: 3px;
      background-color: black;
      text-decoration: none;
      font-weight: bold;
      font-size: 20px;
    }

    li a.nav-linklegislation1:hover {
      background-color: white;
      color: black;
      width: 800px;
    }
  </style>

</html>