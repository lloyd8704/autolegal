
<?php

require_once "autoload.php";

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("template1.docx");
$variable1 = strtoupper("apple / brown");
$templateProcessor->setValue('firstname', 'Bruce');
$templateProcessor->setValue('lastname', $variable1);

$pathToSave = "Z:\Shared Data - USERS\Lloyd\Document1.docx";
$templateProcessor->saveAs($pathToSave);
