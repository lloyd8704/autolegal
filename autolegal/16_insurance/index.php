<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
  // Session does not exist or has expired, redirect to login page
  header("Location: login.html");
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Home</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="../16_insurance/style.css">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-A8XQHx7vzKgUyV7EMiO6M+jV6w10b6jFDM6UZjxvbez9iDwhNNlJy+BtysVcGj8+t1WZ91AeZqlgSY4zv4B9jA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="../16_insurance/script.js"></script>
</head>

<body>
  <nav>
    <ul>
      <li><a class="active" href="../16_insurance/index.php">Home</a></li>
      <li><a href="view_claim_select.php">View</a></li>
      <li><a href="update_select.php">Update</a></li>
      <li><a href="send_email_select.php">Send</a></li>
      <li><a href="choice_of_letters.php">Draft</a></li>
      <li><a class="user" href="../16_insurance/logout_1.php">Welcome <?php echo ucfirst(strtolower($_SESSION['username'])); ?></a></li>
      <li>
        <a class="sign_out" href="../16_insurance/logout_2.php">
          <i class="fas fa-sign-out-alt" alt="Sign Out"></i>
        </a>
        <div class="tooltip">
          <p>Sign Out</p>
        </div>
      </li>
    </ul>
  </nav>
  <div class="container">
    <div class="logo">SI</div>
    <h1>Smart Insure</h1>
    <form>
      <div class="button-container">
        <a href="../16_insurance/view_claim_select.php" class="button">View Claim</a>
        <a href="../16_insurance/update_select.php" class="button">Update Claim</a>
        <a href="../16_insurance/send_email_select.php" class="button">Send Email</a>
        <a href="../16_insurance/choice_of_letters.php" class="button">Draft Document</a>
        <a href="../16_insurance/event_update_1.php" class="button">Notes</a>
      </div>
      <br>
      <div class="button-container">
        <a href="../16_insurance/claim_select.html" class="button">Claim Form</a>
        <a href="../16_insurance/test_unison.html" class="button">Submit Claim</a>
        <a href="../16_insurance/search_select.php" class="button">Search</a>
        <a href="../16_insurance/chart_select.php" class="button">Charts</a>
        <a href="../16_insurance/event_update_3.php" class="button">Log</a>
      </div>
      <br>
      <div class="button-container">
      </div>
  </div>
  </form>
</body>
<style>
  body {
    background-image: url("../11_Images/LOG_IN.jpg");
    background-repeat: no-repeat;
    background-size: cover;
  }

  form {
    padding-top: 45px;
    padding-bottom: 20px;
    padding-left: 40px;
    padding-right: 40px;
  }

  h1 {

    margin-bottom: 20px;
    text-align: center;
    font-family: Orbitron;
    font-weight: bolder;
    font-size: 40px;
    margin-bottom: 20px;
    text-align: center;
    font-family: Orbitron;
    font-weight: bolder;
    font-weight: bold;
    color: #151A7B;
  }
</style>

</html>