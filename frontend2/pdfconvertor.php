<?php


require_once '../../playground/vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Spatie\PdfToText\Pdf;

if ($_FILES) {
    $pdfFile = $_FILES['pdfFile']['tmp_name'];

    if (!$pdfFile) {
        die("No file was uploaded.");
    }

    // Load the PDF file using the Spatie PDF-to-text library
    $pdfText = Pdf::getText($pdfFile);

    // Split the text by new line characters to create an array of paragraphs
    $paragraphs = explode("\n", $pdfText);

    // Create a new PHPWord object
    $phpWord = new PhpWord();

    // Add each paragraph as a new section with a new paragraph
    foreach ($paragraphs as $paragraph) {
        $section = $phpWord->addSection();
        $section->addText($paragraph);
    }

    // Save the Word document
    $fileName = pathinfo($_FILES['pdfFile']['name'], PATHINFO_FILENAME) . '.docx';
    $filePath = 'C:/Users/Lloyd/Desktop/' . $fileName;
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($filePath);

    // Open the converted Word document in Word
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: inline; filename="' . $fileName . '"');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
} else {
?>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="pdfFile" accept="application/pdf">
        <input type="submit" value="Convert to Word">
    </form>
<?php
}
