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
  <title>Legislation G - I</title>

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
          <li><a class="nav-linklegislation" href="">&nbspG&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Geoscience Act 100 of 1993.pdf">○ Geoscience Act 100 of 1993</a></li><br>
          <li><a class="nav-linklegislation" href="">&nbspH&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Hazardous Substances Act 15 of 1973.pdf">○ Hazardous Substances Act 15 of 1973</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Health Professions Act 56 of 1974.pdf">○ Health Professions Act 56 of 1974</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Regulations Relating to the Conduct of Inquiries into Alleged Unprofessional Conduct.pdf">○ Health: Regulations Relating to the Conduct of Inquiries ...</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Superior Courts Act 10 of 2013.pdf">○ High Court Act</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\HC RULES\UNIFORM RULES OF COURT.pdf">○ High Court Rules</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Home Loan and Mortgages Disclosure Act 63 of 2000.pdf">○ Home Loan and Mortgages Disclosure Act 63 of 2000</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Housing Consumers Protection Measures Act 95 of 1998.pdf">○ Housing Consumers Protection Measures Act 95 of 1998</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Housing Development Schemes for Retired Persons Act 65 of 1988.pdf">○ Housing Development Schemes for Retired Persons Act 65 of 1988</a></li><br>
          <li><a class="nav-linklegislation" href="">&nbspI&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Immigration Act 13 of 2002.pdf">○ Immigration Act 13 of 2002</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Insolvency Act 24 of 1936.pdf">○ Insolvency Act 24 of 1936</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Inspection of Financial Institutions Act 80 of 1998.pdf">○ Inspection of Financial Institutions Act 80 of 1998</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Interim Protection of Informal Land Rights Act 31 of 1996.pdf">○ Interim Protection of Informal Land Rights Act 31 of 1996</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Intestate Succession Act 81 of 1987.pdf">○ Intestate Succession Act 81 of 1987</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Intimidation Act 72 of 1982.pdf">○ Intimidation Act 72 of 1982</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Long Term Insurance Act 52 of 1998.pdf">○ Insurance - Long Term Insurance Act 52 of 1998</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Short Term Insurance Act 53 of 1998.pdf">○ Insurance - Short Term Insurance Act 53 of 1998</a></li>
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