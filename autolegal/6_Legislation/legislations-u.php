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
  <title>Legislation S - U</title>

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
          <li><a class="nav-linklegislation" href="">&nbspS&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Second-Hand Goods Act 6 of 2009.pdf">○ Second-Hand Goods Act 6 of 2009</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Sectional Titles Act 95 of 1986.pdf">○ Sectional Titles Act 95 of 1986</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Securities Transfer Tax Act 25 of 2007.pdf">○ Securities Transfer Tax Act 25 of 2007</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Security by Means of Movable Property Act 57 of 1993.pdf">○ Security by Means of Movable Property Act 57 of 1993</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Short-term Insurance Act 53 of 1998.pdf">○ Short-term Insurance Act 53 of 1998</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Small Claims Courts Act 61 of 1984.pdf">○ Small Claims Courts Act 61 of 1984s</a></li>
          <li><a class="nav-linklegislation1 " href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Social Assistance Act 13 of 2004.pdf">○ Social Assistance Act 13 of 2004</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\South African Citizenship Act 88 of 1995.pdf">○ South African Citizenship Act 88 of 1995</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\South African Judicial Education Institute Act 14 of 2008.pdf">○ South African Judicial Education Institute Act 14 of 2008</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\South African National Space Agency Act 36 of 2008.pdf">○ South African National Space Agency Act 36 of 2008</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\South African Reserve Bank Act 90 of 1989.pdf">○ South African Reserve Bank Act 90 of 1989</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\South African Schools Act 84 of 1996.pdf">○ South African Schools Act 84 of 1996</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\South African Social Security Agency Act 9 of 2004.pdf">○ South African Social Security Agency Act 9 of 2004</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Spatial Data Infrastructure Act 54 of 2003.pdf">○ Spatial Data Infrastructure Act 54 of 2003</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\State Land Disposal Act 66 of 1961.pdf">○ State Land Disposal Act 66 of 1961</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\State Liability Act 20 of 1957.pdf">○ State Liability Act 20 of 1957</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Superior Courts Act 10 of 2013.pdf">○ Superior Courts Act 10 of 2013</a></li>
          <li><a class="nav-linklegislation" href="">&nbspT&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Tax Administration Act 28 of 2011.pdf">○ Tax Administration Act 28 of 2011</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\The Reform of Customary Law of Succession and Regulation of Related Matters Act 11 of 2009.pdf">○ The Reform of Customary Law of Succession and Regulation of Related Matters Act 11 of 2009</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Tobacco Products Control Act 83 of 1993.pdf">○ Tobacco Products Control Act 83 of 1993</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Trade Marks Act 194 of 1993.pdf">○ Trade Marks Act 194 of 1993</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Traditional Leadership and Governance Framework Act 41 of 2003.pdf">○ Traditional Leadership and Governance Framework Act 41 of 2003</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Transfer Duty Act 40 of 1949.pdf">○ Transfer Duty Act 40 of 1949</a></li>
          <li><a class="nav-linklegislation" href="">&nbspU&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HC RULES\UNIFORM RULES OF COURT.pdf">○ Uniform Rules of Court</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Unemployment Insurance Act 63 of 2001.pdf">○ Unemployment Insurance Act 63 of 2001</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Unemployment Insurance Contributions Act 4 of 2002.pdf">○ Unemployment Insurance Contributions Act 4 of 2002</a></li><br>
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
    flex: 1;
    display: flex;
    align-items: center;
    /* justify-content: center; */
    margin-bottom: 600px;
    margin-left: 250px;
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