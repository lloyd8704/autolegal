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
  <ul>
    <li><a class="nav-linklegislation" href="">Environmental Law</a></li><br>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\GN 625 GG 35583 - NATIONAL WASTE INFORMATION REGULATIONS.pdf">○ GN 625 GG 35583 - National Waste Information Regulations</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\GN 921 GG 37083 LIST OF WASTE MANAGEMENT ACTIVITIES.pdf">○ GN 921 GG 37083 - List of Waste Management Activities</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\NATIONAL ENVIRONMENTAL MANAGEMENT ACT 107 OF 1998.pdf">○ National Environmental Management Act 107 of 1998</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\NATIONAL ENVIRONMENTAL MANAGEMENT WASTE ACT 59 OF 2008.pdf">○ National Environmental Management Waste Act 59 of 2008</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\ENVIRONMENTAL\NATIONAL WASTE INFORMATION REGULATIONS.pdf">○ National Waste Information Regulations</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\ENVIRONMENTAL\WASTE CLASSIFICATION AND MANAGEMENT REGULATIONS 2013.pdf">○ Waste Classification and Management Regulations</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\ENVIRONMENTAL\WASTE MANAGEMENT ACTIVITIES IRO WHICH A WASTE MANAGEMENT LICENSE IS REQUIRED.pdf">○ Waste Management Activities IRO which a Waste Management License is Required</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 12 - Guidelines for the Management of Health Care Waste.pdf">○ Guidelines for the Management of Health Care Waste - HPCSA Booklet 12</a></li>
  </ul><br>
  <img src="../11_Images/hex.png" class="hexagonslegislation" alt="Outline of two hexagons">
  <style>
    .hexagonslegislation {
      display: block;
      width: 300px;
      margin-top: -196px;
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
      width: 800px;
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
</body>

</html>