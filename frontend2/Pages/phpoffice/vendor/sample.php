<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Import PHPWord library
require_once 'autoload.php';

// Create a new PHPWord object
$PHPWord = new \PhpOffice\PhpWord\PhpWord();

// Define some styles
$headerStyle = array('bold' => true, 'size' => 14, 'name' => 'Arial');

// Add a new section
$section = $PHPWord->addSection();

// Add a header to the section
$header = $section->addHeader();
$header->addText('Header Text', $headerStyle);

// Add some text to the section
$section->addText('Some text here');

// Save the document
$fileName = 'test.docx';
$filePath = '.' . DIRECTORY_SEPARATOR . $fileName;
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($PHPWord, 'Word2007');
$objWriter->save($filePath);

// Prompt the user to select a folder
echo "Please select a folder to save the document:";
$folder = readline();

// Save the folder path to MySQL
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO documents (name, path)
VALUES ('$fileName', '$folder')";

if ($conn->query($sql) === TRUE) {
    echo "Record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
