<?php
session_start();
// Retrieve the reference number from the session

require_once '../../vendor/dompdf/autoload.inc.php';
require_once '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../../vendor/phpmailer/phpmailer/src/SMTP.php';

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$reference = $_SESSION['reference'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$location = $_SESSION['location'];
$date = $_SESSION['date'];

$html_template = file_get_contents('../15_Later/pdf_generate_2.html');
$html = str_replace('{name}', $name, $html_template);
$html = str_replace('{email}', $email, $html);
$html = str_replace('{location}', $location, $html);
$html = str_replace('{date}', $date, $html);

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->render();
$pdf_content = $dompdf->output();

// Send email with PDF attachment
$mail = new PHPMailer(true);

//Server settings
$mail->isSMTP();
$mail->Host = 'smtp.zasolutions.co.za';
$mail->SMTPAuth = true;
$mail->Username = 'smtp@zasolutions.co.za';
$mail->Password = 'Letmein1234';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;                           // TCP port to connect to

//Recipients
$mail->setFrom('smtp@zasolutions.co.za', 'Your Name');
$mail->addAddress('lloyd@solicitors.co.za', '');     // Add a recipient

// Attach PDF file
$mail->addStringAttachment($pdf_content, 'contact-form.pdf', 'base64', 'application/pdf');

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Your Claim Form';
$mail->Body    = '<p>Thank you for submitting your claim form. Please see attached PDF for your records.</p>';

$mail->send();
