<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["document"])) {
    $targetDirectory = "C:\\Users\\Lloyd\\Mellows & de Swardt Inc\\Shared Data - User data\\Lloyd\\TEST FOLDER\\";

    // Get the reference number from the submitted form
    $referenceNumber = "Test";

    // Create the subfolder using the reference number
    $subfolderPath = $targetDirectory . $referenceNumber . "/";
    if (!is_dir($subfolderPath)) {
        mkdir($subfolderPath, 0777, true);
    }

    $targetFile = $subfolderPath . basename($_FILES["document"]["name"]);

    // Check if the file is a valid document
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (!in_array($fileType, ["pdf", "doc", "docx", "jpg", "jpeg", "png"])) {
        echo "Only PDF, DOC, DOCX, JPG, JPEG, and PNG files are allowed.";
        exit;
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["document"]["tmp_name"], $targetFile)) {
        echo "Document uploaded successfully.";
    } else {
        echo "Error uploading the document.";
    }
}
