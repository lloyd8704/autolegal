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
  <title>Legislation M - N</title>

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
        <br>
        <ul>
          <li><a class="nav-linklegislation" href="">&nbspM&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\MC RULES\MAGISTRATES COURT RULES.pdf">○ Magistrates Courts Rules&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\MC ACT\MAGISTRATES' COURT ACT 32 OF 1944.pdf">○ Magistrates Courts Act 32 of 1944</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Matrimonial Property Act 88 of 1984.pdf">○ Matrimonial Property Act 88 of 1984</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\MEDICAL SCHEMES\MEDICAL SCHEMES ACT NO. 131 OF 1998.pdf">○ Medical Schemes Act 131 of 1998</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\MEDICAL SCHEMES AMENDMENT ACT 55 OF 2001.pdf">○ Medical Schemes Amendment Act 55 of 2001</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\MEDICAL SCHEMES AMENDMENT ACT 62 OF 2002.pdf">○ Medical Schemes Amendment Act 62 of 2002</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\MEDICAL SCHEMES\MEDICAL SCHEMES - REGULATIONS.pdf">○ Medical Schemes Act - Regulations</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Medicines and Related Substances Act 101 of 1965.pdf">○ Medicines and Related Substances Act 101 of 1965</a></li>
          <li><a class="nav-linklegislation1 " href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\MENTAL HEALTH CARE ACT 17 OF 2002.pdf">○ Mental Health Care Act 17 of 2002</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\MENTAL HEALTH CARE AMENDMENT ACT 12 OF 2014.pdf">○ Mental Health Care Amendment Act 12 of 2014</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Merchant Shipping (Civil Liability Convention) Act 25 of 2013.pdf">○ Merchant Shipping (Civil Liability Convention) Act 25 of 2013</a></li>
          <li><a class="nav-linklegislation" href="">&nbspN&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\National Building Regulations and Building Standards Act 103 of 1977.pdf">○ National Building Regulations and Building Standards Act 103 of 1977</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\NATIONAL ENVIRONMENTAL MANAGEMENT ACT 107 OF 1998.pdf">○ National Environmental Management Act 107 of 1998</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\National Environmental Management Biodiversity Act 10 of 2004.pdf">○ National Environmental Management Biodiversity Act 10 of 2004</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\National Environmental Management - Integrated Coastal Management Act 24 of 2008.pdf">○ National Environmental Management - Integrated Coastal Management Act 24 of 2008</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\National Environmental Management - Protected Areas Act 57 of 2003.pdf">○ National Environmental Management - Protected Areas Act 57 of 2003</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\NATIONAL ENVIRONMENTAL MANAGEMENT WASTE ACT 59 OF 2008.pdf">○ National Environmental Management Waste Act 59 of 2008</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\National Forests Act 84 of 1998.pdf">○ National Forests Act 84 of 1998</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\NATIONAL HEALTH ACT 61 OF 2003.pdf">○ National Health Act 61 of 2003</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\National Road Traffic Act 93 of 1996.pdf">○ National Road Traffic Act 93 of 1996</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\National Water Act 36 of 1998.pdf">○ National Water Act 36 of 1998</a></li>
          <li><a class="nav-linklegislation" href="">&nbspO&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\BUILDING\OCCUPATIONAL HEALTH & SAFETY ACT 85 OF 1993.pdf">○ Occupational Health and Safety Act 85 of 1993</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\OLDER PERSONS ACT 13 OF 2006.pdf">○ Older Persons Act 13 of 2006</a></li><br>
        </ul>
        <br>
      </ul>
    </div>
  </div>
</body>
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
    margin-bottom: 490px;
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
    width: 120%;
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