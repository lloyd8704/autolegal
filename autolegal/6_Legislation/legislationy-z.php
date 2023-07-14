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
  <title>Legislation Y - Z</title>

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
  <ul>
    <li><a class="nav-linklegislation" href="">&nbspY&nbsp</a></li><br>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Desktop\PROJECT\LEGISLATION\MAGISTRATES COURT RULES.pdf">○ Magistrates Courts Rules&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a></li>
    <li><a class="nav-linklegislation1" href="Z:\Shared Data - USERS\Lloyd\LEGISLATION\MC ACT\MAGISTRATES' COURT ACT 32 OF 1944.pdf">○ Magistrates Courts Act 32 of 1944&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a></li>
    <li><a class="nav-linklegislation1" href="Z:\Shared Data - USERS\Lloyd\LEGISLATION\MEDICAL SCHEMES\MEDICAL SCHEMES ACT NO. 131 OF 1998.pdf">○ Medical Schemes Act 131 of 1998</a></li>
    <li><a class="nav-linklegislation1" href="Z:\Shared Data - USERS\Lloyd\LEGISLATION\MEDICAL SCHEMES AMENDMENT ACT 55 OF 2001.pdf">○ Medical Schemes Amendment Act 55 of 2001</a></li>
    <li><a class="nav-linklegislation1" href="Z:\Shared Data - USERS\Lloyd\LEGISLATION\MEDICAL SCHEMES AMENDMENT ACT 62 OF 2002.pdf">○ Medical Schemes Amendment Act 62 of 2002</a></li>
    <li><a class="nav-linklegislation1" href="Z:\Shared Data - USERS\Lloyd\LEGISLATION\MEDICAL SCHEMES\MEDICAL SCHEMES - REGULATIONS.pdf">○ Medical Schemes Act - Regulations</a></li>
    <li><a class="nav-linklegislation1 " href="Z:\Shared Data - USERS\Lloyd\LEGISLATION\MENTAL HEALTH CARE ACT 17 OF 2002.pdf">○ Mental Health Care Act 17 of 2002</a></li>
    <li><a class="nav-linklegislation1" href="Z:\Shared Data - USERS\Lloyd\LEGISLATION\MENTAL HEALTH CARE AMENDMENT ACT 12 OF 2014.pdf">○ Mental Health Care Amendment Act 12 of 2014</a></li>
    <li><a class="nav-linklegislation" href="">&nbspZ&nbsp</a></li><br>
    <li><a class="nav-linklegislation1" href="Z:\Shared Data - USERS\Lloyd\LEGISLATION\NATIONAL ENVIRONMENTAL MANAGEMENT ACT 107 OF 1998.pdf">○ National Environmental Management Act 107 of 1998</a></li>
    <li><a class="nav-linklegislation1" href="Z:\Shared Data - USERS\Lloyd\LEGISLATION\NATIONAL ENVIRONMENTAL MANAGEMENT WASTE ACT 59 OF 2008.pdf">○ National Environmental Management Waste Act 59 of 2008</a></li>
    <li><a class="nav-linklegislation1" href="Z:\Shared Data - USERS\Lloyd\LEGISLATION\NATIONAL HEALTH ACT 61 OF 2003.pdf">○ National Health Act 61 of 2003</a></li>
    <br><br><br><br><br><br><br><br>
  </ul>
  <img src="../11_Images/hex.png" class="spinning-image" alt="Outline of three hexagons">
  <style>
    .hexagonslegislation {
      display: block;
      width: 300px;
      margin-top: -489px;
      margin-left: 1000px;

    }

    .hexagonslegislation:hover {
      width: 300px;
      animation: rotation 6s infinite linear;


    }



    @keyframes rotation {
      from {
        transform: rotate(0deg);
      }

      to {
        transform: rotate(360deg);
      }
    }

    ul a.nav-linklegislation1 {
      list-style-type: none;
      margin-right: 0px;
      margin-left: 0px;
      margin-bottom: 0px;
      margin-top: 0px;
      padding: 0;
      width: 580px;
      background-color: black;
    }


    li a.nav-linklegislation1 {
      display: block;
      color: white;
      padding: 3px 28px;
      text-decoration: none;
      font-weight: bold;
      font-size: 20px;
      position: absolute;

    }


    /* Change the link color on hover */
    li a.nav-linklegislation1:hover {
      background-color: white;
      color: black;

    }

    ul li {
      padding: 5px 0px;

    }
  </style>

  </div>