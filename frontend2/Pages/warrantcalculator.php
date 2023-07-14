<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css" />
    <title>Create a Pleading</title>
</head>
<div id="test">

    <body style="background-color: black">
        <navi>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../../../Index.html">Home</a></li>
                <li><a class="nav-link" href="../../newfile.html">New&nbspFile</a></li>
                <li><a class="nav-link" href="../../correspondence.html">Correspondence</a></li>
                <li><a class="nav-link active" href="../../pleadings.html">Pleadings</a></li>
                <li><a class="nav-link" href="../../contactshome.html">Contacts</a></li>
                <li><a class="nav-link" href="../../dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-link" href="../../edit.php">Edit</a></li>
            </ul>
        </navi>


        <?php
        session_start();
        $judgmentdebt = $_POST['input1'];

        if ($judgmentdebt <= 7000) {
            $costs = "165";
        } else if ($judgmentdebt > 7000 && $judgmentdebt <= 50000) {
            $costs = "547";
        } else if ($judgmentdebt > 50000 && $judgmentdebt <= 200000) {
            $costs = "808";
        } else $costs = "1055";

        $interest = 0;
        $costswarrant = 121.50;
        $vat = 0.155 * ($costs + $costswarrant);
        $subtotal = $judgmentdebt + $costs + $interest + $costswarrant + $vat;
        $paid = $_POST['input2'];
        $total = $subtotal - $paid;





        $name2 = $_SESSION['Pleadings'];
        $name1 = substr($name2, 0, stripos($name2, '-'));
        $test2 = "MC\\" . $_SESSION['Pleadings'] . ".docx";
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

        $test = $_SESSION["reference"];
        $query = "SELECT * FROM `pleadings` WHERE reference='$test'";
        $input1 = $judgmentdebt;
        $input2 = $costs;
        // FETCHING DATA FROM DATABASE
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            // OUTPUT DATA OF EACH ROW
            while ($row = $result->fetch_assoc()) {
                $number = $row["number"];
                $opponents = $row["opponents"];
                if ($number == "1P1D") {
                    //1 plaintiff and 1 defendant
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $onedname = $row["onedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "";
                    $firstdefendant = "";
                    $author = $row["author"];
                    $authorwithcaps = strtoupper($row["authorwithcaps"]);
                    $represent = $row["represent"];
                    $representcaps = strtoupper($represent);

                    $reference = $row["reference"];
                    //add the following if you want a time stamp -> 
                    //. strftime("%HH%MM%SS");
                    $filename1 = $row["author"];
                    $filename = $row["author"];
                    $path = "\\$filename\\$savename";

                    $path2 = "\\$filename\\";
                    require_once "../../frontend2/phpoffice/vendor/autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables


                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);
                    //<w:rPr><w:b/></w:rPr>
                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);
                    $templateProcessor->cloneBlock("attorneyoned", 1);
                    $input3 = str_replace("\n", "<w:br />", $attorneyone);
                    $input4 = str_replace('&', '&amp;', $input3);
                    $templateProcessor->setValue('attorneyone', $input4);
                    //deleting irrelevant plaintiffs
                    $templateProcessor->cloneBlock("twop", 0);
                    $templateProcessor->cloneBlock("threep", 0);
                    $templateProcessor->cloneBlock("fourp", 0);
                    $templateProcessor->cloneBlock("fivep", 0);
                    $templateProcessor->cloneBlock("sixp", 0);
                    $templateProcessor->cloneBlock("sevenp", 0);
                    $templateProcessor->cloneBlock("eightp", 0);
                    //deleting irrelevant defendants
                    $templateProcessor->cloneBlock("twod", 0);
                    $templateProcessor->cloneBlock("threed", 0);
                    $templateProcessor->cloneBlock("fourd", 0);
                    $templateProcessor->cloneBlock("fived", 0);
                    $templateProcessor->cloneBlock("sixd", 0);
                    $templateProcessor->cloneBlock("sevend", 0);
                    $templateProcessor->cloneBlock("eightd", 0);

                    $templateProcessor->cloneBlock("attorneytwod", 0);
                    $templateProcessor->cloneBlock("attorneythreed", 0);
                    $templateProcessor->cloneBlock("attorneyfourd", 0);
                    $templateProcessor->cloneBlock("attorneyfived", 0);
                    $templateProcessor->cloneBlock("attorneysixd", 0);
                    $templateProcessor->cloneBlock("attorneysevend", 0);
                    $templateProcessor->cloneBlock("attorneyeightd", 0);
                    $templateProcessor->cloneBlock("attorneynined", 0);
                    $templateProcessor->cloneBlock("attorneytend", 0);
                    $templateProcessor->cloneBlock("attorneyelevend", 0);

                    $tempfolder = "test";
                    $pathToSave = "Z:\Shared Data - USERS$path.docx";
                    //C:\Users\Lloyd\Desktop\TEST FOLDER\Test.docx
                }
            }
        }
