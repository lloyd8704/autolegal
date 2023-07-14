<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}

if (empty($save)) {

    // Set the headers for the downloaded file
    header('Content-Type: application/msword');
    header('Content-Disposition: attachment; filename=' . $savename . '.docx');
    header('Content-Length: ' . filesize('php://output')); // set the content length header to the size of the generated document

    ob_end_clean(); // clear any output that may have already been generated

    // Save the document to output
    $templateProcessor->saveAs('php://output');

    exit(); // exit the script

} else

    $path = "\\$filename\\FILES\\$save\\Pleadings\\$savename";
$path2 = "\\$filename\\FILES\\$save\\Pleadings\\";
$path3 = "\\$filename\\FILES\\$save\\";

$pathToSave = "C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data$path.docx";
$pathToSave2 = "C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data$path2";
$pathToSave3 = "C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data$path3";

if (!is_dir($pathToSave3)) {
    echo "<div><h2 class='heading3'><br>The destination folder ''$save'' does not exist. <br><br> 
        Please ensure the destination folder is saved correctly.
        <br><br>Edit Tab > Edit Pleadings > File's name.</h2></div>";
} else if (!is_dir($pathToSave2)) {

    (mkdir($pathToSave3 . "PLEADINGS", 0777));

    $i = 1;
    $pathToSave = "C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data$path2" . $savename . ".docx";
    while (file_exists($pathToSave)) {
        $pathToSave = "C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data$path2" . $savename . "(" . $i . ")" . ".docx";
        $i++;
    }
    $templateProcessor->saveAs($pathToSave);
    $directory = "C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data";
    $downloadlink = $pathToSave;

    if ($i == 1) {
        echo "<div><h2 class='heading3'> Your document<br><br> ''$savename''<br><br> was successfully created!</h2></div>";
    } else {
        echo "<div><h2 class='heading3'> Your document<br><br> ''$savename . '(' . $i . ')''<br><br> was successfully created!</h2></div>";
    }
    echo "<a class = btn10 id='correspondencedownload' href = '$downloadlink' download>&nbsp&nbspDownload&nbsp&nbsp</a>";
} else {

    $pathToSave = "C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data$path2" . $savename . ".docx";
    $i = 1;
    while (file_exists($pathToSave)) {
        $pathToSave = "C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data$path2" . $savename . "(" . $i . ")" . ".docx";
        $i++;
    }
    $templateProcessor->saveAs($pathToSave);
    $directory = "C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data";

    $downloadlink = $pathToSave;
    if ($i == 1) {
        echo "<div><h2 class='heading3'> Your document<br><br> ''$savename''<br><br> was successfully created!</h2></div>";
    } else {
        ($i1 = $i - 1);
        echo "<div><h2 class='heading3'> Your document<br><br> ''$savename ($i1)''<br><br> was successfully created!</h2></div>";
    }
    echo "<a class = btn10 id='correspondencedownload' href = '$downloadlink' download>&nbsp&nbspDownload&nbsp&nbsp</a>";
}
