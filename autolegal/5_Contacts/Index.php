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
  <title>Contacts</title>
  <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
</head>

<body>
  <div id="test">

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
          <li><a class="nav-link active" href="../5_Contacts/Index.php">Contacts</a></li>
          <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
          <li><a class="nav-link" href="../7_Edit/Index.php">Edit</a></li>
          <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
        </ul>
      </nav>
      <br>
      <div class="body-text1">
        <h1><br>What would you like to do?</h1>
      </div>
      <img src="../11_Images/contactsicon.png" class="center" alt="Letter and email"><br>
      <div class="buttons-container">
        <a href="../5_Contacts/contacts_create_1.php">Create a Contact</a>
        <a href="../5_Contacts/contacts_view_1.php">&nbspView a Contact&nbsp</a>
      </div>
  </div>
</body>

</html>