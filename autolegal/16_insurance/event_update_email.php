<?php
session_start();
require_once '../../vendor/dompdf/autoload.inc.php';
require_once '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../../vendor/phpmailer/phpmailer/src/SMTP.php';

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Connect to the database
include "../16_insurance/db_connection.php";

// Function to send email using PHPMailer
function sendEmail($email, $updateContent, $name, $reference)
{
    // Create a new PHPMailer instance
    $mail = new PHPMailer();

    // Configure the SMTP settings
    $mail->isSMTP();
    $mail->Host = 'smtp.zasolutions.co.za';
    $mail->SMTPAuth = true;
    $mail->Username = 'smtp@zasolutions.co.za';
    $mail->Password = 'Letmein1234';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587; // TCP port to connect to

    // Set the email details
    $mail->setFrom('smtp@zasolutions.co.za', 'AI');
    $mail->addAddress($email);
    $mail->Subject = 'Claim Update';

    // Enable HTML formatting
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    // Set the email body
    $emailBody =   ' 
    <div id="container" style="max-width: 400px; width: 100%; margin: 0 auto; background-color: #fff; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); overflow-x: hidden; overflow-y: auto; max-height: 600px; padding: 20px;">
    <div class="logo" style="width: 111px; height: 94px; padding: 10px; font-size: 87px; background-color: #151A7B; box-shadow: 0 0 0 3px white, 0 0 0 6px #151A7B; border-radius: 20px; color: white; font-family: Orbitron; font-size: 87px; font-weight: bold; height: 102px; padding: 10px; padding-top: 5px; text-align: center; width: 111px; margin: 0 auto;">AI</div>
    <br>
    <h1 style="font-size: 28px; margin-top: 0; color: #007bff; text-align: center;">Your claim has been updated</h1>
    <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">Dear ' . $name . ',</p>
    <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">We hope this email finds you well. We would like to inform you that there has been an update regarding your claim with reference number ' . $reference . '.</p> 
    <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">The update to your claim is as follows:</p>
    <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">' . $updateContent . '</p>
    <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">Please review the provided information and feel free to contact us if you have any questions or require further assistance. We are here to support you throughout the claims process.</p>
    <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">Thank you for choosing our insurance services.</p>
    <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">Best regards,</p>
    <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">AI Team</p>
</div>';
    $mail->Body = $emailBody;

    if ($mail->send()) {
        echo '<div id="container">';
        echo '<div class="logo">SI</div><br>';
        echo '<h1>Email was sent successfully!</h1>';
        echo '<p>An email was sent to the insured: ' . $name . '</p>';
        echo '<a href="../16_insurance/index.php">Back to home</a>';
        echo '</div>';
    } else {
        echo '<div id="container">';
        echo '<div class="logo">AI</div><br>';
        echo '<h1>Failed to send email.</h1>';
        echo '<a href="../16_insurance/index.php">Back to home</a>';
        echo '</div>';
    }
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the reference and update content from the form
    $reference = $_POST['reference'];
    $updateContent = $_POST['update_content'];

    // Look up the email and name associated with the reference in the claim_form table
    $stmt = $conn->prepare("SELECT email, name FROM claim_form WHERE reference = ?");
    $stmt->bind_param("s", $reference);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a row in the database with the given reference
    if ($result->num_rows == 1) {
        // Fetch the email and name from the result set
        $row = $result->fetch_assoc();
        $email = "lloydmanning@live.co.za";
        $name = $row['name'];

        // Send the update email
        sendEmail($email, $updateContent, $name, $reference);
    } else {
        // Reference not found in the claim_form table
        echo '<div id="container">';
        echo '<div class="logo">AI</div><br>';
        echo '<h1>Invalid reference.</h1>';
        echo '<a href="../16_insurance/index.php">Back to home</a>';
        echo '</div>';
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Success!</title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
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
            text-align: center;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #151A7B;
            ;
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

        .copy-btn {
            display: inline-block;
            margin-left: 10px;
            padding: 5px 10px;
            background-color: #151A7B;
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
            margin: auto;
        }
    </style>
</head>

</html>