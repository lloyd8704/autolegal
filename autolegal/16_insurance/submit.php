<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Send email with some of the data
require_once '../16_insurance/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once '../16_insurance/vendor/phpmailer/phpmailer/src/SMTP.php';
require_once '../16_insurance/vendor/phpmailer/phpmailer/src/Exception.php';


session_start();
// Connect to the database
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

// Get the last reference number from the database
$sql_last_ref = "SELECT reference FROM collision_reports ORDER BY id DESC LIMIT 1";
$result_last_ref = mysqli_query($conn, $sql_last_ref);
if ($result_last_ref) {
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
  $new_ref = strval($new_number) . '/' . $year;
} else {
  echo "Error: " . $sql_last_ref . "<br>" . mysqli_error($conn);
}

// Prepare SQL query to insert data into the table
$sql = "INSERT INTO collision_reports (reference, name, email, location, date, details, prescription) VALUES (?, ?, ?, ?, ?, ?, ?)";

// Prepare statement and bind parameters
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssssss", $new_ref, $name, $email, $location, $date, $details, $prescription);

// Retrieve form data and sanitize
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$dateObj = DateTime::createFromFormat('d-m-Y', $date);
$test1 = mysqli_real_escape_string($conn, $_POST['test1']);
$test2 = mysqli_real_escape_string($conn, $_POST['test2']);
$test3 = mysqli_real_escape_string($conn, $_POST['test3']);
$test4 = mysqli_real_escape_string($conn, $_POST['test4']);

$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['location'] = $location;
$_SESSION['date'] = $date;

$_SESSION['test1'] = $test1;
$_SESSION['test2'] = $test2;
$_SESSION['test3'] = $test3;
$_SESSION['test4'] = $test4;

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


$details = str_replace("\\r\\n", "\n", $_POST['details']);
$_SESSION['reference'] = $new_ref;
$_SESSION['details'] = $details;

// Execute statement and check if successful
if (mysqli_stmt_execute($stmt)) {
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
  $mail1->Subject = 'RE: REGISTERED CLAIM - ' . $new_ref;
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
      <li><strong>Reference number:</strong> $new_ref</li>
      <li><strong>Insured:</strong> $name</li>
      <li><strong>Email:</strong> $email</li>
      <li><strong>Location of incident:</strong> $location</li>
      <li><strong>Date of incident:</strong> $date</li>
      <li><strong><span style='color:red'>Date of Prescription:</span></strong> $prescription</li>
      <li><strong>Details:</strong> $details</li>
    </ul>
  </body>
</html>";


  // Send the first email
  if ($mail1->send()) {
    // Create a new PHPMailer instance for the second email
    $mail2 = new PHPMailer();

    // SMTP configuration for the second email
    $mail2->isSMTP();
    $mail2->Host = 'smtp.zasolutions.co.za';
    $mail2->SMTPAuth = true;
    $mail2->Username = 'smtp@zasolutions.co.za';
    $mail2->Password = 'Letmein1234';
    $mail2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail2->Port = 587;

    // Sender and second recipient settings
    $mail2->setFrom('smtp@zasolutions.co.za', 'ACE&E');
    $mail2->addAddress('lloyd@solicitors.co.za', $name);

    $mail2->addAttachment('../11_Images/ACE - LOGO.png', 'logo.png');
    // Email content for the second email
    $mail2->isHTML(true);
    $mail2->Subject = 'RE: REGISTERED CLAIM - ' . $new_ref;
    $mail2->Body = '
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
      }

        #container {
          width: 600px;
          margin: 15px auto 50px auto; /* adjusted margin */
          background-color: #fff;
          border-radius: 5px;
          box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
          padding: 30px;
          
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
        
          margin-left: 260px;
          margin-right: auto;
        }
    </style>
    <div id="container">
    <div id="logo">
        <img src="cid:logo.png">
    </div><br>
        <h1>We have recieved your claim!</h1>
        <p>Dear ' . $name . ',<br><br>Your claim was successfully submitted.</p>
        <p>A representative will be in contact with you shortly.</p>
        <p><strong> * Your reference number is: ' . $new_ref . ' *</strong></p>
    </div>';


    // Send the second email
    if ($mail2->send()) {

      // Redirect to success page
      header("Location: success.php");
      exit();
    } else {
      echo "Mailer Error: " . $mail2->ErrorInfo;
    }
  } else {
    echo "Mailer Error: " . $mail1->ErrorInfo;
  }
}
// Close the database connection
mysqli_close($conn);
