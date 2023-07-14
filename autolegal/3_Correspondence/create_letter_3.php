<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../9_Style/style.css" />
    <title>Create Letter</title>
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
</head>
<div id="test">

    <body style="background-color: black">
        <nav>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
                <li><a class="nav-link" href="../2_New_file/Index.php">New&nbspFile</a></li>
                <li><a class="nav-link active" href="../3_Correspondence/Index.php">Correspondence</a></li>
                <li><a class="nav-link" href="../4_Pleadings/Index.php">Pleadings</a></li>
                <li><a class="nav-link" href="../5_Contacts/Index.php">Contacts</a></li>
                <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
                <li><a class="nav-link" href="../7_Edit/Index.php">Edit</a></li>
                <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
            </ul>
        </nav>
    </body>
</div>

</html>
<?php
require_once "../10_Database/connection.php";

// GET CONNECTION ERRORS
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL QUERY
$test = filter_var($_POST["reference"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$query = "SELECT * FROM `correspondence` WHERE test='$test'";


// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    require_once "../10_Database/phpoffice/vendor/autoload.php";
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {
        $recipient = strtoupper($row["recipient"]);
        $email = $row["email"];
        $theirref = $row["theirref"];
        $ourref = $row["ref"];
        $contact = $row["contact"];
        $date = date('d F Y');
        $subject = strtoupper($row["subject"]);
        $endparagraph = $row["eparagraph"];
        $author = $row["author"];
        $author_full_name = $row["author_full_name"];
        $number = $row['number'];
        $savename = date('Y-m-d') . " - " . strtoupper($row["recipient"]) . " - EMAIL";

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor("../10_Database/phpoffice/vendor/template1.docx");

        $templateProcessor->setValue('recipient', $recipient);
        $templateProcessor->setValue('emailaddress', $email);
        $templateProcessor->setValue('theirref', $theirref);
        $templateProcessor->setValue('ourref', $ourref);
        $templateProcessor->setValue('contact', $contact);
        $templateProcessor->setValue('date', $date);
        $templateProcessor->setValue('subject', $subject);
        $templateProcessor->setValue('endparagraph', $endparagraph);
        $templateProcessor->setValue('author', $author_full_name);

        //checks if the row number is blank - if blank then the user has chosen to be prompted for the save location
        if (empty($number)) {

            // Set the headers for the downloaded file
            header('Content-Type: application/msword');
            header('Content-Disposition: attachment; filename=' . $savename . '.docx');
            header('Content-Length: ' . filesize('php://output')); // set the content length header to the size of the generated document
            ob_end_clean(); // clear any output that may have already been generated
            // Save the document to output
            $templateProcessor->saveAs('php://output');
            exit(); // exit the script
        }

        //if there is a desired save location then:
        else
            //gets data for the path
            $filename1 = $row["author"];
        $filename = $row["author"];
        $path = "\\$filename\\FILES\\$number\\Correspondence\\$savename";
        $path2 = "\\$filename\\FILES\\$number\\Correspondence\\";
        $path3 = "\\$filename\\FILES\\$number\\";

        $pathToSave = "C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data$path.docx";
        $pathToSave2 = "C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data$path2";
        $pathToSave3 = "C:\Users\Lloyd\Mellows & de Swardt Inc\Shared Data - User data$path3";

        //check if the path exists - failsafe if user edits/moves/deletes the destination folder

        if (!is_dir($pathToSave3)) {
            echo "<div><h2 class='heading3'><br>The destination folder ''$number'' does not exist. <br><br> 
                    Please ensure the destination folder is saved correctly.
                    <br><br>Edit Tab > Edit Correspondence > File's name.</h2></div>";
        } else if (!is_dir($pathToSave2)) {

            (mkdir($pathToSave3 . "CORRESPONDENCE", 0777));

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
    }

    //if the reference number does not exist then echos the following

} else {
    echo "<span class='warning'>There is no file with that reference number - please try again.</span>";
}



$conn->close();

?>