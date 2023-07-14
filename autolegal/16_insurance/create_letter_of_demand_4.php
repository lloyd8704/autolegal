<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, destroy session and redirect to login page
    session_destroy();
    header("Location: login.html");
    exit;
}

include "../16_insurance/db_connection.php";

// SQL QUERY
$selected_options = $_POST['selected_options'];
$quantum = $_POST['quantum'];

$response_date_unedited = $_POST['response_date'];
$response_date = date('d F Y', strtotime($response_date_unedited));
$third_party_name = $_POST['third_party_name'];
$third_party_email = $_POST['third_party_email'];
$test = $_POST['reference'];
$query = "SELECT * FROM `claim_form` WHERE reference='$test'";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    require_once "../10_Database/phpoffice/vendor/autoload.php";
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {
        $insured = $row["name"];
        $ourref = $row["reference"];
        $date = date('d F Y');
        $subject = $ourref . " - " . strtoupper($row["name"]);
        $location = $row["location"];
        $dateOfCollision = date('d F Y', strtotime($row["date"]));
        $placeOfCollision = $row['location'];

        $insured_vehicle = $row['insured_vehicle'];
        $insured_registration = $row['insured_registration'];


        $third_party_vehicle = $row['third_party_vehicle'];
        $third_party_registration = $row['third_party_registration'];


        $savename = date('Y-m-d') . "- LETTER OF DEMAND -  EMAIL";

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("../10_Database/phpoffice/vendor/MSC/Letter_of_demand.docx");
        $templateProcessor->setValue('insured', $insured);
        $templateProcessor->setValue('our_ref', $ourref);
        $templateProcessor->setValue('date', $date);
        $templateProcessor->setValue('subject', $subject);
        $templateProcessor->setValue('date_of_collision', $dateOfCollision);
        $templateProcessor->setValue('place_of_collision', $placeOfCollision);
        $templateProcessor->setValue('selected_options', $selected_options);

        $templateProcessor->setValue('insured_vehicle', $insured_vehicle);
        $templateProcessor->setValue('insured_registration', $insured_registration);
        $templateProcessor->setValue('third_party_name', $third_party_name);
        $templateProcessor->setValue('third_party_email', $third_party_email);
        $templateProcessor->setValue('third_party_vehicle', $third_party_vehicle);
        $templateProcessor->setValue('third_party_registration', $third_party_registration);

        $templateProcessor->setValue('amount', $quantum);
        $templateProcessor->setValue('due_date', $response_date);


        // Set the headers for the downloaded file
        header('Content-Type: application/msword');
        header('Content-Disposition: attachment; filename=' . $savename . '.docx');
        header('Content-Length: ' . filesize('php://output')); // set the content length header to the size of the generated document
        ob_end_clean(); // clear any output that may have already been generated
        // Save the document to output
        $templateProcessor->saveAs('php://output');
        exit(); // exit the script

    }
}


$conn->close();
