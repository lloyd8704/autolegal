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
  <title>Send Email</title>
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
<ul>

  <body>
    <li><a href="../16_insurance/index.php">Home</a></li>
    <li><a href="view_claim_select.php">View</a></li>
    <li><a href="update_select.php">Update</a></li>
    <li><a class="active" href="send_email_select.php">Send</a></li>
    <li><a href="choice_of_letters.php">Draft</a></li>
    <li><a class="user" href="../16_insurance/logout_1.php">Welcome <?php echo ucfirst(strtolower($_SESSION['username'])); ?></a></li>
    <li>
      <a class="sign_out" href="../16_insurance/logout_2.php"><i class="fas fa-sign-out-alt"></i></a>
      <div class="tooltip">
        <p>Sign Out</p>
      </div>
    </li>
</ul>

<div class="container_reference">
  <div class="logo">AI</div>
  <h2>Send Email</h2><br>
  <form action="#" method="post" id="myForm">
    <div class="home-icon">
      <a href="../16_insurance/index.php">
        <i class="fas fa-home"></i>
      </a>
    </div>
    <label for="reference">Reference number:</label>
    <input type="text" id="reference" name="reference" required autocomplete="off" autofocus><br><br>
    <input type="submit" value="Next">
  </form>
  <div id="message"></div>
  <script>
    $(document).ready(function() {
      $("#myForm").submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize(); // Serialize the form data
        $.ajax({
          url: "../16_insurance/reference_check.php",
          type: "POST",
          data: formData,
          success: function(response) {
            if (response == "success") {
              // Redirect to the next php page
              window.location.href = "../16_insurance/send_email_2.php";
            } else {
              // Display an error message
              $("#message").html("  <span><br>* There is no claim with that reference number *</span>");
              // Hide the message after 2 seconds
              setTimeout(function() {
                $("#message").html("");
              }, 4000);
            }
          }
        });
      });
    });
  </script>
  <style>
    form {
      width: 500px;
      margin: auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: #f9f9f9;
      position: relative;

    }

    h1 {
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
      font-size: 20px;
      font-family: 'Open Sans', sans-serif;
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

    input[type="submit"]:hover {
      background-color: #0062cc;
    }
  </style>
  </body>

</html>