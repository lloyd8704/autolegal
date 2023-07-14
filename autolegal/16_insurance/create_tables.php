<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "correspdb";

// CREATE CONNECTION
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $databasename,
);

// GET CONNECTION ERRORS
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL QUERY
$test = 'ACE ENG 5/2023';
$query = "SELECT * FROM `collision_reports` WHERE reference='$test'";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    require_once "../10_Database/phpoffice/vendor/autoload.php";
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {
        $insured = strtoupper($row["name"]);
        $ourref = $row["reference"];
        $dateOfCollision = date('d F Y', strtotime($row["date"]));
        $savename = date('Y-m-d') . "- AOL - " . $ourref;

        // Create a new PhpWord TemplateProcessor object from the template file
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("../10_Database/phpoffice/vendor/MSC/AOL.docx");
        $templateProcessor->setValue('insured', $insured);
        $templateProcessor->setValue('our_reference', $ourref);
        $templateProcessor->setValue('date_of_collision', $dateOfCollision);

        // Get the input field values from the $_POST data
        $inputValues = array();
        for ($i = 1; $i <= $_POST['numInputs']; $i++) {
            if (isset($_POST['input' . $i])) {
                $inputValues[] = $_POST['input' . $i];
            }
        }

        // Replace the <<INPUT_FIELD>> placeholder in the template with the input values
        $tableRows = '';
        if (!empty($inputValues)) {
            $tableRows .= '<w:p><w:pPr><w:jc w:val="center"/></w:pPr></w:p>'; // Centered paragraph before table
            $tableRows .= '<w:tbl>';
            $tableRows .= '<w:tblPr><w:tblBorders><w:top w:val="single" w:sz="4" w:space="0" w:color="auto"/><w:left w:val="single" w:sz="4" w:space="0" w:color="auto"/><w:bottom w:val="single" w:sz="4" w:space="0" w:color="auto"/><w:right w:val="single" w:sz="4" w:space="0" w:color="auto"/><w:insideH w:val="single" w:sz="4" w:space="0" w:color="auto"/><w:insideV w:val="single" w:sz="4" w:space="0" w:color="auto"/></w:tblBorders><w:tblW w:w="5000" w:type="dxa"/><w:jc w:val="center"/></w:tblPr>';
            foreach ($inputValues as $value) {
                $tableRows .= '<w:tr><w:tc><w:tcPr><w:tcBorders><w:top w:val="single" w:sz="4" w:space="0" w:color="auto"/><w:left w:val="single" w:sz="4" w:space="0" w:color="auto"/><w:bottom w:val="single" w:sz="4" w:space="0" w:color="auto"/><w:right w:val="single" w:sz="4" w:space="0" w:color="auto"/></w:tcBorders></w:tcPr><w:p><w:r><w:t>' . $value . '</w:t></w:r></w:p></w:tc></w:tr>';
            }
            $tableRows .= '</w:tbl>';
            $tableRows .= '<w:p><w:pPr><w:jc w:val="center"/></w:pPr></w:p>'; // Centered paragraph after table
        }
        $templateProcessor->setValue('input', $tableRows);



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
