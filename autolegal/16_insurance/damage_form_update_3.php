<?php

use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;

session_start();

// Connect to the database
include "../16_insurance/db_connection.php";

// Retrieve form data and sanitize
$company_name = ucwords(mysqli_real_escape_string($conn, $_POST['company_name']));
$company_name = stripslashes($company_name);
$contact_name = ucwords(mysqli_real_escape_string($conn, $_POST['contact_name']));
$contact_name = stripslashes($contact_name);
$email = ucwords(mysqli_real_escape_string($conn, $_POST['email']));
$address = ucwords(mysqli_real_escape_string($conn, $_POST['address']));
$address = stripslashes($address);
$contact = ucwords(mysqli_real_escape_string($conn, $_POST['contact']));
$date = (mysqli_real_escape_string($conn, $_POST['date']));
$location = ucwords(mysqli_real_escape_string($conn, $_POST['location']));
$location = stripslashes($location);
$quantum = ucwords(mysqli_real_escape_string($conn, $_POST['quantum']));
$third_party_name = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_name']));
$third_party_name = stripslashes($third_party_name);
$third_party_contact = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_contact']));
$third_party_address = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_address']));
$third_party_address = stripslashes($third_party_address);
$third_party_email = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_email']));
$details = str_replace("\\r\\n", "\n", $_POST['details']);
$details = ucfirst($details);
$policy_number = ucwords(mysqli_real_escape_string($conn, $_POST['policy_number']));

$reference = $_SESSION['reference'];
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


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} //checking the number of attorneys

// Prepare SQL query to insert data into the table
$sql = "UPDATE damage_claim SET reference = '$reference', company_name = '$company_name', email = '$email', 
contact_name = '$contact_name', address = '$address', contact = '$contact', location = '$location', 
date = '$date', quantum = '$quantum', details = '$details', prescription = '$prescription', 
third_party_name = '$third_party_name', third_party_contact = '$third_party_contact',
third_party_address = '$third_party_address', third_party_email = '$third_party_email', 
policy_number = '$policy_number' WHERE reference= '$reference'";

if ($conn->query($sql) === TRUE) {
  header("Location: damage_form_update_4.php");
} else {
  //msg if error
  echo "Error updating record: " . $conn->error;
}
