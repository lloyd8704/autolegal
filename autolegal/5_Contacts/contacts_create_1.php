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
  <title>Contacts</title>
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
      </style>
      </head>

      <body>
        <div class="container">
          <form action="../5_Contacts/contacts_create_2.php" method="post">
            <br><br>
            <div class="row">
              <div class="col-25">
                <label for="ref">*Reference number:</label>
              </div>
              <div class="col-75">
                <input type="text" class="input1" id="ref" name="ref" style="text-transform:capitalize" value="" autofocus="on" required autocomplete="off">
              </div>
            </div>

            <div class="row">
              <div class="col-25">
                <label for="name">*Contact's name:</label>
              </div>
              <div class="col-75">
                <input type="text" class="input1" id="name" name="name" style="text-transform:capitalize" value="" required autocomplete="off">
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="phonenumber">&nbspPhone number:</label>
              </div>
              <div class="col-75">
                <input type="text" class="input1" id="phone" name="phone" value="" autocomplete="off">
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="email">&nbspEmail address:</label>
              </div>
              <div class="col-75">
                <input type="text" class="input1" id="email" name="email" value="" autocomplete="off">
              </div>
            </div>
            <div class="row">
              <div class="col-25">
                <label for="theirref">&nbspTheir reference:</label>
              </div>
              <div class="col-75">
                <input type="text" class="input1" id="theirref" name="theirref" value="" autocomplete="off">
              </div>
            </div>


            <div class="row">
              <input type="submit" class="inputcontacts" value="Submit&nbsp&nbsp❯" name="register" tabindex="3" />

            </div>
          </form>
        </div>
        <div>
          <a class="btncontactscreate" tabindex="1" href="../5_Contacts/Index.php">❮&nbsp&nbsp&nbspBack</a>
        </div>
  </div>
</body>

</html>