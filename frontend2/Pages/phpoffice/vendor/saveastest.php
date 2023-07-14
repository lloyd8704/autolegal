<?php
ob_start();

require_once '../vendor/autoload.php';

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("template1.docx");

$templateProcessor->setValues(
    [
        'recipient' => 'success',

    ]
);
$pathToSave = "Test.docx";
$templateProcessor->saveAs($pathToSave);

header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename="Test.docx";');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');

ob_end_clean();
