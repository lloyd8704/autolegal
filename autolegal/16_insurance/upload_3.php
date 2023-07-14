<?php
// Directory where uploaded documents are stored
$targetDirectory = "C:\\Users\\Lloyd\\Mellows & de Swardt Inc\\Shared Data - User data\\Lloyd\\TEST FOLDER\\";

// Check if a search query is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["search"])) {
    $searchQuery = $_POST["search"];

    // Create the path to the subfolder based on the search query
    $subfolderPath = $targetDirectory . $searchQuery . "/";

    // Check if the subfolder exists
    if (is_dir($subfolderPath)) {
        // Get a list of files in the subfolder
        $files = scandir($subfolderPath);

        // Remove the "." and ".." directories from the list
        $files = array_diff($files, array(".", ".."));

        // Display the list of documents in the subfolder
        echo "<h2>Files in '$searchQuery' Subfolder</h2>";
        echo "<ul>";
        foreach ($files as $file) {
            echo "<li><a href='$subfolderPath$file' target='_blank'>$file</a></li>";
        }
        echo "</ul>";
    } else {
        echo "Subfolder '$searchQuery' not found.";
    }
}

// HTML form for searching subfolder name
echo "<form method='POST' action=''>
        <label for='search'>Search Subfolder:</label>
        <input type='text' name='search' id='search'>
        <input type='submit' value='Search'>
    </form>";
