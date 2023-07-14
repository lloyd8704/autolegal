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

$driverselection = $_POST['driverselection'];
$third_parties = $_POST['third_parties'];

// if statements for driver and third party selection options

if ($driverselection == "1" && $third_parties == "1") {

  $name = ucwords(mysqli_real_escape_string($conn, $_POST['name']));
  $name = stripslashes($name);
  $name_for_email = $name = ucwords(strtolower(mysqli_real_escape_string($conn, $_POST['name'])));
  $name_for_email = stripslashes($name_for_email);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $identity = mysqli_real_escape_string($conn, $_POST['identity']);

  $date_of_birth = substr($identity, 0, 6); // Extract the first 6 characters
  $day = substr($date_of_birth, 4, 2);
  $month = substr($date_of_birth, 2, 2);
  $year_prefix = (substr($date_of_birth, 0, 2) <= 30) ? '20' : '19';
  $year = $year_prefix . substr($date_of_birth, 0, 2);
  $formatted_date_of_birth = $day . ' ' . date("F", mktime(0, 0, 0, $month, 1)) . ' ' . $year; // Format the date of birth as "12 December 2022"
  $date_of_birth = $formatted_date_of_birth;
  // Extracting gender
  $gender_digits = substr($identity, 6, 4); // Extract the 7th to 10th characters
  $gender = ($gender_digits >= 0 && $gender_digits <= 4999) ? 'Female' : 'Male'; // Determine gender based on assigned number range

  /* Extracting SA citizen status
  $citizen_status = substr($identity, 10, 1); // Extract the 11th character
  $citizen = ($citizen_status == 0) ? 'SA Citizen' : 'Permanent Resident'; // Determine SA citizen status based on the assigned digit

  // Extracting the checksum digit (Z)
  $checksum_digit = substr($identity, -1); Extract the last character */

  // Calculating current age
  $current_year = date('Y'); // Get the current year
  $age = $current_year - $year;

  $type_of_claim = "1d1t";
  $policy_number = mysqli_real_escape_string($conn, $_POST['policy_number']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $address = stripslashes($address);
  $insured_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['insured_vehicle']));
  $insured_vehicle = stripslashes($insured_vehicle);
  $insured_registration = ucwords(mysqli_real_escape_string($conn, $_POST['insured_registration']));
  $location = ucwords(mysqli_real_escape_string($conn, $_POST['location']));
  $location = stripslashes($location);
  $province = ucwords(mysqli_real_escape_string($conn, $_POST['province']));
  $date = (mysqli_real_escape_string($conn, $_POST['date']));
  $third_party_name = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_name']));
  $third_party_name = stripslashes($third_party_name);
  $third_party_contact = mysqli_real_escape_string($conn, $_POST['third_party_contact']);

  $third_party_identity = mysqli_real_escape_string($conn, $_POST['third_party_identity']);
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
  }

  // Prepare SQL query to insert data into the table
  $sql = "INSERT INTO claim_form (reference, type_of_claim, policy_number, name, email, contact, identity, date_of_birth, age, gender, address, insured_vehicle, 
    insured_registration, location, province, date, prescription, third_party_name, third_party_contact, 
    third_party_identity, third_party_vehicle, third_party_registration, details) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = mysqli_prepare($conn, $sql);

  // Bind variables to the prepared statement
  mysqli_stmt_bind_param(
    $stmt,
    "sssssssssssssssssssssss",
    $reference,
    $type_of_claim,
    $policy_number,
    $name,
    $email,
    $contact,
    $identity,
    $date_of_birth,
    $age,
    $gender,
    $address,
    $insured_vehicle,
    $insured_registration,
    $location,
    $province,
    $date,
    $prescription,
    $third_party_name,
    $third_party_contact,

    $third_party_identity,
    $third_party_vehicle,
    $third_party_registration,

    $details

  );


  // Execute the prepared statement
  mysqli_stmt_execute($stmt);
  $image_path = '../11_Images/LETTER_HEAD.jpg';
  $image_data = file_get_contents($image_path);

  // Convert the image data to base64 format
  $image_base64 = base64_encode($image_data);

  // Embed the image in the HTML

  $html_template = file_get_contents('../16_insurance/claim_form_copy_select_3a.html');
  $html = str_replace('{name}', $name, $html_template);
  $html = str_replace('{policy_number}', $policy_number, $html);
  $html = str_replace('{email}', $email, $html);
  $html = str_replace('{contact}', $contact, $html);
  $html = str_replace('{identity}', $identity, $html);
  $html = str_replace('{address}', $address, $html);
  $html = str_replace('{insured_vehicle}', $insured_vehicle, $html);
  $html = str_replace('{insured_registration}', $insured_registration, $html);
  $html = str_replace('{location}', $location, $html);
  $html = str_replace('{province}', $province, $html);
  $html = str_replace('{date}', $date, $html);
  $html = str_replace('{third_party_name}', $third_party_name, $html);
  $html = str_replace('{third_party_contact}', $third_party_contact, $html);

  $html = str_replace('{third_party_identity}', $third_party_identity, $html);
  $html = str_replace('{third_party_vehicle}', $third_party_vehicle, $html);
  $html = str_replace('{third_party_registration}', $third_party_registration, $html);
  $html = str_replace('{details}', $details, $html);
  $html = str_replace('{image}', '<img src="data:image/jpg;base64,' . $image_base64 . '" style="width:700px;">', $html);


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
  $mail->setFrom('smtp@zasolutions.co.za', 'SMART INSURE');
  $mail->addAddress('lloydmanning@live.co.za', '');     // Add a recipient

  // Attach PDF file
  //$mail->addAttachment('../11_Images/AI-LOGO.png', 'logo.png');
  $mail->addStringAttachment($pdf_content, 'Claim Form.pdf', 'base64', 'application/pdf');

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Claim Form - Reference: ' . $reference;
  $mail->Body    = '
  <!DOCTYPE html>
  <html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
  
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]--><!--[if !mso]><!-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet" type="text/css"><!--<![endif]-->
    <style>
      * {
        box-sizing: border-box;
      }
  
      body {
        margin: 0;
        padding: 0;
      }
  
      a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: inherit !important;
      }
  
      #MessageViewBody a {
        color: inherit;
        text-decoration: none;
      }
  
      p {
        line-height: inherit
      }
  
      .desktop_hide,
      .desktop_hide table {
        mso-hide: all;
        display: none;
        max-height: 0px;
        overflow: hidden;
      }
  
      .image_block img+div {
        display: none;
      }
  
      @media (max-width:660px) {
        .desktop_hide table.icons-inner {
          display: inline-block !important;
        }
  
        .icons-inner {
          text-align: center;
        }
  
        .icons-inner td {
          margin: 0 auto;
        }
  
        .image_block img.big,
        .row-content {
          width: 100% !important;
        }
  
        .mobile_hide {
          display: none;
        }
  
        .stack .column {
          width: 100%;
          display: block;
        }
  
        .mobile_hide {
          min-height: 0;
          max-height: 0;
          max-width: 0;
          overflow: hidden;
          font-size: 0px;
        }
  
        .desktop_hide,
        .desktop_hide table {
          display: table !important;
          max-height: none !important;
        }
      }
    </style>
  </head>
  
  <body style="background-color: #e6e6e6; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
  <br>
  
  <table class="nl-container" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #e6e6e6;">
      <tbody>
        <tr>
          <td>
            <table class="row row-1" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-image: url(""); background-repeat: no-repeat; background-size: auto;">
              <tbody>
                <tr>
                  <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #151c92; background-size: auto; border-radius: 0; color: #000000; width: 640px;" width="640">
                      <tbody>
                        <tr>
                          <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 7px; padding-left: 5px; padding-right: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                            <table class="image_block block-1" width="98%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                              <tr>
                                <td class="pad" style="padding-bottom:5px;width:110%;">
                                  <div class="alignment" align="center" style="line-height:10px"><img class="big" src="https://89a3452b49.imgdist.com/public/users/Integrators/BeeProAgency/1003133_987958/LETTER_HEAD.jpg" style="display: block; height: auto; border: 0; width: 630px; max-width: 110%; margin-left: 2px" width="640"></div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="row row-2" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
              <tbody>
                <tr>
                  <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6fbff; color: #000000; width: 640px;" width="640">
                      <tbody>
                        <tr>
                          <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                            <table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                              <tr>
                                <td class="pad">
                                  <div style="font-family: Arial, sans-serif">
                                    <div class style="font-size: 12px; font-family: "Roboto Slab", Arial, "Helvetica Neue", Helvetica, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #0074d9; line-height: 1.2;">
                                      <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px; color: #0074d9;"><strong><span style="font-size:28px; color: #0074d9">We have recieved your claim!</span></strong></p>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="row row-3" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
              <tbody>
                <tr>
                  <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6fbff; color: #000000; width: 640px;" width="640">
                      <tbody>
                        <tr>
                          <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                            <table class="paragraph_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                              <tr>
                                <td class="pad">
                                  <div style="color:#101112;direction:ltr;font-family:Poppins, Arial, Helvetica, sans-serif;font-size:16px;font-weight:400;letter-spacing:0px;line-height:120%;text-align:left;mso-line-height-alt:19.2px;">
                                    <p align="center" style="margin: 0; margin-bottom: 16px;">Dear <strong>' . $name_for_email . '</strong>,</p>
                                    <p align="center" style="margin: 0; margin-bottom: 16px;">Kindly find attached hereto the completed Claim Form.</p>
                                    <p align="center" style="margin: 0; margin-bottom: 16px;">Please sign the attached Form and email a copy to: <strong><a href="mailto:email@something.com" style="text-decoration: underline; color: #0074d9;">email@something.com</a></strong>.</p>
                                    <p align="center" style="margin: 0; margin-bottom: 16px;"><span><strong>* Your reference number is: ' . $reference . ' *</strong></span></p>
                                    <p align="center" style="margin: 0;"><span style="color: #0074d9;"><strong>- The SI Team -</strong></span></p>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="row row-4" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
              <tbody>
                <tr>
                  <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #0074d9; color: #000000; width: 640px;" width="640">
                      <tbody>
                        <tr>
                          <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                            <div class="spacer_block block-1" style="height:20px;line-height:20px;font-size:1px;">&#8202;</div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="row row-5" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
              <tbody>
                <tr>
                  <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-repeat: no-repeat; background-color: #08090a; background-image: url("https://d1oco4z2z1fhwp.cloudfront.net/templates/default/1431/background-image.jpg"); color: #000000; width: 640px;" width="640">
                      <tbody>
                        <tr>
                          <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 40px; padding-left: 30px; padding-right: 30px; padding-top: 40px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                            <table class="text_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                              <tr>
                                <td class="pad" style="padding-bottom:5px;padding-left:10px;padding-right:10px;padding-top:10px;">
                                  <div style="font-family: Arial, sans-serif">
                                    <div class style="font-size: 12px; font-family: "Roboto Slab", Arial, "Helvetica Neue", Helvetica, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #ffffff; line-height: 1.2;">
                                      <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px; color: white;"><span style="font-size:26px; color: white;">About Us</span></p>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </table>
                            <table class="text_block block-2" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                              <tr>
                                <td class="pad">
                                  <div style="font-family: sans-serif">
                                    <div class style="font-size: 12px; font-family: Poppins, Arial, Helvetica, sans-serif; mso-line-height-alt: 18px; color: #ffffff; line-height: 1.5;">
                                      <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 19.5px;"><span style="font-size:13px;">Welcome to Smart Insure! We are a cutting-edge web application designed to revolutionize claim processing. With our advanced features and innovative approach, we streamline the entire claim processing journey. Say goodbye to tedious paperwork and lengthy wait times. Join us today and experience a new era of hassle-free claim management.</span></p>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </table>
                            <table class="button_block block-3" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                              <tr>
                                <td class="pad" style="padding-bottom:10px;padding-left:10px;padding-right:10px;text-align:center;">
                                  <div class="alignment" align="center"><!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://localhost:3000/Users/Lloyd/Desktop/PROJECT/playground/autolegal/16_insurance/login.html/" style="height:42px;width:160px;v-text-anchor:middle;" arcsize="55%" stroke="false" fillcolor="#0074d9"><w:anchorlock/><v:textbox inset="0px,0px,0px,0px"><center style="color:#ffffff; font-family:Arial, sans-serif; font-size:14px"><![endif]--><a href="http://localhost:3000/Users/Lloyd/Desktop/PROJECT/playground/autolegal/16_insurance/login.html/" target="_blank" style="text-decoration:none;display:inline-block;color:#ffffff;background-color:#0074d9;border-radius:23px;width:auto;border-top:0px solid #0074D9;font-weight:undefined;border-right:0px solid #0074D9;border-bottom:0px solid #0074D9;border-left:0px solid #0074D9;padding-top:5px;padding-bottom:5px;font-family:Poppins, Arial, Helvetica, sans-serif;font-size:14px;text-align:center;mso-border-alt:none;word-break:keep-all;"><span style="padding-left:30px;padding-right:30px;font-size:14px;display:inline-block;letter-spacing:normal;"><span style="font-size: 16px; word-break: break-word; line-height: 2; mso-line-height-alt: 32px;"><strong><span style="font-size:14px;" data-mce-style="font-size:14px;">GET IN TOUCH</span></strong></span></span></a><!--[if mso]></center></v:textbox></v:roundrect><![endif]--></div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="row row-6" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
              <tbody>
                <tr>
                  <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #536583; color: #000000; width: 640px;" width="640">
                      <tbody>
                        <tr>
                          <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 20px; padding-top: 20px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                            <table class="text_block block-1" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;">
                              <tr>
                                <td class="pad">
                                  <div style="font-family: sans-serif">
                                    <div class style="font-size: 12px; font-family: Poppins, Arial, Helvetica, sans-serif; mso-line-height-alt: 14.399999999999999px; color: #f9f9f9; line-height: 1.2;">
                                      <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 16.8px;">City, Address line 1234, <a style="text-decoration: none; color: #f9f9f9;" title="tel:+1230456789" href="tel:+1230456789">+1 230 456 789</a>, <a style="text-decoration: none; color: #f9f9f9;" title="info@smartinsure.co.za" href="mailto:info@smartinsure.co.za">info@smartinsure.co.za</a></p>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                            </table>
                            <table class="divider_block block-2" width="100%" border="0" cellpadding="10" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                              <tr>
                                <td class="pad">
                                  <div class="alignment" align="center">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="65%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                                      <tr>
                                        <td class="divider_inner" style="font-size: 1px; line-height: 1px; border-top: 1px solid #657590;"><span>&#8202;</span></td>
                                      </tr>
                                    </table>
                                  </div>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="row row-7" align="center" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
              <tbody>
                <tr>
                  <td>
                    <table class="row-content stack" align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 640px;" width="640">
                      <tbody>
                        <tr>
                          <td class="column column-1" width="100%" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; padding-bottom: 5px; padding-top: 5px; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;">
                            <table class="icons_block block-1" width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;">
                              <tr>
                                
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
        <br>
      </tbody>
    </table><!-- End -->
  </body>
  
  </html>';

  $mail->send();

  /*
  <div id="logo">
  <img src="cid:logo.png">
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
            <li><strong>Policy number:</strong> $policy_number </li>
            <li><strong>Insured:</strong> $name </li>
            <li><strong>Email:</strong> $email </li>
            <li><strong>Location of incident:</strong> $location</li>
            <li><strong>Province:</strong> $province</li>
            <li><strong>Date of incident:</strong> $date</li>
            <li><strong><span style='color:red'>Date of Prescription: $prescription</span></strong> </li>
            <li><strong>Details:</strong> $details</li>
            <li><strong>Third Party:</strong> $third_party_name</li>
            <li><strong>Third Party's ID:</strong> $third_party_identity</li>
            
          </ul>
        </body>
      </html>";

  $mail1->send();
}

if ($driverselection == "1" && $third_parties == "2") {


  $name = ucwords(mysqli_real_escape_string($conn, $_POST['name']));
  $name = stripslashes($name);
  $name_for_email = $name = ucwords(strtolower(mysqli_real_escape_string($conn, $_POST['name'])));
  $name_for_email = stripslashes($name_for_email);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $identity = mysqli_real_escape_string($conn, $_POST['identity']);

  $date_of_birth = substr($identity, 0, 6); // Extract the first 6 characters
  $day = substr($date_of_birth, 4, 2);
  $month = substr($date_of_birth, 2, 2);
  $year_prefix = (substr($date_of_birth, 0, 2) <= 30) ? '20' : '19';
  $year = $year_prefix . substr($date_of_birth, 0, 2);
  $formatted_date_of_birth = $day . ' ' . date("F", mktime(0, 0, 0, $month, 1)) . ' ' . $year; // Format the date of birth as "12 December 2022"
  $date_of_birth = $formatted_date_of_birth;
  // Extracting gender
  $gender_digits = substr($identity, 6, 4); // Extract the 7th to 10th characters
  $gender = ($gender_digits >= 0 && $gender_digits <= 4999) ? 'Female' : 'Male'; // Determine gender based on assigned number range

  /* Extracting SA citizen status
  $citizen_status = substr($identity, 10, 1); // Extract the 11th character
  $citizen = ($citizen_status == 0) ? 'SA Citizen' : 'Permanent Resident'; // Determine SA citizen status based on the assigned digit

  // Extracting the checksum digit (Z)
  $checksum_digit = substr($identity, -1); Extract the last character */

  // Calculating current age
  $current_year = date('Y'); // Get the current year
  $age = $current_year - $year;

  $type_of_claim = "1d2t";
  $policy_number = mysqli_real_escape_string($conn, $_POST['policy_number']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $address = stripslashes($address);
  $insured_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['insured_vehicle']));
  $insured_vehicle = stripslashes($insured_vehicle);
  $insured_registration = ucwords(mysqli_real_escape_string($conn, $_POST['insured_registration']));
  $location = ucwords(mysqli_real_escape_string($conn, $_POST['location']));
  $location = stripslashes($location);
  $province = ucwords(mysqli_real_escape_string($conn, $_POST['province']));
  $date = (mysqli_real_escape_string($conn, $_POST['date']));
  $third_party_name = ucwords(mysqli_real_escape_string($conn, $_POST['first_driver_name']));
  $third_party_name = stripslashes($third_party_name);
  $third_party_contact = mysqli_real_escape_string($conn, $_POST['first_driver_contact']);

  $third_party_identity = mysqli_real_escape_string($conn, $_POST['first_driver_identity']);
  $third_party_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['first_driver_vehicle']));
  $third_party_vehicle = stripslashes($third_party_vehicle);
  $third_party_registration = ucwords(mysqli_real_escape_string($conn, $_POST['first_driver_registration']));
  $second_driver_name = ucwords(mysqli_real_escape_string($conn, $_POST['second_driver_name']));
  $second_driver_name = stripslashes($second_driver_name);
  $second_driver_contact = mysqli_real_escape_string($conn, $_POST['second_driver_contact']);

  $second_driver_identity = mysqli_real_escape_string($conn, $_POST['second_driver_identity']);
  $second_driver_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['second_driver_vehicle']));
  $second_driver_registration = ucwords(mysqli_real_escape_string($conn, $_POST['second_driver_registration']));


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

  }


  $sql = "INSERT INTO claim_form (reference, type_of_claim, policy_number, name, email, contact, identity, date_of_birth, age, gender, address, insured_vehicle, 
    insured_registration, location, province, date, prescription, third_party_name, third_party_contact, third_party_identity,
    third_party_vehicle, third_party_registration, second_driver_name, second_driver_contact, second_driver_identity,
    second_driver_vehicle, second_driver_registration, details) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = mysqli_prepare($conn, $sql);

  // Bind variables to the prepared statement
  mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssssssssssssssssssss",
    $reference,
    $type_of_claim,
    $policy_number,
    $name,
    $email,
    $contact,
    $identity,
    $date_of_birth,
    $age,
    $gender,
    $address,
    $insured_vehicle,
    $insured_registration,
    $location,
    $province,
    $date,
    $prescription,
    $third_party_name,
    $third_party_contact,

    $third_party_identity,
    $third_party_vehicle,
    $third_party_registration,
    $second_driver_name,
    $second_driver_contact,

    $second_driver_identity,
    $second_driver_vehicle,
    $second_driver_registration,

    $details
  );


  // Execute the prepared statement
  mysqli_stmt_execute($stmt);
  //$image_path = '../11_Images/ACE_CLAIM_FORM_2.jpg';
  $image_path = '../11_Images/UNISON - LOGO.jpg';
  $image_data = file_get_contents($image_path);

  // Convert the image data to base64 format
  $image_base64 = base64_encode($image_data);

  // Embed the image in the HTML

  $html_template = file_get_contents('../16_insurance/claim_form_copy_select_3b.html');
  $html = str_replace('{name}', $name, $html_template);
  $html = str_replace('{policy_number}', $policy_number, $html);
  $html = str_replace('{email}', $email, $html);
  $html = str_replace('{contact}', $contact, $html);
  $html = str_replace('{identity}', $identity, $html);
  $html = str_replace('{address}', $address, $html);
  $html = str_replace('{insured_vehicle}', $insured_vehicle, $html);
  $html = str_replace('{insured_registration}', $insured_registration, $html);
  $html = str_replace('{location}', $location, $html);
  $html = str_replace('{province}', $province, $html);
  $html = str_replace('{date}', $date, $html);
  $html = str_replace('{third_party_name}', $third_party_name, $html);
  $html = str_replace('{third_party_contact}', $third_party_contact, $html);

  $html = str_replace('{third_party_identity}', $third_party_identity, $html);
  $html = str_replace('{third_party_vehicle}', $third_party_vehicle, $html);
  $html = str_replace('{third_party_registration}', $third_party_registration, $html);

  $html = str_replace('{second_driver_name}', $second_driver_name, $html);
  $html = str_replace('{second_driver_contact}', $second_driver_contact, $html);

  $html = str_replace('{second_driver_identity}', $second_driver_identity, $html);
  $html = str_replace('{second_driver_vehicle}', $second_driver_vehicle, $html);
  $html = str_replace('{second_driver_registration}', $second_driver_registration, $html);
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
  //$mail->addAttachment('../11_Images/AI-LOGO.png', 'logo.png');
  $mail->addStringAttachment($pdf_content, 'Claim Form.pdf', 'base64', 'application/pdf');

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Claim Form - Reference: ' . $reference;
  $mail->Body    = '
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Orbitron" />
  <div id="container" style="max-width: 400px; width: 100%; margin: 0 auto; background-color: #fff; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3); overflow-x: hidden; overflow-y: auto; max-height: 600px; padding: 20px;">
  <div class="logo" style="width: 111px; height: 94px; padding: 10px; font-size: 87px; background-color: #151A7B; box-shadow: 0 0 0 3px white, 0 0 0 6px #151A7B; border-radius: 20px; color: white; font-family: Orbitron; font-size: 87px; font-weight: bold; height: 102px; padding: 10px; padding-top: 5px; text-align: center; width: 111px; margin: 0 auto;">AI</div>
  <br>
      <h1 style="font-size: 28px; margin-top: 0; color: #0074d9; text-align: center;">We have received your claim!</h1>
      <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">Dear ' . $name_for_email . ',</p>
      <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">Kindly find attached hereto the completed Claim Form.</p> 
      <p style="font-size: 18px; margin-bottom: 20px; color: #333; text-align: center;">Please sign the attached Claim Form and email a copy to: email@something.com.</p>
      <p style="font-size: 18px; margin-bottom: 20px; color: #0074d9; text-align: center;"><strong> * Your reference number is: ' . $reference . ' *</strong></p>
  </div>';

  $mail->send();

  /*  #logo {
          display: flex;
          justify-content: center;
          align-items: center;
        
          margin-left: 310px;
          margin-right: auto;
        } 
    <div id="logo">
        <img src="cid:logo.png">
    </div>
        */

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
            <li><strong>Policy number:</strong> $policy_number </li>
            <li><strong>Insured:</strong> $name </li>
            <li><strong>Email:</strong> $email </li>
            <li><strong>Location of incident:</strong> $location</li>
            <li><strong>Province:</strong> $province</li>
            <li><strong>Date of incident:</strong> $date</li>
            <li><strong><span style='color:red'>Date of Prescription: $prescription</span></strong> </li>
            <li><strong>Details:</strong> $details</li>
            <li><strong>First Third Party:</strong> $third_party_name</li>
            <li><strong>Second Third Party:</strong> $second_driver_name</li>
            
            
          </ul>
        </body>
      </html>";

  $mail1->send();
}

