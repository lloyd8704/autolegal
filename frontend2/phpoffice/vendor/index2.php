<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app1.css" />
    <title>Email Post</title>
</head>
<div id="test">

    <body>
        <nav>
            <div class="heading">
                <h4>AutoLegal</h4>
            </div>
        </nav>
</div>
</body>

<?php
$template = "echo '/frontend2/Documents/warning.png' ?>" >

    $servername = "localhost";
$username = "root";
$password = "";
$databasename = "correspdb";

// CREATE CONNECTION
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $databasename,
);




// GET CONNECTION ERRORS
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// SQL QUERY
$test = $_POST["reference"];
$query = "SELECT * FROM `correspondence` WHERE ref='$test'";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {
        $firstname = $row["email"];
        $savename = strtoupper($row["contact"]);
        require_once "autoload.php";

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("template1.docx");

        $templateProcessor->setValue('firstname', 'Bruce');
        $templateProcessor->setValue('lastname', $firstname);

        $pathToSave = "Z:\Shared Data - USERS\Lloyd\ $savename.docx";
        $templateProcessor->saveAs($pathToSave);
    }
} else {
    echo  $ref = $row["ref"];
}


$conn->close();






?>

</body>

</html>