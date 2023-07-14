<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
  // Session does not exist or has expired, destroy session and redirect to login page
  session_destroy();
  header("Location: login.html");
  exit;
}
$reference = $_SESSION['reference'];
$selected_options = $_POST['selected_options'];
$quantum = $_POST['quantum'];
$response_date = $_POST['response_date'];
$third_party_name = $_POST['third_party_name'];
$third_party_email = $_POST['third_party_email'];
?>

<!DOCTYPE html>
<html>

<head>
  <title>Create Letter</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
  <link rel="stylesheet" href="../16_insurance/style.css">

  <style>
    form {
      width: 500px;
      margin: auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: #f9f9f9;
      position: relative;
      top: -18px;
    }

    h1 {
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
      font-size: 20px;
    }

    input[type="text"],
    input[type="email"],
    textarea {
      width: 95%;
      padding: 10px;
      margin-bottom: -1px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    .logo {
      display: block;
      margin: 0 auto;
    }

    body {
      margin-top: 40px;
      padding: 0;
      background-color: #f1f1f1;
      overflow: hidden;
    }

    input[type="submit"]:hover {
      background-color: #0062cc;
    }

    .back-button {
      width: 100%;
      padding: 10px;
      background-color: #ccc;
      color: black;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
    }

    .back-button:hover {
      background-color: #ddd;
    }
  </style>

</head>

<body>
  <div>
    <!--    <img src="../11_Images/AI-LOGO.png" class="logo" alt="Letter and email"> -->
    <div class="logo">SI</div>
  </div>
  <h1>Create letter for: <?php echo $reference; ?></h1><br>
  <br>
  <form action="../16_insurance/create_letter_of_demand_4.php" method="post">
    <input type="hidden" id="reference" name="reference" value="<?php echo $reference; ?>">
    <input type="hidden" id="selected_options" name="selected_options" value="<?php echo $selected_options; ?>">
    <input type="hidden" id="quantum" name="quantum" value="<?php echo $quantum; ?>">
    <input type="hidden" id="date" name="response_date" value="<?php echo $response_date; ?>">
    <input type="hidden" id="third_party_name" name="third_party_name" value="<?php echo $third_party_name; ?>">
    <input type="hidden" id="third_party_email" name="third_party_email" value="<?php echo $third_party_email; ?>"><br>
    <input type="submit" value="Download">
    <button type="button" class="back-button" onclick="window.location.href='../16_insurance/choice_of_letters.php'">Back</button>
  </form>
</body>

</html>