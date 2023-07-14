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
    <title>Reset Password</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Aclonica' type='text/css' />
    <link rel="stylesheet" href="../16_insurance/style.css">
</head>

<body>
    <ul>
        <li><a href="../16_insurance/index.php">Home</a></li>
        <li><a href="view_claim_select.php">View</a></li>
        <li><a href="update_select.php">Update</a></li>
        <li><a href="send_email_select.php">Send</a></li>
        <li><a href="choice_of_letters.php">Draft</a></li>
        <li><a class="active" href="#">User</a></li>
        <li><a class="user" href="#">Welcome <?php echo ucfirst(strtolower($_SESSION['username'])); ?></a></li>
    </ul>
    <div id="container">
        <div class="logo">AI</div>
        <div id="login-container">
            <h1>Change Password</h1>
            <form id="login-form" method="post" action="../16_insurance/reset_password_logged_2.php">
                <div id="password-container" style="position: relative;">
                    <input type="password" name="new_password" id="new_password" required placeholder="New Password"><br><br>
                    <i class="fas fa-eye" id="togglePassword1" style="position: absolute; right: 5px; top: 5px;"></i>

                    <div id="password-container" style="position: relative;">
                        <input type="password" name="confirm_new_password" id="confirm_new_password" required placeholder="Confirm Password"><br><br>

                    </div>
                    <button type="submit">Change Password</button>
            </form>
            <style>
                form {
                    background-color: #f0f0f0;
                    border: none;
                }

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
                    width: auto;

                    position: relative;

                }

                #login-form label {
                    display: inline-block;
                    width: 80px;
                }

                #login-form input {
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
                    margin-top: 2%;
                    margin-right: 9%;
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
                    width: 65%;
                    height: 50px;
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
                    padding: 30px;
                    text-align: center;
                    margin-top: 2%;
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

            <script>
                $(document).ready(function() {
                    $("#togglePassword1").click(function() {
                        $(this).toggleClass("fa-eye fa-eye-slash");
                        var current_password = $("#current_password");
                        if (current_password.attr("type") === "password") {
                            current_password.attr("type", "text");
                        } else {
                            current_password.attr("type", "password");
                        }
                        var new_password = $("#new_password");
                        if (new_password.attr("type") === "password") {
                            new_password.attr("type", "text");
                        } else {
                            new_password.attr("type", "password");
                        }
                        var confirm_new_password = $("#confirm_new_password");
                        if (confirm_new_password.attr("type") === "password") {
                            confirm_new_password.attr("type", "text");
                        } else {
                            confirm_new_password.attr("type", "password");
                        }
                    });
                });
            </script>
</body>

</html>