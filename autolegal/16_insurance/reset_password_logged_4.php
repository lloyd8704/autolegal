<?php
// Start the session
session_start();
// Connect to the database
include "../16_insurance/db_connection.php";

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
    <title>Forgot Password</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Aclonica' type='text/css' />
</head>

<body>
    <div id="container">
        <div class="logo">AI</div>
        <h1>AUTOMATED INSURANCE</h1>
        <h2><?php echo $_SESSION["message"]; ?></h2>
        <a href="../16_insurance/logout_1.php" method="post" id="login-form">
            <br>
            <button type="submit">Back</button>
    </div>
    </div>
    </div>
</body>
<style>
    .capsLockWarning {
        display: none;
        position: relative;
        margin-top: -38%;
        margin-left: -147%;
        font-weight: bold;
    }

    /* Set the minimum height of the section to 50% of the viewport height */
    section {
        min-height: 50vh;
    }

    /* On small screens, set the section height to 100% of the viewport height */
    @media (max-width: 767px) {
        section {
            min-height: 100vh;
        }
    }

    a.forgotpassword {
        position: relative;
        color: #151A7B;
        margin-top: 3%;
        margin-left: 57%;
        text-decoration: none;
        display: inline-block;

    }

    #login-container {
        /* border: 3px solid #ccc; */
        border-radius: 4px;
        margin: 0 auto;
        width: 325px;
        padding: 20px;
        position: relative;
        padding-right: 38px;
        padding-top: 10px;
    }

    #login-form label {
        display: inline-block;
        width: 80px;
    }


    #message {
        color: #ff3300;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        position: absolute;
        left: 49%;
        transform: translate(-50%, 50%);
        width: 98%;
        top: 38%;
    }


    #togglePassword {
        font-size: 19px;
        position: relative;
        color: #151A7B;
        margin-top: 3%;
        margin-right: 4%;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
    }


    #login-form button {
        display: inline-block;
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        text-decoration: none;
        border-radius: 7px;
        width: 60%;
        height: 45px;
        font-size: 20px;
        cursor: pointer;
    }

    #login-form button:hover {
        background-color: #0062cc;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }

    #container {
        width: 520px;
        margin: auto;
        /*background-color: #fff;
border-radius: 5px;
box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);*/
        padding: 30px;
        text-align: center;
        margin-top: 3%;
    }

    h1 {
        font-size: 28px;
        margin-bottom: 20px;
        text-align: center;
        font-family: Orbitron;
        font-weight: bolder;
        font-size: 28px;
        margin-bottom: 20px;
        text-align: center;
        font-family: Orbitron;
        font-weight: bolder;
        font-size: 36px;
        font-weight: bold;
        color: #151A7B;
    }

    h2 {
        color: #151A7B;
    }

    p {
        font-size: 18px;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    .a {
        display: block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
    }

    .a:hover {
        background-color: #0062cc;
    }

    .copy-btn {
        display: inline-block;
        margin-left: 10px;
        padding: 5px 10px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .copy-btn:hover {
        background-color: #0062cc;
    }

    .copy-btn:after {
        content: '\2714';
        display: none;
    }

    .copied {
        background-color: #2ecc71;
    }

    .copied:after {
        display: inline-block;
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
</body>

</html>