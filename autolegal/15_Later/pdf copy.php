<?php
require_once '../../vendor/dompdf/autoload.inc.php';
require_once '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../../vendor/phpmailer/phpmailer/src/SMTP.php';

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name =  $_POST['name'];
    $email =  $_POST['email'];
    $location =  $_POST['location'];
    $date =  $_POST['date'];
    $details = $_POST['details'];

    $html_template = file_get_contents('../15_Later/pdf_generate_2.html');
    $html = str_replace('{name}', $name, $html_template);
    $html = str_replace('{email}', $email, $html);
    $html = str_replace('{location}', $location, $html);
    $html = str_replace('{date}', $date, $html);
    $html = str_replace('{details}', $details, $html);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->render();
    $pdf_content = $dompdf->output();

    // Send email with PDF attachment
    $mail = new PHPMailer(true);
    try {
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
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
