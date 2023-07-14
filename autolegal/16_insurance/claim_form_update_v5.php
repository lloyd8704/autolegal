<?php
session_start();
// Retrieve the reference number from the session
$reference = $_SESSION['reference'];
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron">
  <title>Update Successful!</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }

    #container {
      width: 600px;
      margin: 50px auto;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
      padding: 30px;
    }

    h1 {
      font-size: 28px;
      margin-bottom: 20px;
      color: #007bff;
      text-align: center;
    }

    p {
      font-size: 18px;
      margin-bottom: 20px;
      color: #333;
      text-align: center;
    }

    a {
      display: block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-align: center;
      text-decoration: none;
      border-radius: 5px;
    }

    a:hover {
      background-color: #0062cc;
    }

    .logo {
      background-color: #151A7B;
      box-shadow: 0 0 0 3px white, 0 0 0 6px #151A7B;
      border-radius: 20px;
      color: white;
      cursor: default;
      font-family: Orbitron;
      font-size: 87px;
      font-weight: bold;
      height: 102px;
      padding: 10px;
      padding-top: 5px;
      text-align: center;
      text-decoration: wavy;
      width: 111px;
    }

    .logo {
      display: block;
      margin: 0 auto;
    }
  </style>
</head>

<body>
  <div id="container">
    <div class="logo">AI</div>
    <h1>Claim <?php echo $reference; ?> has been updated!</h1>
    <p>The claim has been updated successfully.</p>
    <a href="../16_insurance/index.php">Back to Home</a>
  </div>
</body>

</html>