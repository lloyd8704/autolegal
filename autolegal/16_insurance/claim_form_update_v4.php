<?php

use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;

session_start();

// Connect to the database
include "../16_insurance/db_connection.php";

$type_of_claim = $_POST['type_of_claim'];

if ($type_of_claim == "1d1t") {

  // Retrieve form data and sanitize
  $name = ucwords(mysqli_real_escape_string($conn, $_POST['name']));
  $name = stripslashes($name);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $identity = mysqli_real_escape_string($conn, $_POST['identity']);
  $policy_number = mysqli_real_escape_string($conn, $_POST['policy_number']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $address = stripslashes($address);
  $insured_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['insured_vehicle']));
  $insured_vehicle = stripslashes($insured_vehicle);
  $insured_registration = ucwords(mysqli_real_escape_string($conn, $_POST['insured_registration']));
  $location = ucwords(mysqli_real_escape_string($conn, $_POST['location']));
  $location = stripslashes($location);
  $date = (mysqli_real_escape_string($conn, $_POST['date']));
  $third_party_name = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_name']));
  $third_party_name = stripslashes($third_party_name);
  $third_party_contact = mysqli_real_escape_string($conn, $_POST['third_party_contact']);
  $third_party_identity = mysqli_real_escape_string($conn, $_POST['third_party_identity']);
  $third_party_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_vehicle']));
  $third_party_vehicle = stripslashes($third_party_vehicle);
  $third_party_registration = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_registration']));
  $details = str_replace("\\r\\n", "\n", $_POST['details']);

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
  $sql = "UPDATE claim_form SET reference = '$reference', name = '$name', identity = '$identity', email = '$email', 
  contact = '$contact', address = '$address', policy_number = '$policy_number', date = '$date', location = '$location', 
  details = '$details', insured_vehicle = '$insured_vehicle', insured_registration = '$insured_registration',
  third_party_name = '$third_party_name', third_party_contact = '$third_party_contact', third_party_identity = '$third_party_identity', 
  third_party_vehicle = '$third_party_vehicle', third_party_registration = '$third_party_registration', prescription = '$prescription'
  WHERE reference= '$reference'";


  if ($conn->query($sql) === TRUE) {
    header("Location: claim_form_update_v5.php");
  } else {
    //msg if error
    echo "Error updating record: " . $conn->error;
  }
}
if ($type_of_claim == "1d2t") {

  // Retrieve form data and sanitize

  $name = ucwords(mysqli_real_escape_string($conn, $_POST['name']));
  $name = stripslashes($name);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $identity = mysqli_real_escape_string($conn, $_POST['identity']);
  $type_of_claim = "1d2t";
  $policy_number = mysqli_real_escape_string($conn, $_POST['policy_number']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $address = stripslashes($address);
  $insured_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['insured_vehicle']));
  $insured_vehicle = stripslashes($insured_vehicle);
  $insured_registration = ucwords(mysqli_real_escape_string($conn, $_POST['insured_registration']));
  $location = ucwords(mysqli_real_escape_string($conn, $_POST['location']));
  $location = stripslashes($location);
  $date = (mysqli_real_escape_string($conn, $_POST['date']));
  $third_party_name = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_name']));
  $third_party_name = stripslashes($third_party_name);
  $third_party_contact = mysqli_real_escape_string($conn, $_POST['third_party_contact']);

  $third_party_identity = mysqli_real_escape_string($conn, $_POST['third_party_identity']);
  $third_party_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_vehicle']));
  $third_party_vehicle = stripslashes($third_party_vehicle);
  $third_party_registration = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_registration']));
  $second_driver_name = ucwords(mysqli_real_escape_string($conn, $_POST['second_driver_name']));
  $second_driver_name = stripslashes($second_driver_name);
  $second_driver_contact = mysqli_real_escape_string($conn, $_POST['second_driver_contact']);

  $second_driver_identity = mysqli_real_escape_string($conn, $_POST['second_driver_identity']);
  $second_driver_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['second_driver_vehicle']));
  $second_driver_registration = ucwords(mysqli_real_escape_string($conn, $_POST['second_driver_registration']));


  $details = str_replace("\\r\\n", "\n", $_POST['details']);

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
  $sql = "UPDATE claim_form SET reference = '$reference',
policy_number = '$policy_number', name = '$name', email = '$email', contact = '$contact', 
identity = '$identity', address = '$address', insured_vehicle = '$insured_vehicle', location = '$location', 
date = '$date', details = '$details', prescription = '$prescription', insured_registration = '$insured_registration',
third_party_name = '$third_party_name', third_party_contact = '$third_party_contact', 
third_party_address = '$third_party_address', third_party_identity = '$third_party_identity', 
third_party_vehicle = '$third_party_vehicle', third_party_registration = '$third_party_registration', 
second_driver_name = '$second_driver_name', second_driver_contact = '$second_driver_contact', 
second_driver_identity = '$second_driver_identity', second_driver_vehicle = '$second_driver_vehicle', 
second_driver_registration = '$second_driver_registration'
WHERE reference= '$reference'";

  if ($conn->query($sql) === TRUE) {
    header("Location: claim_form_update_v5.php");
  } else {
    //msg if error
    echo "Error updating record: " . $conn->error;
  }
}
if ($type_of_claim == "2d1t") {

  // Retrieve form data and sanitize

  $name = ucwords(mysqli_real_escape_string($conn, $_POST['name']));
  $name = stripslashes($name);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $identity = mysqli_real_escape_string($conn, $_POST['identity']);
  $type_of_claim = "2d1t";
  $policy_number = mysqli_real_escape_string($conn, $_POST['policy_number']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $address = stripslashes($address);
  $insured_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['insured_vehicle']));
  $insured_vehicle = stripslashes($insured_vehicle);
  $insured_registration = ucwords(mysqli_real_escape_string($conn, $_POST['insured_registration']));
  $location = ucwords(mysqli_real_escape_string($conn, $_POST['location']));
  $location = stripslashes($location);
  $date = (mysqli_real_escape_string($conn, $_POST['date']));
  $driver = ucwords(mysqli_real_escape_string($conn, $_POST['driver']));
  $driver = stripslashes($driver);
  $driver_identity = mysqli_real_escape_string($conn, $_POST['driver_identity']);
  $driver_contact = ucwords(mysqli_real_escape_string($conn, $_POST['driver_contact']));
  $driver_address = ucwords(mysqli_real_escape_string($conn, $_POST['driver_address']));
  $driver_address = stripslashes($driver_address);
  $third_party_name = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_name']));
  $third_party_name = stripslashes($third_party_name);
  $third_party_contact = mysqli_real_escape_string($conn, $_POST['third_party_contact']);

  $third_party_identity = mysqli_real_escape_string($conn, $_POST['third_party_identity']);
  $third_party_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_vehicle']));
  $third_party_vehicle = stripslashes($third_party_vehicle);
  $third_party_registration = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_registration']));


  $details = str_replace("\\r\\n", "\n", $_POST['details']);

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
  $sql = "UPDATE claim_form SET reference = '$reference',
