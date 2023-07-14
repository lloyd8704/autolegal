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
  <title>Legislation A - C</title>

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
    <div class="image-container">
      <img src="../11_Images/hex.png" class="spinning-image" alt="Outline of three hexagons">
    </div>
    <div class="list-container">
      <ul>
        <li><a class="nav-linklegislation" href="">&nbspA&nbsp</a></li><br>

        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\AHPCSA\ALLIED HEALTH PROFESSIONS ACT 63 OF 1982.pdf">○ Allied Health Professions Act 63 of 1982</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\AHPCSA\CODE OF ETHICS.pdf">○ Allied Health Professions Act - Code of Ethics</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\AHPCSA\OLD REGULATIONS IN TERMS OF THE ASSOCIATED HEALTH SERVICE PROFESSIONS ACT.pdf">○ Allied Health Professions Act - Regulations 1982</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\AHPCSA\REGULATIONS 2001.pdf">○ Allied Health Professions Act - Regulations 2001</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\AHPCSA\RULES SPECIFYING THE ACTS OR OMISSIONS IN RESPECT OF WHICH DISCIPLINARY ACTION MAY BE TAKEN BY THE BOARD.pdf">○ Allied Health Professions Act - Rules</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\APPORTIONMENT OF DAMAGES ACT.pdf">○ Apportionment of Damages Act 34 of 1956</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\ARBITRATION ACT 42 OF 1965.pdf">○ Arbitration Act 42 of 1965</a></li>
        <li><a class="nav-linklegislation" href="">&nbspB&nbsp</a></li><br>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\LABOUR LAW\BASIC CONDITIONS OF EMPLOYMENT ACT NO 75 OF 1997.pdf">○ Basic Conditions of Employment Act 75 of 1997</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Basic Conditions of Employment Amendment Act 11 of 2002.pdf">○ Basic Conditions of Employment Amendment Act 11 of 2002</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Basic Conditions of Employment Amendment Act 20 of 2013.pdf">○ Basic Conditions of Employment Amendment Act 20 of 2013</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Basic Conditions of Employment Amendment Act 7 of 2018.pdf">○ Basic Conditions of Employment Amendment Act 7 of 2018</a></li>
        <li><a class="nav-linklegislation1" href="../6_Legislation/bookletshpcsa.php">○ Booklets - HPCSA</a></li>
        <li><a class="nav-linklegislation" href="">&nbspC&nbsp</a></li><br>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\CHILDREN'S ACT.pdf">○ Children's Act 38 of 2005</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Choice of Termination of Pregnancy Act 92 of 1996.pdf">○ Choice of Termination of Pregnancy Act 92 of 1996</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Compensation for Occupational Injuries and Diseases Act 130 of 1993.pdf">○ Compensation for Occupational Injuries and Diseases Act 130 of 1993</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Constitution of the Republic of South Africa 108 of 1996.pdf">○ Constitution of the Republic of South Africa 108 of 1996</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\CONSUMER PROTECTION ACT.pdf">○ Consumer Protection Act 68 of 2008</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\CONTINGENCY FEES ACT 66 OF 1997.pdf">○ Contingency Fees Act 66 of 1997</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Copyright Act 98 of 1978.pdf">○ Copyright Act 98 of 1978</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Criminal Procedure Act 51 of 1977.pdf">○ Criminal Procedure Act 51 of 1977</a></li>
      </ul><br>

      <style>
        .container {
          display: flex;
          align-items: center;
          justify-content: center;
          overflow-x: hidden;
        }

        .image-container {
          order: 2;
          /* Change the order to display the hexagon on the right */
          flex: 1;
          display: flex;
          align-items: center;
          justify-content: center;
          margin-bottom: 330px;
          cursor: pointer;
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
        }
      </style>

</html>