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
  <title>Legislation D - F</title>

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
        <li><a class="nav-linklegislation" href="">&nbspD&nbsp</a></li><br>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\DEBT COLLECTORS ACT.pdf">○ Debt Collectors Act 114 of 1998</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Deeds Registries Act 47 of 1937.pdf">○ Deeds Registries Act 47 of 1937</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Designs Act 195 of 1993.pdf">○ Designs Act 195 of 1993</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Disaster Management Act 57 of 2002.pdf">○ Disaster Management Act 57 of 2002</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Divorce Act 70 of 1979.pdf">○ Divorce Act 70 of 1979</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Divorce Amendment Act 95of 1996.pdf">○ Divorce Amendment Act 95 of 1996</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Domestic Violence Act 116 of 1998.pdf">○ Domestic Violence Act 116 of 1998</a></li>
        <li><a class="nav-linklegislation" href="">&nbspE&nbsp</a></li><br>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Electricity Regulation Act 4 of 2006.pdf">○ Electricity Regulation Act 4 of 2006</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Electronic Communications Act 36 of 2005.pdf">○ Electronic Communications Act 36 of 2005</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Electronic Communications and Transactions Act 25 of 2002.pdf">○ Electronic Communications and Transactions Act 25 of 2002</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Employment Equity Act 55 of 1998.pdf">○ Employment Equity Act 55 of 1998</a></li>
        <li><a class="nav-linklegislation1" href="../6_Legislation/environmental.php">○ Environmental Law</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Extension of Tenure Act 62 of 1997.pdf">○ Extension of Tenure Act 62 of 1997</a></li>
        <li><a class="nav-linklegislation" href="">&nbspF&nbsp</a></li><br>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Financial Advisory and Intermediary Services Act 37 of 2002.pdf">○ Financial Advisory and Intermediary Services Act 37 of 2002</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Financial Intelligence Centre Act 38 of 2001.pdf">○ Financial Intelligence Centre Act 38 of 2001</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Fire Brigade Services Act 99 of 1987.pdf">○ Fire Brigade Services Act 99 of 1987</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Firearms Control Act 60 of 2000.pdf">○ Firearms Control Act 60 of 2000</a></li>
        <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\BUILDING\OCCUPATIONAL HEALTH & SAFETY ACT 85 OF 1993.pdf">○ Fire Protection Legislation</a></li>
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
    margin-bottom: 166px;
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