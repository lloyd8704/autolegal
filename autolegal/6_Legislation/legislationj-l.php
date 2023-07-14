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
  <title>Legislation J - L</title>

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
          <li><a class="nav-linklegislation" href="">&nbspJ&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Judicial Service Commission Act 9 of 1994.pdf">○ Judicial Service Commission Act 9 of 1994</a></li>
          <li><a class="nav-linklegislation" href="">&nbspL&nbsp</a></li><br>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Labour Relations Act 66 of 1995.pdf">○ Labour Relations Act 66 of 1995</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\LEGAL PRACTICE ACT.pdf">○ Legal Practice Act 28 of 2014</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Land Administration Act 2 of 1995.pdf">○ Land Administration Act 2 of 1995</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Law of Evidence Amendment Act 45 of 1998.pdf">○ Law of Evidence Amendment Act 45 of 1998</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Land Administration Act 2 of 1995.pdf">○ Land Administration Act 2 of 1995</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Legal Deposit Act 54 of 1997.pdf">○ Legal Deposit Act 54 of 1997</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Liquor Act 59 of 2003.pdf">○ Liquor Act 59 of 2003</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Liquor Products Act 60 of 1989.pdf">○ Liquor Products Act 60 of 1989</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Local Government - Municipal Finance Management Act 56 of 2003.pdf">○ Local Government - Municipal Finance Management Act 56 of 2003</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Local Government - Municipal Property Rates Act 6 of 2004.pdf">○ Local Government - Municipal Property Rates Act 6 of 2004</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Local Government - Municipal Structures Act 117 of 1998.pdf">○ Local Government - Municipal Structures Act 117 of 1998</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Local Government - Municipal Systems Act 32 of 2000.pdf">○ Local Government - Municipal Systems Act 32 of 2000</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Lotteries Act 57 of 1997.pdf">○ Lotteries Act 57 of 1997</a></li>
          <li><a class="nav-linklegislation1" href="C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data\Lloyd\LEGISLATION\Long Term Insurance Act 52 of 1998.pdf">○ Long Term Insurance Act 52 of 1998</a></li>
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
    margin-bottom: 150px;
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