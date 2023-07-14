<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
// Send email with some of the data
require_once '../16_insurance/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../16_insurance/vendor/phpmailer/phpmailer/src/SMTP.php';
require_once '../16_insurance/vendor/phpmailer/phpmailer/src/Exception.php';
require_once '../../vendor/dompdf/autoload.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $html_template = file_get_contents('C:\Users\Lloyd\Desktop\TEST.htm');
    $html = str_replace('{name}', $name, $html_template);
    $html = str_replace('{email}', $email, $html);
    $html = str_replace('{message}', $message, $html);
    $image_path = '../11_Images/ACE - LOGO.png';
    $image_data = base64_encode(file_get_contents($image_path));
    $image_src = 'data:image/png;base64,' . $image_data;
    $html = str_replace('{image}', '<img src="' . $image_src . '">', $html);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $pdf_content = $dompdf->output();

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    // SMTP configuration for sending email
    $mail->isSMTP();
    $mail->Host = 'smtp.zasolutions.co.za';
    $mail->SMTPAuth = true;
    $mail->Username = 'smtp@zasolutions.co.za';
    $mail->Password = 'Letmein1234';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Sender and recipient settings
    $mail->setFrom('smtp@zasolutions.co.za', 'New Claim Received');
    $mail->addAddress('lloyd@solicitors.co.za', '');

    // Email content for the email
    $mail->isHTML(true);
    $mail->Subject = 'RE: REGISTERED CLAIM - ';
    $mail->Body = "<html>...</html>";

    // Attach PDF to email
    $mail->addStringAttachment($pdf_content, 'contact-form.pdf');

    // Send email
    $mail->send();

    // Output success message
    echo 'Email sent successfully';
}
