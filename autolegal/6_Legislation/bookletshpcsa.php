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
  </head>
  <ul>
    <li><a class="nav-linklegislation" href="">HPCSA Booklets</a></li><br>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 1 - General Ethical Guidelines for Health Care Professions.pdf">○ Booklet 1 - General Ethical Guidelines for Health Care Professions</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 2 - Ethical and professional rules of the Health Professions of South Africa.pdf">○ Booklet 2 - Ethical and Professional Rules of the Health Professions of South Africa</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 3 - National Patients' Rights Charter.pdf">○ Booklet 3 - National Patients' Rights Charter</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 4 - Seeking patients'informed consent - The ethical considerations.pdf">○ Booklet 4 - Seeking Patients' Informed Consent - The Ethical Considerations</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 5 - Confidentiality - Protecting and providing information.pdf">○ Booklet 5 - Confidentiality - Protecting and Providing Information</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 6 - Ethical Guidelines for Management of Patients with HIV.pdf">○ Booklet 6 - Guidelines for the Management of Patients with HIV Infections or AIDS</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 7 - Guidelines Withholding and Withdrawing Treatment.pdf">○ Booklet 7 - Guidelines for Withholding and Withdrawing Treatment</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 8 - Guidelines on Reproductive Health Management.pdf">○ Booklet 8 - Guidelines on Reproductive Health Management</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 9 - Guidelines on Patient Records.pdf">○ Booklet 9 - Guidelines on Patient Records</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 10 - Guidelines for the Practice of Telemedicine.pdf">○ Booklet 10 - Guidelines for the Practice of Telemedicine</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 11 - Guidelines on Over Servicing, Perverse Incentives and Related Matters.pdf">○ Booklet 11 - Guidelines on Over Servicing, Perverse Incentives and Related Matters</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 12 - Guidelines for the Management of Health Care Waste.pdf">○ Booklet 12 - Guidelines for the Management of Health Care Waste</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 13 - General Ethical Guidelines for Health Researchers.pdf">○ Booklet 13 - General Ethical Guidelines for Health Researchers</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 14 - Ethical Guidelines for Biotechnology Research in South Africa.pdf">○ Booklet 14 - Ethical Guidelines for Biotechnology Research in South Africa</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 15 - Research, Development and the Use of the Chemical, Biological and Nuclear Weapons.pdf">○ Booklet 15 - Research, Development and the Use of the Chemical, Biological and Nuclear Weapons</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 16 - Ethical Guidelines on Social Media.pdf">○ Booklet 16 - Ethical Guidelines on Social Media</a></li>
    <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HPCSA\GUIDELINES (BOOKLETS)\Booklet 17 - Ethical Guidelines on Palliative Care.pdf">○ Booklet 17 - Ethical Guidelines on Palliative Care</a></li>
  </ul><br>
  <img src="../11_Images/hex.png" class="hexagonslegislation" alt="Outline of two hexagons">
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

  <!--<a href="C:\Users\Lloyd\Desktop\PROJECT\LEGISLATION\UNIFORM RULES OF COURT.pdf" class="btnnewfiles">HC Rules</a>
        <a href="C:\Users\Lloyd\Desktop\PROJECT\LEGISLATION\MAGISTRATES COURT RULES.pdf"