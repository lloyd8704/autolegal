</html>
<?php
session_start();

// Connect to the database
include "../16_insurance/db_connection.php";
require_once "../10_Database/phpoffice/vendor/autoload.php";

// SQL QUERY
$instructions = $_POST['instructions'];

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("../10_Database/phpoffice/vendor/MSC/Instructions.docx");

$templateProcessor->cloneBlock("instructions", 1);
$input1 = str_replace("\n", "<w:br />", $instructions);
$reference = $_POST["reference"];
$templateProcessor->setValue('reference', $reference);
$date = date('d F Y');
$templateProcessor->setValue('date', $date);

$savename = "LETTER OF INSTRUCTION";

$templateProcessor->setValue('instructions', $input1);

// Set the headers for the downloaded file
header('Content-Type: application/msword');
header('Content-Disposition: attachment; filename=' . $savename . '.docx');
header('Content-Length: ' . filesize('php://output')); // set the content length header to the size of the generated document
ob_end_clean(); // clear any output that may have already been generated
// Save the document to output
$templateProcessor->saveAs('php://output');
exit(); // exit the script




$conn->close();

?>