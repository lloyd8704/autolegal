<?php
require_once '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../../vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Connect to the database
include "../16_insurance/db_connection.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input email address
    $email = $_POST["email"];
    // Check if email exists in database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the user's name from the database
        $user = mysqli_fetch_assoc($result);
        $username = $user['username'];

        // Generate a temporary token
        $temp_token = bin2hex(random_bytes(16));

        // Set temporary token expiration date to 24 hours from now
        $expiration_date = date("Y-m-d H:i:s", strtotime("+24 hours"));

        // Update user's token in database with the hashed temporary password and expiration date
        $update_query = "UPDATE users SET temp_token = '$temp_token', temp_token_expiration = '$expiration_date' WHERE email = '$email'";
        mysqli_query($conn, $update_query);

        $mail = new PHPMailer(true);

        try {
            // SMTP configuration for the email
            $mail->isSMTP();
            $mail->Host = 'smtp.zasolutions.co.za';
            $mail->SMTPAuth = true;
            $mail->Username = 'smtp@zasolutions.co.za';
            $mail->Password = 'Letmein1234';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Sender and first recipient settings
            $mail->setFrom('smtp@zasolutions.co.za', 'AUTOMATED INSURANCE');
            $mail->addAddress($email, $username);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'PASSWORD RESET';
            $mail->Body = '
    <style>
        body {
            font-family: Arial, sans-serif;
            overflow-x: hidden;
            width: 400px;
        }
        
        #container {
            width: 400px;
            margin: 15px auto 50px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            padding: 30px;
            overflow-x: hidden;
        }
        
        h1 {
            font-size: 28px;
            margin-top: -15px;
            color: #007bff;
            text-align: center;
            
        }
        
        p {
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            width: 10px
        }

        .logo {
            background-color: #151A7B;
            box-shadow: 0 0 0 3px white, 0 0 0 6px #151A7B;
            border-radius: 20px;
            color: white;
            font-family: Orbitron;
            font-size: 87px;
            font-weight: bold;
            height: 102px;
            padding: 10px;
            padding-top: 5px;
            text-align: center;
            text-decoration: wavy;
            width: 111px;
            cursor: default;
            margin-top: 10px;
        }

        .logo2 {
            background-color: #151A7B;
            box-shadow: 0 0 0 3px white, 0 0 0 6px #151A7B;
            border-radius: 20px;
            color: white;
            font-family: Orbitron;
            font-size: 87px;
            font-weight: bold;
            height: 102px;
           text-align: center;
            text-decoration: none;
            margin-top: 10px;
        }
        .button {
            background-color: #151A7B;
            box-shadow: 0 0 0 3px white, 0 0 0 6px #151A7B;
            border-radius: 20px;
            color: white;
            font-family: Orbitron;
            font-size: 25px;
            font-weight: bold;
            height: 102px;
            padding: 10px;
            padding-top: 5px;
            text-align: center;
            text-decoration: wavy;
          
            cursor: default;
            margin-top: 10px;
        }

        a.button a:link,
a.button a:visited,
a.button a:hover,
a.button a:active {
    color: white;
    text-decoration: none;
    padding: 14px 16px;
    border: none;
    border-radius: 4px;
    border: 2px solid white;
    cursor: pointer;
    position: relative;
    left: 422px;
    bottom: -15px;
   
}
    </style>
    <div id="container">
        <div class="logo">AI</div>
        <br>
        <h1>Password Reset Request</h1>
        <p>Dear ' . $username . ',</p>
        <p>We have received a request to reset the password for your AI account associated with the email of 
        ' . $email . '. No changes have been made to your account yet.</p>
        <p>You can reset your password by clicking on the link below:</p>
        <div class="button"><a href="http://localhost:3000/Users/Lloyd/Desktop/PROJECT/playground/autolegal/16_insurance/reset_password_1a.php?token=' . $temp_token . '" style="text-decoration:none;color:white;">
        <p></p>Reset Password<p> </p>
        </a></div>
        <p>Please note that the link will expire within 24 hours.</p>
        <p>If you did not request a new password, please let us know by replying to this email.</p>
        <p>- The AI Team</p>
    </div>';


            $mail->send();
            session_start();
            $_SESSION["message"] = "An email with instructions to reset your password has been sent to your email.";
            header("Location: ../16_insurance/forgot_password_3.php");
            exit();
        } catch (Exception $e) {
            session_start();
            $_SESSION["message"] = "Failed to send email.";
            header("Location: ../16_insurance/forgot_password_3.php");
            exit();
        }
    } else {
        session_start();
        $_SESSION["message"] = "Failed to send email.";
        header("Location: ../16_insurance/forgot_password_3.php");
        exit();
    }
}
