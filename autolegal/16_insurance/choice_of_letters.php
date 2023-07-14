<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
  // Session does not exist or has expired, destroy session and redirect to login page
  session_destroy();
  header("Location: login.html");
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Update Claim</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="../16_insurance/style.css">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
  <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Aclonica' type='text/css' />
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-A8XQHx7vzKgUyV7EMiO6M+jV6w10b6jFDM6UZjxvbez9iDwhNNlJy+BtysVcGj8+t1WZ91AeZqlgSY4zv4B9jA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="../16_insurance/script.js"></script>
</head>

<body>
  <ul>
    <li><a href="../16_insurance/index.php">Home</a></li>
    <li><a href="view_claim_select.php">View</a></li>
    <li><a href="update_select.php">Update</a></li>
    <li><a href="send_email_select.php">Send</a></li>
    <li><a class="active" href="choice_of_letters.php">Draft</a></li>
    <li><a class="user" href="../16_insurance/logout_1.php">Welcome <?php echo ucfirst(strtolower($_SESSION['username'])); ?></a></li>
    <li>
      <a class="sign_out" href="../16_insurance/logout_2.php"><i class="fas fa-sign-out-alt"></i></a>
      <div class="tooltip">
        <p>Sign Out</p>
      </div>
    </li>
  </ul>

  <div class="container">
    <div class="logo">AI</div>
    <h2>Draft a Document</h2><br>
    <form>
      <div class="home_icon_reference">
        <a href="../16_insurance/index.php">
          <i class="fas fa-home"></i>
        </a>
      </div>
      <div class="button-container">
        <a href="../16_insurance/create_letter_of_demand_1.php" class="button">Letter of Demand</a>
        <a href="../16_insurance/create_aol_select.php" class="button">Agreement of Loss</a>
        <a href="../16_insurance/create_instruction_letter_select.php" class="button">Letter of Instruction</a>
      </div>
    </form>
</body>
<style>
  form {
    width: 650px;
    height: 110px;
    padding: 20px;
    border: 3px solid #ccc;
    border-radius: 10px;
    background-color: #f9f9f9;
    padding-top: 30px;
    padding-bottom: 30px;
  }

  .button-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin: 0 auto;
    border-radius: 2px;
    padding: 5px;
    flex-direction: row;

  }

  .button {
    width: 180px;
  }

  .button-container {
    display: flex;
    justify-content: center;
    align-items: center;

  }

  .home_icon_reference {
    position: relative;
    left: 98%;
    bottom: 10%;
  }
</style>
</body>

</html>