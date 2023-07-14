<?php
// Start the session
session_start();
// Connect to the database
include "../16_insurance/db_connection.php";

// Check if the user is logged in
if (!isset($_SESSION['token']) || !$_SESSION['token']) {
    header('Location: login.html');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Reset Password</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../16_insurance/script.js"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron">
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Aclonica' type='text/css'>

    <style>
        .capsLockWarning {
            display: none;
            position: relative;
            margin-top: 5%;
            font-weight: bold;
            color: red;
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
            width: auto;

            position: relative;

        }

        #reset_form label {
            display: inline-block;
            width: 80px;
        }

        #reset_form input {
            width: 60%;
            padding: 6px;
            padding-left: 15px;
            background-color: white;
            border: 2px solid navy;
            border-radius: 7px;
            height: 35px;
            font-size: 17px;
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


        #togglePassword1 {
            font-size: 19px;
            position: relative;
            color: #151A7B;
            margin-top: 15%;
            margin-right: 9%;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }


        #reset_form button {
            display: inline-block;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            text-decoration: none;
            border-radius: 7px;
            width: 65%;
            height: 50px;
            font-size: 20px;
            cursor: pointer;
        }

        #reset_form button:hover {
            background-color: #0062cc;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        #container {
            width: 520px;
            margin: auto;
            padding: 30px;
            text-align: center;
            margin-top: 3%;
        }

        h1 {
            font-size: 28px;

            text-align: center;
            font-family: Orbitron;
            font-weight: bolder;
            font-size: 28px;

            text-align: center;
            font-family: Orbitron;
            font-weight: bolder;
            font-size: 36px;
            font-weight: bold;
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
</head>

<body>
    <div id="container">
        <div class="logo">AI</div>
        <div id="login-container">
            <h1>Change Password</h1>
            <form id="reset_form" method="post" action="../16_insurance/reset_password_2.php">
                <div id="password-container" style="position: relative;"></div>
                <input type="password" name="new_password" id="new_password" required placeholder="New Password" onkeydown="checkCapsLock(event)"><br><br>
                <i class=" fas fa-eye" id="togglePassword1" style="position: absolute; right: 5px; top: 5px;"></i>

                <input type="password" name="confirm_new_password" id="confirm_new_password" required placeholder="Confirm Password" onkeydown="checkCapsLock(event)"><br><br>
                <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">

                <button type="submit">Change Password</button>
                <div id="capsLockWarning" class="capsLockWarning">*Caps Lock is on*</div>

            </form>
        </div>
    </div>
</body>

</html>