policy_number = '$policy_number', name = '$name', email = '$email', contact = '$contact', 
identity = '$identity', address = '$address', insured_vehicle = '$insured_vehicle', location = '$location', 
date = '$date', details = '$details', prescription = '$prescription', insured_registration = '$insured_registration',
driver = '$driver', driver_identity = '$driver_identity', driver_contact = '$driver_contact',  
third_party_name = '$third_party_name', third_party_contact = '$third_party_contact', 
third_party_identity = '$third_party_identity', third_party_vehicle = '$third_party_vehicle', 
third_party_registration = '$third_party_registration'
WHERE reference= '$reference'";

  if ($conn->query($sql) === TRUE) {
    header("Location: claim_form_update_v5.php");
  } else {
    //msg if error
    echo "Error updating record: " . $conn->error;
  }
}
if ($type_of_claim == "2d2t") {

  // Retrieve form data and sanitize

  $name = ucwords(mysqli_real_escape_string($conn, $_POST['name']));
  $name = stripslashes($name);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $identity = mysqli_real_escape_string($conn, $_POST['identity']);
  $type_of_claim = "2d2t";
  $policy_number = mysqli_real_escape_string($conn, $_POST['policy_number']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $address = stripslashes($address);
  $insured_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['insured_vehicle']));
  $insured_vehicle = stripslashes($insured_vehicle);
  $insured_registration = ucwords(mysqli_real_escape_string($conn, $_POST['insured_registration']));
  $location = ucwords(mysqli_real_escape_string($conn, $_POST['location']));
  $location = stripslashes($location);
  $date = (mysqli_real_escape_string($conn, $_POST['date']));
  $driver = ucwords(mysqli_real_escape_string($conn, $_POST['driver']));
  $driver = stripslashes($driver);
  $driver_identity = mysqli_real_escape_string($conn, $_POST['driver_identity']);
  $driver_contact = ucwords(mysqli_real_escape_string($conn, $_POST['driver_contact']));
  $driver_address = ucwords(mysqli_real_escape_string($conn, $_POST['driver_address']));
  $driver_address = stripslashes($driver_address);
  $third_party_name = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_name']));
  $third_party_name = stripslashes($third_party_name);
  $third_party_contact = mysqli_real_escape_string($conn, $_POST['third_party_contact']);

  $third_party_identity = mysqli_real_escape_string($conn, $_POST['third_party_identity']);
  $third_party_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_vehicle']));
  $third_party_vehicle = stripslashes($third_party_vehicle);
  $third_party_registration = ucwords(mysqli_real_escape_string($conn, $_POST['third_party_registration']));

  $second_driver_name = ucwords(mysqli_real_escape_string($conn, $_POST['second_driver_name']));
  $second_driver_name = stripslashes($second_driver_name);
  $second_driver_contact = mysqli_real_escape_string($conn, $_POST['second_driver_contact']);

  $second_driver_identity = mysqli_real_escape_string($conn, $_POST['second_driver_identity']);
  $second_driver_vehicle = ucwords(mysqli_real_escape_string($conn, $_POST['second_driver_vehicle']));
  $second_driver_registration = ucwords(mysqli_real_escape_string($conn, $_POST['second_driver_registration']));

  $details = str_replace("\\r\\n", "\n", $_POST['details']);

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
  $sql = "UPDATE claim_form SET reference = '$reference',
policy_number = '$policy_number', name = '$name', email = '$email', contact = '$contact', 
identity = '$identity', address = '$address', insured_vehicle = '$insured_vehicle', location = '$location', 
date = '$date', details = '$details', prescription = '$prescription', insured_registration = '$insured_registration',
driver = '$driver', driver_identity = '$driver_identity', driver_contact = '$driver_contact',  
third_party_name = '$third_party_name', third_party_contact = '$third_party_contact', 
third_party_identity = '$third_party_identity', third_party_vehicle = '$third_party_vehicle', 
third_party_registration = '$third_party_registration', second_driver_name = '$second_driver_name', 
second_driver_contact = '$second_driver_contact', second_driver_identity = '$second_driver_identity',
second_driver_vehicle = '$second_driver_vehicle', second_driver_registration = '$second_driver_registration'
WHERE reference= '$reference'";

  if ($conn->query($sql) === TRUE) {
    header("Location: claim_form_update_v5.php");
  } else {
    //msg if error
    echo "Error updating record: " . $conn->error;
  }
}
