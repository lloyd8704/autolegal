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
  <title>Legislation P - R</title>

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
          <li><a class="nav-linklegislation" href="#">&nbspP&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Patents Act 57 of 1978.pdf" target="_self">○ Patents Act 57 of 1978</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Pension Funds Act 24 of 1956.pdf">○ Pension Funds Act 24 of 1956</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Petroleum Pipelines Act 60 of 2003.pdf">○ Petroleum Pipelines Act 60 of 2003</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Petroleum Products Act 120 of 1977.pdf">○ Petroleum Products Act 120 of 1977</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Pharmacy Act 53 of 1974.pdf">○ Pharmacy Act 53 of 1974</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Prescribed Rate of Interest Act 55 of 1975.pdf">○ Prescribed Rate of Interest Act 55 of 1975</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Prescription Act 68 of 1969.pdf">○ Prescription Act 68 of 1969</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Private Security Industry Regulation Act 56 of 2001.pdf">○ Private Security Industry Regulation Act 56 of 2001</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Promotion of Access to Information Act 2 of 2000.pdf">○ Promotion of Access to Information Act 2 of 2000</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Promotion of Administrative Justice Act 3 of 2000.pdf">○ Promotion of Administrative Justice Act 3 of 2000</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Promotion of Equality and Prevention of Unfair Discrimination Act 4 of 2000.pdf">○ Promotion of Equality and Prevention of Unfair Discrimination Act 4 of 2000</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Property Valuers Profession Act 47 of 2000.pdf">○ Property Valuers Profession Act 47 of 2000</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Public Finance Management Act 1 of 1999.pdf">○ Public Finance Management Act 1 of 1999</a></li>
          <li><a class="nav-linklegislation" href="#">&nbspR&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Reciprocal Service of Civil Process Act 12 of 1990.pdf">○ Reciprocal Service of Civil Process Act 12 of 1990</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Recognition of Customary Marriages Act 120 of 1998.pdf">○ Recognition of Customary Marriages Act 120 of 1998</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Refugees Act 130 of 1998.pdf">○ Refugees Act 130 of 1998</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Registration of Copyright in Cinematograph Films Act 62 of 1977.pdf">○ Registration of Copyright in Cinematograph Films Act 62 of 1977</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Regulation of Gatherings Act 205 of 1993.pdf">○ Regulation of Gatherings Act 205 of 1993</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Regulation of Interception of Communications and Provision of Communication-related Information Act 70 of 2002.pdf">○ Regulation of Interception of Communications and Provision of Communication-related Information Act 70 of 2002</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Rental Housing Act 50 of 1999.pdf">○ Rental Housing Act 50 of 1999</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\National Road Traffic Act 93 of 1996.pdf">○ Road Traffic Act 93 of 1996</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Road Traffic Act Regulations.pdf">○ Road Traffic Regulations</a></li>
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
    margin-bottom: 380px;
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
    width: 106%;
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