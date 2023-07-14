<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, destroy session and redirect to login page
    session_destroy();
    header("Location: login.html");
    exit;
}


// Connect to the database
include "../16_insurance/db_connection.php";

$reference = $_SESSION['reference'];
// Retrieve data from the database

$sql = "SELECT reference, company_name, email, contact_name, address, contact, date, prescription, location, 
quantum, third_party_name, third_party_contact, third_party_address, third_party_email, details,
policy_number FROM damage_claim WHERE reference='$reference'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $date = ($row['date']);
    $date_with_day = date('d-m-Y - l', strtotime($row['date'])); // format date with day of the week
    $prescription = date('d-m-Y - l', strtotime($row['prescription'])); // format date with day of the week
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

// Assume you have retrieved the row data from the database and stored it in $row variable
$reference = $row['reference'];
$policy_number = $row['policy_number'];
$company_name = $row['company_name'];
$email = $row['email'];
$contact_name = $row['contact_name'];
$address = $row['address'];
$contact = $row['contact'];

$location = $row['location'];
$quantum = $row['quantum'];
$third_party_name  = $row['third_party_name'];
$third_party_contact = $row['third_party_contact'];
$third_party_address = $row['third_party_address'];
$third_party_email = $row['third_party_email'];
$details = $row['details'];

// Define the email message body
$body = "Dear ________,\n\n" .
    "We set out hereunder the following relevant details in relation to the above-mentioned matter: \n\n" .
    "The insured: " . "$policy_number" . "\n" .
    "The insured: " . "$company_name" . "\n" .
    "The insured's address: " . "$address" . "\n\n" .
    "Date of collision: " . "$date_with_day" . "\n" .
    "Prescription: " . "$prescription" . "\n" .
    "Location of the Incident: " . "$location" . "\n" .
    "Details of the Incident: " . "$details" . "\n\n" .
    "The Third Party: " . "$third_party_name" . "\n" .
    "Third Party's address: " . "$third_party_address" . "\n\n" .
    "Your instructions are as follows:" . "\n\n" .
    "1. \n\n" .
    "Yours sincerely,";


// Encode the message body as a URL parameter
$body_param = rawurlencode($body);

// Define the email subject
$subject = "RE: CLAIM NUMBER: $reference - DOL: $date - " . strtoupper($company_name) . "/" . strtoupper($third_party_name);


// Encode the email subject as a URL parameter
$subject_param = rawurlencode($subject);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Send Email</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../16_insurance/style.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Aclonica' type='text/css' />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-A8XQHx7vzKgUyV7EMiO6M+jV6w10b6jFDM6UZjxvbez9iDwhNNlJy+BtysVcGj8+t1WZ91AeZqlgSY4zv4B9jA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../16_insurance/script.js"></script>
</head>
<ul>

    <body>
        <li><a href="../16_insurance/index.php">Home</a></li>
        <li><a href="view_claim_select.php">View</a></li>
        <li><a href="update_select.php">Update</a></li>
        <li><a class="active" href="send_email_select.php">Send</a></li>
        <li><a href="choice_of_letters.php">Draft</a></li>
        <li><a class="user" href="../16_insurance/logout_1.php">Welcome <?php echo ucfirst(strtolower($_SESSION['username'])); ?></a></li>
        <li>
            <a class="sign_out" href="../16_insurance/logout_2.php"><i class="fas fa-sign-out-alt"></i></a>
            <div class="tooltip">
                <p>Sign Out</p>
            </div>
        </li>
</ul>

<div class="container_reference">
    <div class="logo">AI</div>
    <form>
        <h2>Prepare email for: <br><br> <?php echo $reference . " - " . strtoupper($company_name) . " / " . strtoupper($third_party_name) ?></h2>
        <div class="button-container">
            <a href="mailto:?subject=<?php echo $subject_param; ?>&body=<?php echo $body_param; ?>" class="button">Send</a>
        </div>
</div>
</form>
<style>
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        width: 100%;
        height: 100vh;
        overflow: hidden;
    }



    .heading {
        margin-top: 20px;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
    }

    form {
        width: 500px;
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
    }


    .button-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin: 0 auto;
        border-radius: 2px;
        padding: 5px;
        flex-direction: row;
        width: 600px;
        margin-top: 20px;
    }

    .button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 22px;
        cursor: pointer;
        line-height: 30px;
        height: 30px;
    }

    .button:hover {
        background-color: #0062cc;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 30px;
        margin-top: 0px;
    }

    form {
        width: auto;
        height: auto;
        padding: 20px;
        border: 3px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
    }
</style>
</body>