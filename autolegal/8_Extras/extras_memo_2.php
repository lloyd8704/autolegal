<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../9_Style/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
    <title>Extras</title>
</head>

<body>
    <div id="test">
        <nav>
            <div class="heading1">
                <h4>AutoLegal</h4>

                <body style="background-color: black">
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
                <li><a class="nav-link" href="../2_New_file/Index.php">New&nbspFile</a></li>
                <li><a class="nav-link" href="../3_Correspondence/Index.php">Correspondence</a></li>
                <li><a class="nav-link" href="../4_Pleadings/Index.php">Pleadings</a></li>
                <li><a class="nav-link" href="../5_Contacts/Index.php">Contacts</a></li>
                <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
                <li><a class="nav-link" href="../7_Edit/Index.php">Edit</a></li>
                <li><a class="nav-link active" id="plus" href="../8_Extras/Index.php">+</a></li>
            </ul>
        </nav>
</body>
</div>

</html>

<?php

require_once "../10_Database/phpoffice/vendor/autoload.php"; // Load PHPWord library


// Load the template document with placeholders


if (isset($_POST['submit'])) {
    $to = $_POST['to'];
    $recipient = strtoupper($to);
    $from = $_POST['from'];
    $file = $_POST['file'];
    $date = date('d F Y');
    $savedate = date('Y-m-d');
    $instructions = $_POST['instructions'];
    $test2 = "MSC//Memo.docx";

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("../10_Database/phpoffice/vendor/$test2");


    // Replace the placeholders in the document with the form input values
    $templateProcessor->setValue('to', $to);
    $templateProcessor->setValue('from', $from);
    $templateProcessor->setValue('subject', $file);
    $templateProcessor->setValue('date', $date);


    $templateProcessor->cloneBlock("instructions", 1);
    $input1 = str_replace("\n", "<w:br />", $instructions);
    $input2 = str_replace('&', '&amp;', $input1);
    $templateProcessor->setValue('instructions', $input2);

    $savename = $savedate . " " . $recipient . " - MEMO";
    // Set the headers for the downloaded file
    header('Content-Type: application/msword');
    header('Content-Disposition: attachment; filename=' . $savename . '.docx');
    header('Content-Length: ' . filesize('php://output')); // set the content length header to the size of the generated document
    ob_end_clean(); // clear any output that may have already been generated
    // Save the document to output
    $templateProcessor->saveAs('php://output');
    exit(); // exit the script

} else echo "<span class='error'><br>An error occurred.</span>";
?>