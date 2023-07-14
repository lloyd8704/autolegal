<?php
session_start();

// Connect to the database
include "../16_insurance/db_connection.php";

// SQL QUERY
$reference = $_POST['reference'];
$query = "SELECT * FROM `claim_form` WHERE reference='$reference'";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    require_once "../10_Database/phpoffice/vendor/autoload.php";
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {

        $insured = strtoupper($row["name"]);
        $ourref = $row["reference"];
        $dateOfCollision = date('d F Y', strtotime($row["date"]));
        $policy_number = $row["policy_number"];
        $nature_of_claim = "Motor Vehicle Collision";
        $savename = date('Y-m-d') . "- AOL - " . $ourref;

        // Create a new PhpWord TemplateProcessor object from the template file
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("../10_Database/phpoffice/vendor/MSC/AOL2.docx");
        $templateProcessor->setValue('insured', $insured);
        $templateProcessor->setValue('our_reference', $ourref);
        $templateProcessor->setValue('date_of_collision', $dateOfCollision);
        $templateProcessor->setValue('policy_number', $policy_number);
        $templateProcessor->setValue('nature_of_claim', $nature_of_claim);

        // Get the input field values from the $_POST data
        $inputValues = array();
        for ($i = 1; $i <= $_POST['numInputs']; $i++) {
            if (isset($_POST['input' . $i]) && isset($_POST['amount' . $i])) {
                $amount = str_replace(',', '', $_POST['amount' . $i]); // Remove commas from the input value
                $formattedAmount = number_format(abs($amount), 2, '.', ','); // Format the absolute value of the amount with commas
                $formattedAmount = ($amount < 0 ? '-' : '') . 'R' . $formattedAmount; // Add "-" and "R" based on the sign of the amount
                $inputValues[] = array(
                    'input' => ucfirst($_POST['input' . $i]),
                    'amount' => $formattedAmount
                );

                // Calculate the total amount
                $totalAmount += $amount;
            }
        }

        // Format the total amount with commas and add "R" before it
        $totalAmountFormatted = ($totalAmount < 0 ? '-' : '') . 'R' . number_format(abs($totalAmount), 2, '.', ',');

        // Add the total row to the input values array
        $inputValues[] = array(
            'input' => 'TOTAL',
            'amount' => $totalAmountFormatted
        );

        // Replace the placeholder in the template with the input values
        $tableRows = '';
        if (!empty($inputValues)) {
            $tableRows .= '<w:p><w:pPr><w:jc w:val="center"/></w:pPr></w:p>'; // Centered paragraph before table
            $tableRows .= '<w:tbl>';
            $tableRows .= '<w:tblPr><w:tblBorders><w:top w:val="single" w:sz="4" w:space="0" w:color="auto"/><w:left w:val="single" w:sz="4" 
            w:space="0" w:color="auto"/><w:bottom w:val="single" w:sz="4" w:space="0" w:color="auto"/><w:right w:val="single" w:sz="4" w:space="0" 
            w:color="auto"/><w:insideH w:val="single" w:sz="4" w:space="0" w:color="auto"/><w:insideV w:val="single" w:sz="4" w:space="0" w:color="auto"/>
            </w:tblBorders><w:tblW w:w="6000" w:type="dxa"/><w:jc w:val="center"/></w:tblPr>';
            foreach ($inputValues as $value) {
                $tableRows .= '<w:tr>';
                $tableRows .= '<w:tc><w:p><w:r><w:t>' . $value['input'] . '</w:t></w:r></w:p><w:tcPr><w:tcW w:w="70000" w:type="dxa"/>
                <w:shd w:val="clear" w:color="auto" w:fill="auto"/></w:tcPr><w:pPr><w:jc w:val="right"/></w:pPr></w:tc>';
                $tableRows .= '<w:tc><w:p><w:r><w:t>' . $value['amount'] . '</w:t></w:r></w:p></w:tc>';
                $tableRows .= '</w:tr>';
            }
            $tableRows .= '</w:tbl>';
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
