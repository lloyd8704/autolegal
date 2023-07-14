<?php
// Get the reference number and uploaded file
$reference = $_POST['reference'];
$file = $_FILES['file'];

// Set up the email headers
$headers = "From: lloyd@solicitors.co.za\r\n";
$headers .= "Reply-To: lloyd@solicitors.co.za\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=boundary";

// Set up the email body
$body = "--boundary\r\n";
$body .= "Content-Type: text/plain; charset=us-ascii\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n";
$body .= "\r\n";
$body .= "Dear recipient,\r\n\r\n";
$body .= "Please find attached a file for your review.\r\n\r\n";
$body .= "Best regards,\r\n";
$body .= "Your Name\r\n";
$body .= "\r\n";
$body .= "--boundary\r\n";
$body .= "Content-Type: " . $file['type'] . "; name=\"" . $file['name'] . "\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n";
$body .= "Content-Disposition: attachment; filename=\"" . $file['name'] . "\"\r\n";
$body .= "\r\n";
$body .= chunk_split(base64_encode(file_get_contents($file['tmp_name'])));
$body .= "\r\n";
$body .= "--boundary--";

// Send the email
$to = "lloyd@solicitors.co.za";
$subject = "File attachment test";
mail($to, $subject, $body, $headers);

// Redirect the user to a confirmation page
header("Location: confirmation.php");
exit;
