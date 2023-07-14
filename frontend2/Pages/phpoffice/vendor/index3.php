<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../app.css" />
    <title>Create Letter</title>
</head>
<div id="test">

    <body>
        <nav>
            <div class="heading">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-linked" href="../../../Index.html">Home</a></li>
                <li><a class="nav-linked" href="../../newfile.html">New&nbspFile</a></li>
                <li><a class="nav-linked active" href="../../correspondence.html">Correspondence</a></li>
                <li><a class="nav-linked" href="../../pleadings.html">Pleadings</a></li>
                <li><a class="nav-linked " href="../../contactshome.html">Contacts</a></li>
                <li><a class="nav-linked" href="../../legislation.html">Legislation</a></li>

            </ul>
</div>
</nav>
</div>
</body>


<?php
session_start();
$name1 = $_SESSION['Name'];

$test2 = "template" . $_SESSION['Name'] . ".docx";
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
$query = "SELECT * FROM `correspondence` WHERE test='$test'";


// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {
        $number = $row["number"];
        if ($number == "1") {
            $recipient = strtoupper($row["recipient"]);
            $email = $row["email"];
            $theirref = $row["theirref"];
            $ourref = $row["ref"];
            $contact = $row["contact"];
            $date = date('d F Y');
            $subject = strtoupper($row["subject"]);
            $endparagraph = $row["eparagraph"];
            $author = $row["author"];
            $savename = date('Y-m-d') . " " . strtoupper($row["contact"]);

            //add the following if you want a time stamp -> 
            //. strftime("%HH%MM%SS");
            $filename1 = $row["author"];
            $filename = $row["author"];
            $path = "\\$filename\\$savename";
            require_once "autoload.php";
        } else if ($number == "2") {
            $recipient = strtoupper($row["recipient"]);
            $email = $row["email"] . "success";
            $theirref = $row["theirref"];
            $ourref = $row["ref"];
            $contact = $row["contact"];
            $date = date('d F Y');
            $subject = strtoupper($row["subject"]);
            $endparagraph = $row["eparagraph"];
            $author = $row["author"];
            $savename = date('Y-m-d') . " " . strtoupper($row["contact"]);

            //add the following if you want a time stamp -> 
            //. strftime("%HH%MM%SS");
            $filename1 = $row["author"];
            $filename = $row["author"];
            $path = "\\$filename\\$savename";
            require_once "autoload.php";
        }
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

        $templateProcessor->setValue('recipient', $recipient);
        $templateProcessor->setValue('emailaddress', $email);
        $templateProcessor->setValue('theirref', $theirref);
        $templateProcessor->setValue('ourref', $ourref);
        $templateProcessor->setValue('contact', $contact);
        $templateProcessor->setValue('date', $date);
        $templateProcessor->setValue('subject', $subject);
        $templateProcessor->setValue('endparagraph', $endparagraph);
        $templateProcessor->setValue('author', $author);

        $tempfolder = "test";
        $pathToSave = "Z:\Shared Data - USERS$path.docx";


        //renaming of the document if the document already exists
        $filename1 = $pathToSave;
        $testname = "Z:\Shared Data - USERS\\$filename\\$tempfolder\\$savename.docx";
        $number = '1';
        $number++;
        $directory = "Z:\Shared Data - USERS";
        $rename = date('Y-m-d') . " " . strtoupper($row["contact"]);
        $downloadlink = "$directory\\$filename\\$rename (1).docx";
        //if file already exists
        if (file_exists($pathToSave)) {
            echo "<div class='body-text'><h2> Your document ''$rename (1)'' was successfully created!</h2></div>";
            //save in temporary folder
            $templateProcessor->saveAs($testname);
            //copy from temporary folder into correct path
            copy($testname, $pathToSave . $number . ".docx");
            //renaming of the document to get rid off .docx2
            rename("$directory\\$filename\\$savename.docx2.docx", "$directory\\$filename\\$rename (1).docx");
            //delete file created in temp folder
            unlink($testname);
            clearstatcache();
            //variable for user
            echo "<a class = btn7 href = '$downloadlink' download>&nbsp&nbspDownload&nbsp&nbsp</a>";
            //echo "<a href = file:///Z://Shared%20Data%20-%20USERS//Lloyd//2022-10-21%20SOMEONE%20(1).docx>Download</a>";

            //link to document that was created
            echo '<br><a class = btn8 href="https://mellowsanddeswardt.sharepoint.com/
	sites/SharedData/USERS/Forms/AllItems.
	aspx?newTargetListUrl=%2Fsites%2FSharedData%2FUSERS
	&viewpath=%2Fsites%2FSharedData%2FUSERS%2FForms%2F
	AllItems%2Easpx&viewid=b6d3f17e%2Dee47%2D443e%2Db5bb%2D82a2e0067263&id=%2F
	sites%2FSharedData%2FUSERS%2F' . $filename . '">Go to Letter</a>';
        } else {
            //if the file does not exist
            $templateProcessor->saveAs($pathToSave);

            echo "<div class='body-text'><h2> Your document ''$rename'' was successfully created!</h2></div>";
            echo '<br><br><br><a class = btn8 href="https://mellowsanddeswardt.sharepoint.com/
	sites/SharedData/USERS/Forms/AllItems.
	aspx?newTargetListUrl=%2Fsites%2FSharedData%2FUSERS
	&viewpath=%2Fsites%2FSharedData%2FUSERS%2FForms%2F
	AllItems%2Easpx&viewid=b6d3f17e%2Dee47%2D443e%2Db5bb%2D82a2e0067263&id=%2F
	sites%2FSharedData%2FUSERS%2F' . $filename . '">Go to Letter</a>';
        }
    }
} else {
    echo "<span class='warning'>There is no file with that reference number - please try again.</span>";
}



$conn->close();

?>

<a href="<?php echo $downloadlink; ?>" target='../../contactshome.html'>Link</a> ;
</body>

</html>