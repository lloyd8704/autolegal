<?php
// Directory where uploaded documents are stored
$targetDirectory = "C:\\Users\\Lloyd\\Mellows & de Swardt Inc\\Shared Data - User data\\Lloyd\\TEST FOLDER\\";

// Get a list of files in the target directory
$files = scandir($targetDirectory);

// Remove the "." and ".." directories from the list
$files = array_diff($files, array(".", ".."));

// Display the list of documents
echo "<h2>Uploaded Documents</h2>";
echo "<ul>";
foreach ($files as $file) {
    $filePath = $targetDirectory . $file;
    if (is_file($filePath)) {
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        echo "<li>$fileName</li>";
    }
}
echo "</ul>";
