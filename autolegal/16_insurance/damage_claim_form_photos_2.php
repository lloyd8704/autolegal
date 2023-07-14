<?php
session_start();
// Retrieve the reference number from the session

require_once '../../vendor/dompdf/autoload.inc.php';
require_once '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../../vendor/phpmailer/phpmailer/src/SMTP.php';

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Connect to the database
include "../16_insurance/db_connection.php";

$sql_last_ref = "SELECT reference FROM damage_claim ORDER BY id DESC LIMIT 1";
$result_last_ref = mysqli_query($conn, $sql_last_ref);

// Extract the code for generating the unique reference number
if ($result_last_ref && mysqli_num_rows($result_last_ref) > 0) {
    $row_last_ref = mysqli_fetch_assoc($result_last_ref);
    $last_ref = $row_last_ref['reference'];
    // If there is a reference number in the database, increment the first number
    $parts = explode('/', $last_ref);
    $i = $parts[0];
    $year = date('y'); // get current year in two-digit format
    if (!empty($i)) {
        $new_number = ++$i; // use pre-increment operator to increment $i before assigning it to $new_number
    } else {
        $new_number = 1; // start at 1 if there are no previous entries
    }
    $reference = strval($new_number);
} else {
    $reference = "1"; // start at 1 if there are no previous entries
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["document"])) {
    $targetDirectory = "C:\\Users\\Lloyd\\Mellows & de Swardt Inc\\Shared Data - User data\\Lloyd\\TEST FOLDER\\";

    // Get the reference number from the generated code
    $referenceNumber = $reference;

    // Create the subfolder using the reference number
    $subfolderPath = $targetDirectory . $referenceNumber . "/";
    if (!is_dir($subfolderPath)) {
        mkdir($subfolderPath, 0777, true);
    }

    // Process each uploaded file
    $fileCount = count($_FILES["document"]["name"]);
    for ($i = 0; $i < $fileCount; $i++) {
        $targetFile = $subfolderPath . basename($_FILES["document"]["name"][$i]);

        // Check if the file is a valid document
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (!in_array($fileType, ["pdf", "doc", "docx", "jpg", "jpeg", "png"])) {
            echo "Only PDF, DOC, DOCX, JPG, JPEG, and PNG files are allowed.";
            exit;
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["document"]["tmp_name"][$i], $targetFile)) {
            // File uploaded successfully
        } else {
            echo "Error uploading the document.";
        }
    }
}


// Retrieve form data and sanitize
$company_name = (mysqli_real_escape_string($conn, $_POST['company_name']));
$company_name = stripslashes($company_name);
$contact_name = ucwords(mysqli_real_escape_string($conn, $_POST['contact_name']));
$contact_name = stripslashes($contact_name);
$name_for_email = $name = ucwords(strtolower(mysqli_real_escape_string($conn, $_POST['company_name'])));
$name_for_email = stripslashes($name_for_email);
$email = ucwords(mysqli_real_escape_string($conn, $_POST['email']));
$address = ucwords(mysqli_real_escape_string($conn, $_POST['address']));
$address = stripslashes($address);
$contact = ucwords(mysqli_real_escape_string($conn, $_POST['contact']));
$policy_number = (mysqli_real_escape_string($conn, $_POST['policy_number']));
$date = (mysqli_real_escape_string($conn, $_POST['date']));
$location = ucwords(mysqli_real_escape_string($conn, $_POST['location']));
$location = stripslashes($location);
$quantum = (mysqli_real_escape_string($conn, $_POST['quantum']));
$third_party_name = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_name']));
$third_party_name = stripslashes($third_party_name);
$third_party_contact = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_contact']));
$third_party_address = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_address']));
$third_party_address = stripslashes($third_party_address);
$third_party_email = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_email']));
$details = str_replace("\\r\\n", "\n", $_POST['details']);
$details = ucfirst($details);


$dateObj = DateTime::createFromFormat('d-m-Y', $date);
if (!$dateObj) {
    // Handle error - invalid date format
    echo 'Invalid date format!';
} else {
    // Subtract a day and add 3 years
    $dateObj->sub(new DateInterval('P1D'));
    $dateObj->add(new DateInterval('P3Y'));

    // Format the date in 'Y-m-d' format
    $prescription = $dateObj->format('d-m-Y');

    // Use the $prescription variable in your code
    // ...
}


// Get the last reference number from the database


// Prepare SQL query to insert data into the table
$sql = "INSERT INTO damage_claim (reference, company_name, email, contact_name, address, contact, date, prescription, 
location, quantum, third_party_name, third_party_contact, third_party_address, third_party_email, details, 
policy_number) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

// Bind variables to the prepared statement
mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssssssss",
    $reference,
    $company_name,
    $email,
    $contact_name,
    $address,
    $contact,
    $date,
    $prescription,
    $location,
    $quantum,
    $third_party_name,
    $third_party_contact,
    $third_party_address,
    $third_party_email,
    $details,
    $policy_number,
);

// Execute the prepared statement
mysqli_stmt_execute($stmt);
//$image_path = '../11_Images/ACE_CLAIM_FORM_2.jpg';
$image_path = '../11_Images/UNISON - LOGO.jpg';
$image_data = file_get_contents($image_path);

// Convert the image data to base64 format
$image_base64 = base64_encode($image_data);

// Embed the image in the HTML

