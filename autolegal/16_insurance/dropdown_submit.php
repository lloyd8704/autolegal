<?php



$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("../10_Database/phpoffice/vendor/MSC/Letter_of_demand.docx");
if (isset($_POST['submit'])) {
    $selected_cities = implode(', ', $_POST['city']);
    $templateProcessor->setValue('selected_cities', $selected_cities);

    $templateProcessor->saveAs('output.docx');
}