if ($driverselection == "2" && $third_parties == "1") {

  $name = ucwords(mysqli_real_escape_string($conn, $_POST['name']));
  $name = stripslashes($name);
  $name_for_email = $name = ucwords(strtolower(mysqli_real_escape_string($conn, $_POST['name'])));
  $name_for_email = stripslashes($name_for_email);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $identity = mysqli_real_escape_string($conn, $_POST['identity']);

  $date_of_birth = substr($identity, 0, 6); // Extract the first 6 characters
  $day = substr($date_of_birth, 4, 2);
  $month = substr($date_of_birth, 2, 2);
  $year_prefix = (substr($date_of_birth, 0, 2) <= 30) ? '20' : '19';
  $year = $year_prefix . substr($date_of_birth, 0, 2);
  $formatted_date_of_birth = $day . ' ' . date("F", mktime(0, 0, 0, $month, 1)) . ' ' . $year; // Format the date of birth as "12 December 2022"
  $date_of_birth = $formatted_date_of_birth;
  // Extracting gender
  $gender_digits = substr($identity, 6, 4); // Extract the 7th to 10th characters
  $gender = ($gender_digits >= 0 && $gender_digits <= 4999) ? 'Female' : 'Male'; // Determine gender based on assigned number range

  /* Extracting SA citizen status
  $citizen_status = substr($identity, 10, 1); // Extract the 11th character
  $citizen = ($citizen_status == 0) ? 'SA Citizen' : 'Permanent Resident'; // Determine SA citizen status based on the assigned digit

  // Extracting the checksum digit (Z)
  $checksum_digit = substr($identity, -1); Extract the last character */

  // Calculating current age
  $current_year = date('Y'); // Get the current year
  $age = $current_year - $year;
  $type_of_claim = "2d1t";
  $policy_number = mysqli_real_escape_string($conn, $_POST['policy_number']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $address = stripslashes($address);
  $insured_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['insured_vehicle']));
  $insured_vehicle = stripslashes($insured_vehicle);
  $insured_registration = ucwords(mysqli_real_escape_string($conn, $_POST['insured_registration']));
  $location = ucwords(mysqli_real_escape_string($conn, $_POST['location']));
  $location = stripslashes($location);
  $province = ucwords(mysqli_real_escape_string($conn, $_POST['province']));
  $date = (mysqli_real_escape_string($conn, $_POST['date']));
  $driver = ucwords(mysqli_real_escape_string($conn, $_POST['insured_driver']));
  $driver = stripslashes($driver);
  $driver_identity = mysqli_real_escape_string($conn, $_POST['insured_driver_identity']);
  $driver_contact = ucwords(mysqli_real_escape_string($conn, $_POST['insured_driver_contact']));
  $driver_address = ucwords(mysqli_real_escape_string($conn, $_POST['insured_driver_address']));
  $driver_address = stripslashes($driver_address);
  $third_party_name = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_name']));
  $third_party_name = stripslashes($third_party_name);
  $third_party_contact = mysqli_real_escape_string($conn, $_POST['third_party_contact']);

  $third_party_identity = mysqli_real_escape_string($conn, $_POST['third_party_identity']);
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
  $sql = "INSERT INTO claim_form (reference, type_of_claim, policy_number, name, email, contact, identity, date_of_birth, age, gender, address, insured_vehicle, 
    insured_registration, driver, driver_identity, driver_contact, driver_address, location, province, date, prescription, 
    third_party_name, third_party_contact, third_party_address, third_party_identity, third_party_vehicle, 
    third_party_registration, details) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = mysqli_prepare($conn, $sql);

  // Bind variables to the prepared statement
  mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssssssssssssssssssss",
    $reference,
    $type_of_claim,
    $policy_number,
    $name,
    $email,
    $contact,
    $identity,
    $date_of_birth,
    $age,
    $gender,
    $address,
    $insured_vehicle,
    $insured_registration,
    $driver,
    $driver_identity,
    $driver_contact,
    $driver_address,
    $location,
    $province,
    $date,
    $prescription,
    $third_party_name,
    $third_party_contact,
    $third_party_address,
    $third_party_identity,
    $third_party_vehicle,
    $third_party_registration,

    $details
  );


  // Execute the prepared statement
  mysqli_stmt_execute($stmt);
  //$image_path = '../11_Images/ACE_CLAIM_FORM_2.jpg';
  $image_path = '../11_Images/UNISON - LOGO.jpg';
  $image_data = file_get_contents($image_path);

  // Convert the image data to base64 format
  $image_base64 = base64_encode($image_data);

  // Embed the image in the HTML

  $html_template = file_get_contents('../16_insurance/claim_form_copy_select_3c.html');
  $html = str_replace('{name}', $name, $html_template);
  $html = str_replace('{policy_number}', $policy_number, $html);
  $html = str_replace('{email}', $email, $html);
  $html = str_replace('{contact}', $contact, $html);
  $html = str_replace('{identity}', $identity, $html);
  $html = str_replace('{address}', $address, $html);
  $html = str_replace('{insured_vehicle}', $insured_vehicle, $html);
  $html = str_replace('{insured_registration}', $insured_registration, $html);
  $html = str_replace('{location}', $location, $html);
  $html = str_replace('{province}', $province, $html);
  $html = str_replace('{date}', $date, $html);

  $html = str_replace('{driver}', $driver, $html);
  $html = str_replace('{driver_identity}', $driver_identity, $html);
  $html = str_replace('{driver_contact}', $driver_contact, $html);
  $html = str_replace('{driver_address}', $driver_address, $html);

  $html = str_replace('{third_party_name}', $third_party_name, $html);
  $html = str_replace('{third_party_contact}', $third_party_contact, $html);
  $html = str_replace('{third_party_address}', $third_party_address, $html);
  $html = str_replace('{third_party_identity}', $third_party_identity, $html);
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
  $mail->addAddress('lloyd@solicitors.co.za', '');
  // Attach PDF file
  //$mail->addAttachment('../11_Images/AI-LOGO.png', 'logo.png');
  $mail->addStringAttachment($pdf_content, 'Claim Form.pdf', 'base64', 'application/pdf');

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Claim Form - Reference: ' . $reference;
  $mail->Body    = '
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

  /*   
    
        #logo {
          display: flex;
          justify-content: center;
          align-items: center;
        
          margin-left: 310px;
          margin-right: auto;
        } 
        div id="logo">
        <img src="cid:logo.png">
    </div>
        */

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
            <li><strong>Insured:</strong> $name </li>
            <li><strong>Email:</strong> $email </li>
             <li><strong>Location of incident:</strong> $location</li>
             <li><strong>Province:</strong> $province</li>
            <li><strong>Date of incident:</strong> $date</li>
            <li><strong><span style='color:red'>Date of Prescription: $prescription</span></strong> </li>
            <li><strong>Details:</strong> $details</li>
            <li><strong>Third Party:</strong> $third_party_name</li>
            <li><strong>Third Party's ID:</strong> $third_party_identity</li>
          </ul>
        </body>
      </html>";

  $mail1->send();
}