$html_template = file_get_contents('../16_insurance/damage_claim_form_copy_3.html');
$html = str_replace('{company_name}', $company_name, $html_template);
$html = str_replace('{contact_name}', $contact_name, $html);
$html = str_replace('{email}', $email, $html);
$html = str_replace('{address}', $address, $html);
$html = str_replace('{policy_number}', $policy_number, $html);
$html = str_replace('{quantum}', $quantum, $html);
$html = str_replace('{contact}', $contact, $html);
$html = str_replace('{date}', $date, $html);
$html = str_replace('{location}', $location, $html);
$html = str_replace('{third_party_name}', $third_party_name, $html);
$html = str_replace('{third_party_contact}', $third_party_contact, $html);
$html = str_replace('{third_party_address}', $third_party_address, $html);
$html = str_replace('{third_party_email}', $third_party_email, $html);
$html = str_replace('{details}', $details, $html);
$html = str_replace('{image}', '<img src="data:image/png;base64,' . $image_base64 . '" style="width:700px;">', $html);


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
$mail->addAddress('lloydmanning@live.co.za', '');
// Attach PDF file
//$mail->addAttachment('../11_Images/AI-LOGO.png', 'logo.png');
$mail->addStringAttachment($pdf_content, 'Claim Form.pdf', 'base64', 'application/pdf');

// Content
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';                             // Set email format to HTML
$mail->Subject = 'Claim Form - Reference: ' . $reference;
$mail->Body   = '
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Orbitron" />
<div id="container" style="max-width: 400px; width: 100%; margin: 0 auto; background-color: #fff; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); overflow-x: hidden; overflow-y: auto; max-height: 600px; padding: 20px;">
<div class="logo" style="width: 111px; height: 94px; padding: 10px; font-size: 87px; background-color: #151A7B; box-shadow: 0 0 0 3px white, 0 0 0 6px #151A7B; border-radius: 20px; color: white; font-family: Orbitron; font-size: 87px; font-weight: bold; height: 102px; padding: 10px; padding-top: 5px; text-align: center; width: 111px; margin: 0 auto;">AI</div>
<br>
    <h1 style="font-size: 28px; margin-top: 0; color: #007bff; text-align: center;">We have received your claim!</h1>
    <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">Dear ' . $name_for_email . ',</p>
    <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">Kindly find attached hereto the completed Claim Form.</p> 
    <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">Please sign the attached Claim Form and email a copy to: email@something.com.</p>
    <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;"><strong> * Your reference number is: ' . $reference . ' *</strong></p>
</div>';
$mail->send();

/*<img src="cid:logo.png">
 #logo {
    display: flex;
    justify-content: center;
    align-items: center;
  
    margin-left: 310px;
    margin-right: auto;
  }*/


// Create a new PHPMailer instance
// Create a new PHPMailer instance for the first email
$mail1 = new PHPMailer();

// SMTP configuration for the first email
$mail1->isSMTP();
$mail1->Host = 'smtp.zasolutions.co.za';
$mail1->SMTPAuth = true;
$mail1->Username = 'smtp@zasolutions.co.za';
$mail1->Password = 'Letmein1234';
$mail1->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail1->Port = 587;

// Sender and first recipient settings
$mail1->setFrom('smtp@zasolutions.co.za', 'New Claim Received');
$mail1->addAddress('lloyd@solicitors.co.za', '');
$mail1->addAddress('lloydmanning@live.co.za', '');

// Email content for the first email
$mail1->isHTML(true);
$mail1->Subject = 'RE: REGISTERED CLAIM - ' . $reference;
$mail1->Body = "<html>
    <head>
      <style>
        /* Add styles for the body of the email */
        body {
          font-family: Arial, sans-serif;
          font-size: 14px;
          line-height: 1.5;
          color: #333;
          margin: auto;
        }
        /* Add styles for the headings */
        h1, h2, h3 {
          font-family: Arial, sans-serif;
          color: #000;
          margin-bottom: 10px;
        }
        h1 {
          font-size: 24px;
        }
        h2 {
          font-size: 20px;
        }
        h3 {
          font-size: 16px;
        }
      </style>
    </head>
    <body>
      <p>A new claim has been received with the following details:</p>
      <ul>
        <li><strong>Reference number:</strong> $reference </li>
        <li><strong>Policy number:</strong> $policy_number </li>
        <li><strong>Insured:</strong> $company_name </li>
        <li><strong>Email:</strong> $email </li>
        <li><strong>Location of incident:</strong> $location</li>
        <li><strong>Date of incident:</strong> $date</li>
        <li><strong><span style='color:red'>Date of Prescription: $prescription</span></strong> </li>
        <li><strong>Details:</strong> $details</li>
        <li><strong>Quantum:</strong> $quantum</li>
        <li><strong>Third Party:</strong> $third_party_name</li>
        <li><strong>Third Party's Address:</strong> $third_party_address</li>
        <li><strong>Third Party's Email:</strong> $third_party_email</li>
      </ul>
    </body>
  </html>";

$mail1->send();
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

<body>
    <div id="container">
        <div class="logo">AI</div><br>
        <!-- <img src="../11_Images/AI-LOGO.png">-->
        <h1>Your claim has been recieved!</h1>
        <p>An email has been sent to you with the relevant details.</p>
        <p>You reference number is: <?php echo $reference; ?>
            <button class="copy-btn" onclick="copyToClipboard('<?php echo $reference; ?>')">Copy</button>
        </p>
        <a href="../16_insurance/index.php">Back to home</a>
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