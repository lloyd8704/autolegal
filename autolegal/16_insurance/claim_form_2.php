<?php
session_start();
// Retrieve the reference number from the session

require_once '../../vendor/dompdf/autoload.inc.php';
require_once '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../../vendor/phpmailer/phpmailer/src/SMTP.php';

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "correspdb";

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_last_ref = "SELECT reference FROM claim_form ORDER BY id DESC LIMIT 1";
$result_last_ref = mysqli_query($conn, $sql_last_ref);

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
    $reference = strval($new_number) . '/' . $year;
} else {
    $reference = "1/" . date('y'); // start at 1 if there are no previous entries
}

// Retrieve form data and sanitize
$name = ucwords(mysqli_real_escape_string($conn, $_POST['name']));
$name = stripslashes($name);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$contact = mysqli_real_escape_string($conn, $_POST['contact']);
$identity = mysqli_real_escape_string($conn, $_POST['identity']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$address = stripslashes($address);
$insured_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['insured_vehicle']));
$insured_vehicle = stripslashes($insured_vehicle);
$insured_registration = ucwords(mysqli_real_escape_string($conn, $_POST['insured_registration']));
$driver = ucwords(mysqli_real_escape_string($conn, $_POST['driver']));
$driver = stripslashes($driver);
$driver_identity = mysqli_real_escape_string($conn, $_POST['driver_identity']);
$driver_address = ucwords(mysqli_real_escape_string($conn, $_POST['driver_address']));
$driver_address = stripslashes($driver_address);
$location = ucwords(mysqli_real_escape_string($conn, $_POST['location']));
$location = stripslashes($location);
$date = (mysqli_real_escape_string($conn, $_POST['date']));
$third_party_name = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_name']));
$third_party_name = stripslashes($third_party_name);
$third_party_contact = mysqli_real_escape_string($conn, $_POST['third_party_contact']);
$third_party_address = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_address']));
$third_party_address = stripslashes($third_party_address);
$third_party_email = mysqli_real_escape_string($conn, $_POST['third_party_email']);
$third_party_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_vehicle']));
$third_party_vehicle = stripslashes($third_party_vehicle);
$third_party_registration = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_registration']));
$details = str_replace("\\r\\n", "\n", $_POST['details']);


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
$sql = "INSERT INTO claim_form (reference, name, email, contact, identity, address, insured_vehicle, 
insured_registration, driver, driver_identity, driver_address, location, date, third_party_name, 
third_party_contact, third_party_address, third_party_email, third_party_vehicle, third_party_registration, details) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

// Bind variables to the prepared statement
mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssssssssssss",
    $reference,
    $name,
    $email,
    $contact,
    $identity,
    $address,
    $insured_vehicle,
    $insured_registration,
    $driver,
    $driver_identity,
    $driver_address,
    $location,
    $date,
    $third_party_name,
    $third_party_contact,
    $third_party_address,
    $third_party_email,
    $third_party_vehicle,
    $third_party_registration,
    $details,
);


// Execute the prepared statement
mysqli_stmt_execute($stmt);


// Get the image data in binary format
$image_path = '../11_Images/ACE_CLAIM_FORM.png';
$image_data = file_get_contents($image_path);

// Convert the image data to base64 format
$image_base64 = base64_encode($image_data);

// Embed the image in the HTML

$html_template = file_get_contents('../16_insurance/claim_form_copy.html');
$html = str_replace('{name}', $name, $html_template);
$html = str_replace('{email}', $email, $html);
$html = str_replace('{contact}', $contact, $html);
$html = str_replace('{identity}', $identity, $html);
$html = str_replace('{address}', $address, $html);
$html = str_replace('{insured_vehicle}', $insured_vehicle, $html);
$html = str_replace('{insured_registration}', $insured_registration, $html);
$html = str_replace('{driver}', $driver, $html);
$html = str_replace('{driver_identity}', $driver_identity, $html);
$html = str_replace('{driver_address}', $driver_address, $html);
$html = str_replace('{location}', $location, $html);
$html = str_replace('{date}', $date, $html);
$html = str_replace('{third_party_name}', $third_party_name, $html);
$html = str_replace('{third_party_contact}', $third_party_contact, $html);
$html = str_replace('{third_party_address}', $third_party_address, $html);
$html = str_replace('{third_party_email}', $third_party_email, $html);
$html = str_replace('{third_party_vehicle}', $third_party_vehicle, $html);
$html = str_replace('{third_party_registration}', $third_party_registration, $html);
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

// Attach PDF file
$mail->addAttachment('../11_Images/AI-LOGO.png', 'logo.png');
$mail->addStringAttachment($pdf_content, 'Claim Form.pdf', 'base64', 'application/pdf');

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Claim Form - Reference: ' . $reference;
$mail->Body    = '
<style>
 body {
    font-family: Arial, sans-serif;
    overflow-x: hidden;
    width: 400px
}

#container {
    width: 400px;
    /* margin: 15px auto 50px auto; */
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    /* padding: 30px; */
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
    }


    #logo {
      display: flex;
      justify-content: center;
      align-items: center;
    
      margin-left: 310px;
      margin-right: auto;
    }
</style>
<div id="container">
<div id="logo">
    <img src="cid:logo.png">
</div><br>
    <h1>We have recieved your claim!</h1>
    <p>Dear ' . $name . ',</p>
    <p>Kindly find attached hereto a copy of your claim form.</p> 
    <p>Please sign the form and email a copy to: email@something.com.</p>
    <p><strong> * Your reference number is: ' . $reference . ' *</strong></p>
</div>';

$mail->send();


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
        <li><strong>Insured:</strong> $name </li>
        <li><strong>Email:</strong> $email </li>
        <li><strong>Location of incident:</strong> $location</li>
        <li><strong>Date of incident:</strong> $date</li>
        <li><strong><span style='color:red'>Date of Prescription: $prescription</span></strong> </li>
        <li><strong>Details:</strong> $details</li>
        <li><strong>Third Party's name:</strong> $third_party_name</li>
        <li><strong>Third Party's contact number:</strong> $third_party_contact</li>
        <li><strong>Third Party's email:</strong> $third_party_email</li>
        <li><strong>Third Party's Address:</strong> $third_party_address</li>
      </ul>
    </body>
  </html>";

$mail1->send();
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
            text-align: center;
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
        <img src="../11_Images/AI-LOGO.png">
        <h1>Your claim has been recieved!</h1>
        <p>An email has been sent to you with the relevant details.</p>
        <p>You reference number is: <?php echo $reference; ?>
            <button class="copy-btn" onclick="copyToClipboard('<?php echo $reference; ?>')">Copy</button>
        </p>
        <a href="../16_insurance/claim_form_1.html">Back to home</a>
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