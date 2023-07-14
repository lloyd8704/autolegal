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
$details = str_replace("\\r\\n", "\n", $_SESSION['details']);

$test1 = $_SESSION['test1'];
$test2 = $_SESSION['test2'];
$test3 = $_SESSION['test3'];
$test4 = $_SESSION['test4'];

$html_template = file_get_contents('../15_Later/pdf_generate_2.html');
$html = str_replace('{name}', $name, $html_template);
$html = str_replace('{email}', $email, $html);
$html = str_replace('{location}', $location, $html);
$html = str_replace('{date}', $date, $html);
$html = str_replace('{details}', $details, $html);

$html = str_replace('{test1}', $test1, $html);
$html = str_replace('{test2}', $test2, $html);
$html = str_replace('{test3}', $test3, $html);
$html = str_replace('{test4}', $test4, $html);


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
$mail->setFrom('smtp@zasolutions.co.za', 'AI');
$mail->addAddress('lloyd@solicitors.co.za', '');     // Add a recipient

// Attach PDF file
$mail->addStringAttachment($pdf_content, 'contact-form.pdf', 'base64', 'application/pdf');

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Claim Form - ' . $date . $reference;
$mail->Body    = '<p>Thank you for submitting your claim form.</p>';
'<p>Kindly find attached hereto your completed Claim Form</p>';


$mail->send();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Success!</title>
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
  </style>
</head>

<body>
  <div id="container">
    <h1>Thank you!</h1>
    <p>Your claim has been submitted successfully.</p>
    <p>You reference number is: <?php echo $reference; ?>
      <button class="copy-btn" onclick="copyToClipboard('<?php echo $reference; ?>')">Copy</button>
    </p>
    <p>An email has been sent to you with the relevant details.</p>
    <a href="../16_insurance/claim_form.html">Back to home</a>
  </div>

  <!-- JavaScript code for copying to clipboard -->
  <script>
    function copyToClipboard(text) {
      var textarea = document.createElement("textarea");
      textarea.value = text;
      document.body.appendChild(textarea);
      textarea.select();
      document.execCommand("copy");
      document.body.removeChild(textarea);

      var button = document.querySelector('.copy-btn');
      button.classList.add('copied');
      button.innerHTML = '';
    }
  </script>
</body>

</html>