if ($driverselection == "2" && $third_parties == "2") {

  $name = ucwords(mysqli_real_escape_string($conn, $_POST['name']));
  $name = stripslashes($name);
  $name_for_email = $name = ucwords(strtolower(mysqli_real_escape_string($conn, $_POST['name'])));
  $name_for_email = stripslashes($name_for_email);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $identity = mysqli_real_escape_string($conn, $_POST['identity']);
  $date_of_birth = substr($identity, 0, 6); // Extract the first 6 characters
  $day = substr($date_of_birth, 4, 2);
  $month = substr($date_of_birth, 2, 2);
  $year_prefix = (substr($date_of_birth, 0, 2) <= 30) ? '20' : '19';
  $year = $year_prefix . substr($date_of_birth, 0, 2);
  $formatted_date_of_birth = $day . ' ' . date("F", mktime(0, 0, 0, $month, 1)) . ' ' . $year; // Format the date of birth as "12 December 2022"
  $date_of_birth = $formatted_date_of_birth;
  // Extracting gender
  $gender_digits = substr($identity, 6, 4); // Extract the 7th to 10th characters
  $gender = ($gender_digits >= 0 && $gender_digits <= 4999) ? 'Female' : 'Male'; // Determine gender based on assigned number range

  /* Extracting SA citizen status
  $citizen_status = substr($identity, 10, 1); // Extract the 11th character
  $citizen = ($citizen_status == 0) ? 'SA Citizen' : 'Permanent Resident'; // Determine SA citizen status based on the assigned digit

  // Extracting the checksum digit (Z)
  $checksum_digit = substr($identity, -1); Extract the last character */

  // Calculating current age
  $current_year = date('Y'); // Get the current year
  $age = $current_year - $year;

  $type_of_claim = "2d2t";
  $policy_number = mysqli_real_escape_string($conn, $_POST['policy_number']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $address = stripslashes($address);
  $insured_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['insured_vehicle']));
  $insured_vehicle = stripslashes($insured_vehicle);
  $insured_registration = ucwords(mysqli_real_escape_string($conn, $_POST['insured_registration']));
  $location = ucwords(mysqli_real_escape_string($conn, $_POST['location']));
  $province = ucwords(mysqli_real_escape_string($conn, $_POST['province']));
  $location = stripslashes($location);
  $date = (mysqli_real_escape_string($conn, $_POST['date']));

  $driver = ucwords(mysqli_real_escape_string($conn, $_POST['insured_driver']));
  $driver = stripslashes($driver);
  $driver_identity = mysqli_real_escape_string($conn, $_POST['insured_driver_identity']);
  $driver_contact = ucwords(mysqli_real_escape_string($conn, $_POST['insured_driver_contact']));
  $driver_address = ucwords(mysqli_real_escape_string($conn, $_POST['insured_driver_address']));
  $driver_address = stripslashes($driver_address);

  $third_party_name = ucwords(mysqli_real_escape_string($conn, $_POST['first_driver_name']));
  $third_party_name = stripslashes($third_party_name);
  $third_party_contact = mysqli_real_escape_string($conn, $_POST['first_driver_contact']);
  $third_party_identity = mysqli_real_escape_string($conn, $_POST['first_driver_identity']);
  $third_party_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['first_driver_vehicle']));
  $third_party_vehicle = stripslashes($third_party_vehicle);
  $third_party_registration = ucwords(mysqli_real_escape_string($conn, $_POST['first_driver_registration']));
  $second_driver_name = ucwords(mysqli_real_escape_string($conn, $_POST['second_driver_name']));

  $second_driver_name = stripslashes($second_driver_name);
  $second_driver_contact = mysqli_real_escape_string($conn, $_POST['second_driver_contact']);
  $second_driver_identity = mysqli_real_escape_string($conn, $_POST['second_driver_identity']);
  $second_driver_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['second_driver_vehicle']));
  $second_driver_registration = ucwords(mysqli_real_escape_string($conn, $_POST['second_driver_registration']));


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
  $sql = "INSERT INTO claim_form (reference, type_of_claim , policy_number, name, email, contact, identity, date_of_birth, age, gender, address, insured_vehicle, 
    insured_registration, location, province, date, prescription, driver, driver_identity, driver_contact, driver_address,
    third_party_name, third_party_contact, third_party_identity, third_party_vehicle, third_party_registration, 
    second_driver_name, second_driver_contact, second_driver_identity, second_driver_vehicle, 
    second_driver_registration, details) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = mysqli_prepare($conn, $sql);

  // Bind variables to the prepared statement
  mysqli_stmt_bind_param(
    $stmt,
    "ssssssssssssssssssssssssssssssss",
    $reference,
    $type_of_claim,
    $policy_number,
    $name,
    $email,
    $contact,
    $identity,
    $date_of_birth,
    $age,
    $gender,
    $address,
    $insured_vehicle,
    $insured_registration,
    $location,
    $province,
    $date,
    $prescription,

    $driver,
    $driver_identity,
    $driver_contact,
    $driver_address,

    $third_party_name,
    $third_party_contact,

    $third_party_identity,
    $third_party_vehicle,
    $third_party_registration,
    $second_driver_name,
    $second_driver_contact,

    $second_driver_identity,
    $second_driver_vehicle,
    $second_driver_registration,

    $details
  );


  // Execute the prepared statement
  mysqli_stmt_execute($stmt);
  //$image_path = '../11_Images/ACE_CLAIM_FORM_2.jpg';
  $image_path = '../11_Images/UNISON - LOGO.jpg';
  $image_data = file_get_contents($image_path);

  // Convert the image data to base64 format
  $image_base64 = base64_encode($image_data);

  // Embed the image in the HTML

  $html_template = file_get_contents('../16_insurance/claim_form_copy_select_3d.html');
  $html = str_replace('{name}', $name, $html_template);
  $html = str_replace('{policy_number}', $policy_number, $html);
  $html = str_replace('{email}', $email, $html);
  $html = str_replace('{contact}', $contact, $html);
  $html = str_replace('{identity}', $identity, $html);
  $html = str_replace('{address}', $address, $html);
  $html = str_replace('{insured_vehicle}', $insured_vehicle, $html);
  $html = str_replace('{insured_registration}', $insured_registration, $html);
  $html = str_replace('{location}', $location, $html);
  $html = str_replace('{province}', $province, $html);
  $html = str_replace('{date}', $date, $html);

  $html = str_replace('{driver}', $driver, $html);
  $html = str_replace('{driver_identity}', $driver_identity, $html);
  $html = str_replace('{driver_contact}', $driver_contact, $html);
  $html = str_replace('{driver_address}', $driver_address, $html);

  $html = str_replace('{third_party_name}', $third_party_name, $html);
  $html = str_replace('{third_party_contact}', $third_party_contact, $html);
  $html = str_replace('{third_party_identity}', $third_party_identity, $html);
  $html = str_replace('{third_party_vehicle}', $third_party_vehicle, $html);
  $html = str_replace('{third_party_registration}', $third_party_registration, $html);

  $html = str_replace('{second_driver_name}', $second_driver_name, $html);
  $html = str_replace('{second_driver_contact}', $second_driver_contact, $html);
  $html = str_replace('{second_driver_identity}', $second_driver_identity, $html);
  $html = str_replace('{second_driver_vehicle}', $second_driver_vehicle, $html);
  $html = str_replace('{second_driver_registration}', $second_driver_registration, $html);

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
  //$mail->addAttachment('../11_Images/AI-LOGO.png', 'logo.png');
  $mail->addStringAttachment($pdf_content, 'Claim Form.pdf', 'base64', 'application/pdf');

  // Content
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->Subject = 'Claim Form - Reference: ' . $reference;
  $mail->Body    = '
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

  /*          #logo {
          display: flex;
          justify-content: center;
          align-items: center;
        
          margin-left: 310px;
          margin-right: auto;
        } 
<div id="logo">
        <img src="cid:logo.png">
    </div>
        */

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
            <li><strong>Policy number:</strong> $policy_number </li>
            <li><strong>Insured:</strong> $name </li>
            <li><strong>Email:</strong> $email </li>
            <li><strong>Location of incident:</strong> $location</li>
            <li><strong>Province:</strong> $province</li>
            <li><strong>Date of incident:</strong> $date</li>
            <li><strong><span style='color:red'>Date of Prescription: $prescription</span></strong> </li>
            <li><strong>Details:</strong> $details</li>
            <li><strong>First Third Party:</strong> $third_party_name</li>
            <li><strong>Second Third Party:</strong> $second_driver_name</li>
            
            
          </ul>
        </body>
      </html>";

  $mail1->send();
}

?>

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
    <div class="logo">SI</div>
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