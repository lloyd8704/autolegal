<?php
require_once '../16_insurance/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../16_insurance/vendor/phpmailer/phpmailer/src/SMTP.php';
require_once '../16_insurance/vendor/phpmailer/phpmailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Create a new PHPMailer instance
$mail = new PHPMailer();

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.zasolutions.co.za';
$mail->SMTPAuth = true;
$mail->Username = 'smtp@zasolutions.co.za';
$mail->Password = 'Letmein1234';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

// Sender and recipient settings
$mail->setFrom('smtp@zasolutions.co.za', 'AC&E');
$mail->addAddress('lloyd@solicitors.co.za', 'Recipient Name');

// Email content
$mail->isHTML(true);
$mail->Subject = 'Test Email';
$mail->Body = '<h1>Hello World!</h1>';

// Attempt to send the email
try {
    $mail->send();
    echo 'Email sent successfully';
} catch (Exception $e) {
    echo "Error sending email: {$mail->ErrorInfo}";
}
