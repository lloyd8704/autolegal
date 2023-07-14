<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../app.css" />
    <title>Create Letter</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../favicon.ico">
</head>
<div id="test">

    <body style="background-color: black">
        <navi>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../../../Index.html">Home</a></li>
                <li><a class="nav-link" href="../../newfile.html">New&nbspFile</a></li>
                <li><a class="nav-link active" href="../../correspondence.html">Correspondence</a></li>
                <li><a class="nav-link" href="../../pleadings.html">Pleadings</a></li>
                <li><a class="nav-link" href="../../contactshome.html">Contacts</a></li>
                <li><a class="nav-link" href="../../dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-link" href="../../edit.php">Edit</a></li>

            </ul>
        </navi>
    </body>
</div>

</html>
<?php

require_once 'autoload.php'; // Load PHPWord library


// Load the template document with placeholders


if (isset($_POST['submit'])) {
    $reference = strtoupper($_POST['reference']);
    $partyone = strtoupper($_POST['partyone']);
    $partytwo = strtoupper($_POST['partytwo']);
    $recipient = strtoupper($_POST['recipient']);

    $test2 = "MSC\\File_large.docx";
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("$test2");


    // Replace the placeholders in the document with the form input values
    $templateProcessor->setValue('ref', $reference);
    $templateProcessor->setValue('partyone', $partyone);
    $templateProcessor->setValue('partytwo', $partytwo);
    $templateProcessor->setValue('recipient', $recipient);

    $savename = $reference . " - Lever Arch";
    // Set the headers for the downloaded file
    header('Content-Type: application/msword');
    header('Content-Disposition: attachment; filename=' . $savename . '.docx');
    header('Content-Length: ' . filesize('php://output')); // set the content length header to the size of the generated document
    ob_end_clean(); // clear any output that may have already been generated
    // Save the document to output
    $templateProcessor->saveAs('php://output');
    exit(); // exit the script


    echo "<div><h2 class='heading3'> Your lever arch for <br><br> ''$reference''<br><br> was successfully created!</h2></div>";
} else echo "<span class='error'><br>An error occurred.</span>";
