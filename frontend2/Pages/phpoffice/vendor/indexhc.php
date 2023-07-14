<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../app.css" />
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
        $name1 = $_SESSION['Pleadings'];
        $test2 = "HC\\" . $_SESSION['Pleadings'] . ".docx";
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
        isset($_POST['register']);
        $test = $_POST["reference"];
        $query = "SELECT * FROM `pleadings` WHERE reference='$test'";


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
                    require_once "autoload.php";
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
                    $input3 = explode("\n", $attorneyone);
                    $input4 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input3[0] . "</w:t></w:r>";
                    for ($i = 1; $i < count($input3); $i++) {
                        $input4 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input3[$i] . "</w:t></w:r>";
                    }
                    $input5 = str_replace('&', '&amp;', $input4);
                    $templateProcessor->setValue('attorneyone', $input5);


                    /*$templateProcessor->cloneBlock("attorneyoned", 1);
                    $input3 = str_replace("\n", "<w:br />", $attorneyone);
                    $input4 = str_replace('&', '&amp;', $input3);
                    $templateProcessor->setValue('attorneyone', $input4);*/
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
                if ($number == "1P2D") {
                    //1 Plaintiff 2 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $onedname = $row["onedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $twodname = $row["twodname"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
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
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);
                    //determing the number of opponents
                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                    }

                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                    }



                    $templateProcessor->cloneBlock("twop", 0);
                    $templateProcessor->cloneBlock("threep", 0);
                    $templateProcessor->cloneBlock("fourp", 0);
                    $templateProcessor->cloneBlock("fivep", 0);
                    $templateProcessor->cloneBlock("sixp", 0);
                    $templateProcessor->cloneBlock("sevenp", 0);
                    $templateProcessor->cloneBlock("eightp", 0);
                    //deleting irrelevant defendants

                    $templateProcessor->cloneBlock("threed", 0);
                    $templateProcessor->cloneBlock("fourd", 0);
                    $templateProcessor->cloneBlock("fived", 0);
                    $templateProcessor->cloneBlock("sixd", 0);
                    $templateProcessor->cloneBlock("sevend", 0);
                    $templateProcessor->cloneBlock("eightd", 0);


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
                }


                if ($number == "1P3D") {
                    //1 Plaintiff 3 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $onedname = $row["onedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
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
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);


                    function processAttorney($templateProcessor, $attorney, $block, $value)
                    {
                        $input1 = explode("\n", $attorney);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->cloneBlock($block, 1);
                        $templateProcessor->setValue($value, $input3);
                    }

                    if ($opponents == 1) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                    }

                    if ($opponents == 2) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                    }

                    if ($opponents == 3) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                    }


                    //deleting irrelevant plaintiffs
                    $templateProcessor->cloneBlock("twop", 0);
                    $templateProcessor->cloneBlock("threep", 0);
                    $templateProcessor->cloneBlock("fourp", 0);
                    $templateProcessor->cloneBlock("fivep", 0);
                    $templateProcessor->cloneBlock("sixp", 0);
                    $templateProcessor->cloneBlock("sevenp", 0);
                    $templateProcessor->cloneBlock("eightp", 0);
                    //deleting irrelevant defendants

                    $templateProcessor->cloneBlock("fourd", 0);
                    $templateProcessor->cloneBlock("fived", 0);
                    $templateProcessor->cloneBlock("sixd", 0);
                    $templateProcessor->cloneBlock("sevend", 0);
                    $templateProcessor->cloneBlock("eightd", 0);

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
                }
                if ($number == "1P4D") {
                    //1 Plaintiff 4 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $onedname = $row["onedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
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
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />

                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    function processAttorney($templateProcessor, $attorney, $block, $value)
                    {
                        $input1 = explode("\n", $attorney);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->cloneBlock($block, 1);
                        $templateProcessor->setValue($value, $input3);
                    }

                    if ($opponents == 1) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }

                    if ($opponents == 2) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }

                    if ($opponents == 3) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }

                    if ($opponents == 4) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                    }


                    //deleting irrelevant plaintiffs
                    $templateProcessor->cloneBlock("twop", 0);
                    $templateProcessor->cloneBlock("threep", 0);
                    $templateProcessor->cloneBlock("fourp", 0);
                    $templateProcessor->cloneBlock("fivep", 0);
                    $templateProcessor->cloneBlock("sixp", 0);
                    $templateProcessor->cloneBlock("sevenp", 0);
                    $templateProcessor->cloneBlock("eightp", 0);
                    //deleting irrelevant defendants

                    $templateProcessor->cloneBlock("fived", 0);
                    $templateProcessor->cloneBlock("sixd", 0);
                    $templateProcessor->cloneBlock("sevend", 0);
                    $templateProcessor->cloneBlock("eightd", 0);

                    $templateProcessor->cloneBlock("attorneyfived", 0);
                    $templateProcessor->cloneBlock("attorneysixd", 0);
                    $templateProcessor->cloneBlock("attorneysevend", 0);
                    $templateProcessor->cloneBlock("attorneyeightd", 0);
                    $templateProcessor->cloneBlock("attorneynined", 0);
                    $templateProcessor->cloneBlock("attorneytend", 0);
                    $templateProcessor->cloneBlock("attorneyelevend", 0);

                    $tempfolder = "test";
                    $pathToSave = "Z:\Shared Data - USERS$path.docx";
                }
                if ($number == "1P5D") {
                    //1 Plaintiff 5 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $onedname = $row["onedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $fivedname = $row["fivedname"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
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
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('fivedname', $fivedname);
                    $templateProcessor->setValue('fived', '');
                    $templateProcessor->setValue('/fived', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 2) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 3) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 4) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 5) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        processAttorney($templateProcessor, $attorneyfive, "attorneyfived", "attorneyfive");
                    }



                    //deleting irrelevant plaintiffs
                    $templateProcessor->cloneBlock("twop", 0);
                    $templateProcessor->cloneBlock("threep", 0);
                    $templateProcessor->cloneBlock("fourp", 0);
                    $templateProcessor->cloneBlock("fivep", 0);
                    $templateProcessor->cloneBlock("sixp", 0);
                    $templateProcessor->cloneBlock("sevenp", 0);
                    $templateProcessor->cloneBlock("eightp", 0);
                    //deleting irrelevant defendants


                    $templateProcessor->cloneBlock("sixd", 0);
                    $templateProcessor->cloneBlock("sevend", 0);
                    $templateProcessor->cloneBlock("eightd", 0);

                    $templateProcessor->cloneBlock("attorneysixd", 0);
                    $templateProcessor->cloneBlock("attorneysevend", 0);
                    $templateProcessor->cloneBlock("attorneyeightd", 0);
                    $templateProcessor->cloneBlock("attorneynined", 0);
                    $templateProcessor->cloneBlock("attorneytend", 0);
                    $templateProcessor->cloneBlock("attorneyelevend", 0);

                    $tempfolder = "test";
                    $pathToSave = "Z:\Shared Data - USERS$path.docx";
                }


                if ($number == "1P6D") {
                    //1 Plaintiff 6 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $onedname = $row["onedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $fivedname = $row["fivedname"];
                    $sixdname = $row["sixdname"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
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
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('fivedname', $fivedname);
                    $templateProcessor->setValue('fived', '');
                    $templateProcessor->setValue('/fived', '');
                    $templateProcessor->setValue('sixdname', $sixdname);
                    $templateProcessor->setValue('sixd', '');
                    $templateProcessor->setValue('/sixd', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    function processAttorney($templateProcessor, $attorney, $block, $value)
                    {
                        $input1 = explode("\n", $attorney);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->cloneBlock($block, 1);
                        $templateProcessor->setValue($value, $input3);
                    }

                    if ($opponents == 1) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 2) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 3) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 4) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 5) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        processAttorney($templateProcessor, $attorneyfive, "attorneyfived", "attorneyfive");
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 6) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        processAttorney($templateProcessor, $attorneyfive, "attorneyfived", "attorneyfive");
                        processAttorney($templateProcessor, $attorneysix, "attorneysixd", "attorneysix");
                    }



                    //deleting irrelevant plaintiffs
                    $templateProcessor->cloneBlock("twop", 0);
                    $templateProcessor->cloneBlock("threep", 0);
                    $templateProcessor->cloneBlock("fourp", 0);
                    $templateProcessor->cloneBlock("fivep", 0);
                    $templateProcessor->cloneBlock("sixp", 0);
                    $templateProcessor->cloneBlock("sevenp", 0);
                    $templateProcessor->cloneBlock("eightp", 0);
                    //deleting irrelevant defendants

                    $templateProcessor->cloneBlock("sixd", 0);
                    $templateProcessor->cloneBlock("sevend", 0);
                    $templateProcessor->cloneBlock("eightd", 0);

                    $templateProcessor->cloneBlock("attorneysixd", 0);
                    $templateProcessor->cloneBlock("attorneysevend", 0);
                    $templateProcessor->cloneBlock("attorneyeightd", 0);
                    $templateProcessor->cloneBlock("attorneynined", 0);
                    $templateProcessor->cloneBlock("attorneytend", 0);
                    $templateProcessor->cloneBlock("attorneyelevend", 0);

                    $tempfolder = "test";
                    $pathToSave = "Z:\Shared Data - USERS$path.docx";
                }
                if ($number == "2P1D") {
                    //2 Plaintiffs 1 Defendant
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $onedname = $row["onedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    function processAttorney($templateProcessor, $attorney, $block, $value)
                    {
                        $input1 = explode("\n", $attorney);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->cloneBlock($block, 1);
                        $templateProcessor->setValue($value, $input3);
                    }

                    if ($opponents == 1) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                    }

                    if ($opponents == 2) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                    }

                    //deleting irrelevant plaintiffs
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
                }
                if ($number == "2P2D") {
                    //2 Plaintiffs 2 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    function processAttorney($templateProcessor, $attorney, $block, $value)
                    {
                        $input1 = explode("\n", $attorney);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->cloneBlock($block, 1);
                        $templateProcessor->setValue($value, $input3);
                    }

                    if ($opponents == 1) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                    }

                    if ($opponents == 2) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                    }

                    if ($opponents == 3) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                    }



                    //deleting irrelevant plaintiffs
                    $templateProcessor->cloneBlock("threep", 0);
                    $templateProcessor->cloneBlock("fourp", 0);
                    $templateProcessor->cloneBlock("fivep", 0);
                    $templateProcessor->cloneBlock("sixp", 0);
                    $templateProcessor->cloneBlock("sevenp", 0);
                    $templateProcessor->cloneBlock("eightp", 0);
                    //deleting irrelevant defendants

                    $templateProcessor->cloneBlock("threed", 0);
                    $templateProcessor->cloneBlock("fourd", 0);
                    $templateProcessor->cloneBlock("fived", 0);
                    $templateProcessor->cloneBlock("sixd", 0);
                    $templateProcessor->cloneBlock("sevend", 0);
                    $templateProcessor->cloneBlock("eightd", 0);

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
                }
                if ($number == "2P3D") {
                    //2 Plaintiffs 3 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    function processAttorney($templateProcessor, $attorney, $block, $value)
                    {
                        $input1 = explode("\n", $attorney);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->cloneBlock($block, 1);
                        $templateProcessor->setValue($value, $input3);
                    }

                    if ($opponents == 1) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }

                    if ($opponents == 2) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }

                    if ($opponents == 3) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }

                    if ($opponents == 4) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                    }




                    //deleting irrelevant plaintiffs
                    $templateProcessor->cloneBlock("threep", 0);
                    $templateProcessor->cloneBlock("fourp", 0);
                    $templateProcessor->cloneBlock("fivep", 0);
                    $templateProcessor->cloneBlock("sixp", 0);
                    $templateProcessor->cloneBlock("sevenp", 0);
                    $templateProcessor->cloneBlock("eightp", 0);
                    //deleting irrelevant defendants

                    $templateProcessor->cloneBlock("fourd", 0);
                    $templateProcessor->cloneBlock("fived", 0);
                    $templateProcessor->cloneBlock("sixd", 0);
                    $templateProcessor->cloneBlock("sevend", 0);
                    $templateProcessor->cloneBlock("eightd", 0);

                    $templateProcessor->cloneBlock("attorneyfived", 0);
                    $templateProcessor->cloneBlock("attorneysixd", 0);
                    $templateProcessor->cloneBlock("attorneysevend", 0);
                    $templateProcessor->cloneBlock("attorneyeightd", 0);
                    $templateProcessor->cloneBlock("attorneynined", 0);
                    $templateProcessor->cloneBlock("attorneytend", 0);
                    $templateProcessor->cloneBlock("attorneyelevend", 0);

                    $tempfolder = "test";
                    $pathToSave = "Z:\Shared Data - USERS$path.docx";
                }
                if ($number == "2P4D") {
                    //2 Plaintiffs 4 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    function processAttorney($templateProcessor, $attorney, $block, $value)
                    {
                        $input1 = explode("\n", $attorney);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->cloneBlock($block, 1);
                        $templateProcessor->setValue($value, $input3);
                    }


                    if ($opponents == 1) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 2) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 3) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 4) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 5) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        processAttorney($templateProcessor, $attorneyfive, "attorneyfived", "attorneyfive");
                    }

                    //deleting irrelevant plaintiffs
                    $templateProcessor->cloneBlock("threep", 0);
                    $templateProcessor->cloneBlock("fourp", 0);
                    $templateProcessor->cloneBlock("fivep", 0);
                    $templateProcessor->cloneBlock("sixp", 0);
                    $templateProcessor->cloneBlock("sevenp", 0);
                    $templateProcessor->cloneBlock("eightp", 0);
                    //deleting irrelevant defendants

                    $templateProcessor->cloneBlock("fived", 0);
                    $templateProcessor->cloneBlock("sixd", 0);
                    $templateProcessor->cloneBlock("sevend", 0);
                    $templateProcessor->cloneBlock("eightd", 0);

                    $templateProcessor->cloneBlock("attorneysixd", 0);
                    $templateProcessor->cloneBlock("attorneysevend", 0);
                    $templateProcessor->cloneBlock("attorneyeightd", 0);
                    $templateProcessor->cloneBlock("attorneynined", 0);
                    $templateProcessor->cloneBlock("attorneytend", 0);
                    $templateProcessor->cloneBlock("attorneyelevend", 0);

                    $tempfolder = "test";
                    $pathToSave = "Z:\Shared Data - USERS$path.docx";
                }

                if ($number == "2P5D") {
                    //2 Plaintiffs 5 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $fivedname = $row["fivedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fivedname', $fivedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('fived', '');
                    $templateProcessor->setValue('/fived', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);


                    function processAttorney($templateProcessor, $attorney, $block, $value)
                    {
                        $input1 = explode("\n", $attorney);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->cloneBlock($block, 1);
                        $templateProcessor->setValue($value, $input3);
                    }

                    if ($opponents == 1) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 2) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 3) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 4) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 5) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        processAttorney($templateProcessor, $attorneyfive, "attorneyfived", "attorneyfive");
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 6) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        processAttorney($templateProcessor, $attorneyfive, "attorneyfived", "attorneyfive");
                        processAttorney($templateProcessor, $attorneysix, "attorneysixd", "attorneysix");
                    }


                    //deleting irrelevant plaintiffs
                    $templateProcessor->cloneBlock("threep", 0);
                    $templateProcessor->cloneBlock("fourp", 0);
                    $templateProcessor->cloneBlock("fivep", 0);
                    $templateProcessor->cloneBlock("sixp", 0);
                    $templateProcessor->cloneBlock("sevenp", 0);
                    $templateProcessor->cloneBlock("eightp", 0);
                    //deleting irrelevant defendants

                    $templateProcessor->cloneBlock("fived", 0);
                    $templateProcessor->cloneBlock("sixd", 0);
                    $templateProcessor->cloneBlock("sevend", 0);
                    $templateProcessor->cloneBlock("eightd", 0);

                    $templateProcessor->cloneBlock("attorneysixd", 0);
                    $templateProcessor->cloneBlock("attorneysevend", 0);
                    $templateProcessor->cloneBlock("attorneyeightd", 0);
                    $templateProcessor->cloneBlock("attorneynined", 0);
                    $templateProcessor->cloneBlock("attorneytend", 0);
                    $templateProcessor->cloneBlock("attorneyelevend", 0);

                    $tempfolder = "test";
                    $pathToSave = "Z:\Shared Data - USERS$path.docx";
                }

                if ($number == "2P6D") {
                    //2 Plaintiffs 6 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $fivedname = $row["fivedname"];
                    $sixdname = $row["sixdname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fivedname', $fivedname);
                    $templateProcessor->setValue('sixdname', $sixdname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('fived', '');
                    $templateProcessor->setValue('/fived', '');
                    $templateProcessor->setValue('sixd', '');
                    $templateProcessor->setValue('/sixd', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    function processAttorney($templateProcessor, $attorney, $block, $value)
                    {
                        $input1 = explode("\n", $attorney);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->cloneBlock($block, 1);
                        $templateProcessor->setValue($value, $input3);
                    }
                    if ($opponents == 1) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 2) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 3) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 4) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        processAttorney($templateProcessor, $attorneyfive, "attorneyfived", "attorneyfive");
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 5) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        processAttorney($templateProcessor, $attorneyfive, "attorneyfived", "attorneyfive");
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 6) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        processAttorney($templateProcessor, $attorneyfive, "attorneyfived", "attorneyfive");
                        processAttorney($templateProcessor, $attorneysix, "attorneysixd", "attorneysix");
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 7) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                        processAttorney($templateProcessor, $attorneyfour, "attorneyfourd", "attorneyfour");
                        processAttorney($templateProcessor, $attorneyfive, "attorneyfived", "attorneyfive");
                        processAttorney($templateProcessor, $attorneysix, "attorneysixd", "attorneysix");
                        processAttorney($templateProcessor, $attorneyseven, "attorneysevend", "attorneyseven");
                    }




                    //deleting irrelevant plaintiffs
                    $templateProcessor->cloneBlock("threep", 0);
                    $templateProcessor->cloneBlock("fourp", 0);
                    $templateProcessor->cloneBlock("fivep", 0);
                    $templateProcessor->cloneBlock("sixp", 0);
                    $templateProcessor->cloneBlock("sevenp", 0);
                    $templateProcessor->cloneBlock("eightp", 0);
                    //deleting irrelevant defendants



                    $templateProcessor->cloneBlock("fived", 0);
                    $templateProcessor->cloneBlock("sixd", 0);
                    $templateProcessor->cloneBlock("sevend", 0);
                    $templateProcessor->cloneBlock("eightd", 0);

                    $templateProcessor->cloneBlock("attorneysixd", 0);
                    $templateProcessor->cloneBlock("attorneysevend", 0);
                    $templateProcessor->cloneBlock("attorneyeightd", 0);
                    $templateProcessor->cloneBlock("attorneynined", 0);
                    $templateProcessor->cloneBlock("attorneytend", 0);
                    $templateProcessor->cloneBlock("attorneyelevend", 0);

                    $tempfolder = "test";
                    $pathToSave = "Z:\Shared Data - USERS$path.docx";
                }

                if ($number == "3P1D") {
                    //3 Plaintiffs 1 Defendant
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $onedname = $row["onedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    function processAttorney($templateProcessor, $attorney, $block, $value)
                    {
                        $input1 = explode("\n", $attorney);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->cloneBlock($block, 1);
                        $templateProcessor->setValue($value, $input3);
                    }
                    if ($opponents == 1) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                    }

                    if ($opponents == 2) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                    }

                    if ($opponents == 3) {
                        processAttorney($templateProcessor, $attorneyone, "attorneyoned", "attorneyone");
                        processAttorney($templateProcessor, $attorneytwo, "attorneytwod", "attorneytwo");
                        processAttorney($templateProcessor, $attorneythree, "attorneythreed", "attorneythree");
                    }


                    //deleting irrelevant plaintiffs
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
                }
                if ($number == "3P2D") {
                    //3 Plaintiffs 2 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);
                    }



                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "3P3D") {
                    //3 Plaintiffs 3 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);
                    }


                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "3P4D") {
                    //3 Plaintiffs 4 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);
                    }

                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "3P5D") {
                    //3 Plaintiffs 5 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $fivedname = $row["fivedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fivedname', $fivedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('fived', '');
                    $templateProcessor->setValue('/fived', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);
                    }

                    //deleting irrelevant plaintiffs
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
                }
                if ($number == "3P6D") {
                    //3 Plaintiffs 6 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $fivedname = $row["fivedname"];
                    $sixdname = $row["sixdname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $attorneyeight = $row["attorneyeight"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fivedname', $fivedname);
                    $templateProcessor->setValue('sixdname', $sixdname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('fived', '');
                    $templateProcessor->setValue('/fived', '');
                    $templateProcessor->setValue('sixd', '');
                    $templateProcessor->setValue('/sixd', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);
                    }

                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "4P1D") {
                    //4 Plaintiffs 1 Defendant
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $onedname = $row["onedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);


                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);
                    }


                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "4P2D") {
                    //4 Plaintiffs 2 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);
                    }


                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "4P3D") {
                    //4 Plaintiffs 3 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);;
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);
                    }


                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "4P4D") {
                    //4 Plaintiffs 4 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);;
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);
                    }


                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "4P5D") {
                    //4 Plaintiffs 5 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $fivedname = $row["fivedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $attorneyeight = $row["attorneyeight"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fivedname', $fivedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('fived', '');
                    $templateProcessor->setValue('/fived', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);;
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }
                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);
                    }

                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "4P6D") {
                    //4 Plaintiffs 6 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $fivedname = $row["fivedname"];
                    $sixdname = $row["sixdname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $attorneyeight = $row["attorneyeight"];
                    $attorneynine = $row["attorneynine"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fivedname', $fivedname);
                    $templateProcessor->setValue('sixdname', $sixdname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('fived', '');
                    $templateProcessor->setValue('/fived', '');
                    $templateProcessor->setValue('sixd', '');
                    $templateProcessor->setValue('/sixd', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);;
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }
                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }

                    if ($opponents == 9) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input25 = explode("\n", $attorneynine);
                        $input26 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input25[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input25); $i++) {
                            $input26 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input25[$i] . "</w:t></w:r>";
                        }
                        $input27 = str_replace('&', '&amp;', $input26);
                        $templateProcessor->setValue('attorneynine', $input27);
                    }
                    //deleting irrelevant plaintiffs
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
                }
                if ($number == "5P1D") {
                    //5 Plaintiffs 1 Defendant
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $fivepname = $row["fivepname"];
                    $onedname = $row["onedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('fivepname', $fivepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fivep', '');
                    $templateProcessor->setValue('/fivep', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);
                    }


                    //deleting irrelevant plaintiffs
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
                }
                if ($number == "5P2D") {
                    //5 Plaintiffs 2 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $fivepname = $row["fivepname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('fivepname', $fivepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fivep', '');
                    $templateProcessor->setValue('/fivep', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);
                    }

                    //deleting irrelevant plaintiffs
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
                }


                if ($number == "5P3D") {
                    //5 Plaintiffs 3 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $fivepname = $row["fivepname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('fivepname', $fivepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fivep', '');
                    $templateProcessor->setValue('/fivep', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);
                    }

                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "5P4D") {
                    //5 Plaintiffs 4 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $fivepname = $row["fivepname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $attorneyeight = $row["attorneyeight"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('fivepname', $fivepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fivep', '');
                    $templateProcessor->setValue('/fivep', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }


                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);
                    }

                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "5P5D") {
                    //5 Plaintiffs 5 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $fivepname = $row["fivepname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $fivedname = $row["fivedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $attorneyeight = $row["attorneyeight"];
                    $attorneynine = $row["attorneynine"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('fivepname', $fivepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fivedname', $fivedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fivep', '');
                    $templateProcessor->setValue('/fivep', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('fived', '');
                    $templateProcessor->setValue('/fived', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);

                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);

                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }
                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);

                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 9) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input25 = explode("\n", $attorneynine);
                        $input26 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input25[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input25); $i++) {
                            $input26 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input25[$i] . "</w:t></w:r>";
                        }
                        $input27 = str_replace('&', '&amp;', $input26);
                        $templateProcessor->setValue('attorneynine', $input27);
                    }

                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "5P6D") {
                    //5 Plaintiffs 6 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $fivepname = $row["fivepname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $fivedname = $row["fivedname"];
                    $sixdname = $row["sixdname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $attorneyeight = $row["attorneyeight"];
                    $attorneynine = $row["attorneynine"];
                    $attorneyten = $row["attorneyten"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('fivepname', $fivepname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fivedname', $fivedname);
                    $templateProcessor->setValue('sixdname', $sixdname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fivep', '');
                    $templateProcessor->setValue('/fivep', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('fived', '');
                    $templateProcessor->setValue('/fived', '');
                    $templateProcessor->setValue('sixd', '');
                    $templateProcessor->setValue('/sixd', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);


                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);

                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);

                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }
                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);

                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 9) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input25 = explode("\n", $attorneynine);
                        $input26 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input25[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input25); $i++) {
                            $input26 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input25[$i] . "</w:t></w:r>";
                        }
                        $input27 = str_replace('&', '&amp;', $input26);
                        $templateProcessor->setValue('attorneynine', $input27);

                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 10) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input25 = explode("\n", $attorneynine);
                        $input26 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input25[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input25); $i++) {
                            $input26 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input25[$i] . "</w:t></w:r>";
                        }
                        $input27 = str_replace('&', '&amp;', $input26);
                        $templateProcessor->setValue('attorneynine', $input27);

                        $templateProcessor->cloneBlock("attorneytend", 1);
                        $input28 = explode("\n", $attorneyten);
                        $input29 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input28[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input28); $i++) {
                            $input29 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input28[$i] . "</w:t></w:r>";
                        }
                        $input30 = str_replace('&', '&amp;', $input29);
                        $templateProcessor->setValue('attorneyten', $input30);
                    }

                    //deleting irrelevant plaintiffs
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
                }

                if ($number == "6P1D") {
                    //6 Plaintiffs 1 Defendant
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $fivepname = $row["fivepname"];
                    $sixpname = $row["sixpname"];
                    $onedname = $row["onedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('fivepname', $fivepname);
                    $templateProcessor->setValue('sixpname', $sixpname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fivep', '');
                    $templateProcessor->setValue('/fivep', '');
                    $templateProcessor->setValue('sixp', '');
                    $templateProcessor->setValue('/sixp', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);
                    }
                    //deleting irrelevant plaintiffs

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
                }

                if ($number == "6P2D") {
                    //6 Plaintiffs 2 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $fivepname = $row["fivepname"];
                    $sixpname = $row["sixpname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('fivepname', $fivepname);
                    $templateProcessor->setValue('sixpname', $sixpname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fivep', '');
                    $templateProcessor->setValue('/fivep', '');
                    $templateProcessor->setValue('sixp', '');
                    $templateProcessor->setValue('/sixp', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);
                    }

                    //deleting irrelevant plaintiffs

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
                }
                if ($number == "6P3D") {
                    //6 Plaintiffs 3 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $fivepname = $row["fivepname"];
                    $sixpname = $row["sixpname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $attorneyeight = $row["attorneyeight"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('fivepname', $fivepname);
                    $templateProcessor->setValue('sixpname', $sixpname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fivep', '');
                    $templateProcessor->setValue('/fivep', '');
                    $templateProcessor->setValue('sixp', '');
                    $templateProcessor->setValue('/sixp', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);
                    }

                    //deleting irrelevant plaintiffs

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
                }

                if ($number == "6P4D") {
                    //6 Plaintiffs 4 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $fivepname = $row["fivepname"];
                    $sixpname = $row["sixpname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $attorneyeight = $row["attorneyeight"];
                    $attorneynine = $row["attorneynine"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('fivepname', $fivepname);
                    $templateProcessor->setValue('sixpname', $sixpname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fivep', '');
                    $templateProcessor->setValue('/fivep', '');
                    $templateProcessor->setValue('sixp', '');
                    $templateProcessor->setValue('/sixp', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 9) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input25 = explode("\n", $attorneynine);
                        $input26 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input25[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input25); $i++) {
                            $input26 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input25[$i] . "</w:t></w:r>";
                        }
                        $input27 = str_replace('&', '&amp;', $input26);
                        $templateProcessor->setValue('attorneynine', $input27);
                    }

                    //deleting irrelevant plaintiffs

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
                }

                if ($number == "6P5D") {
                    //6 Plaintiffs 5 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $fivepname = $row["fivepname"];
                    $sixpname = $row["sixpname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $fivedname = $row["fivedname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $attorneyeight = $row["attorneyeight"];
                    $attorneynine = $row["attorneynine"];
                    $attorneyten = $row["attorneyten"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables

                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('fivepname', $fivepname);
                    $templateProcessor->setValue('sixpname', $sixpname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fivedname', $fivedname);
                    $templateProcessor->setValue('location', $location);
                    $templateProcessor->setValue('month', $month);
                    $templateProcessor->setValue('year', $year);
                    $templateProcessor->setValue('province', $province);
                    $templateProcessor->setValue('firstplaintiff', $firstplaintiff);
                    $templateProcessor->setValue('firstdefendant', $firstdefendant);
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fivep', '');
                    $templateProcessor->setValue('/fivep', '');
                    $templateProcessor->setValue('sixp', '');
                    $templateProcessor->setValue('/sixp', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('fived', '');
                    $templateProcessor->setValue('/fived', '');
                    $templateProcessor->setValue('authorwithcaps', $authorwithcaps);
                    $templateProcessor->setValue('author', $author);
                    $templateProcessor->setValue('represent', $represent);
                    $templateProcessor->setValue('representcaps', $representcaps);
                    $templateProcessor->setValue('reference', $reference);
                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 9) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input25 = explode("\n", $attorneynine);
                        $input26 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input25[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input25); $i++) {
                            $input26 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input25[$i] . "</w:t></w:r>";
                        }
                        $input27 = str_replace('&', '&amp;', $input26);
                        $templateProcessor->setValue('attorneynine', $input27);

                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 10) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input25 = explode("\n", $attorneynine);
                        $input26 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input25[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input25); $i++) {
                            $input26 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input25[$i] . "</w:t></w:r>";
                        }
                        $input27 = str_replace('&', '&amp;', $input26);
                        $templateProcessor->setValue('attorneynine', $input27);

                        $templateProcessor->cloneBlock("attorneytend", 1);
                        $input28 = explode("\n", $attorneyten);
                        $input29 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input28[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input28); $i++) {
                            $input29 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input28[$i] . "</w:t></w:r>";
                        }
                        $input30 = str_replace('&', '&amp;', $input29);
                        $templateProcessor->setValue('attorneyten', $input30);
                    }


                    //deleting irrelevant plaintiffs

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
                }
                if ($number == "6P6D") {
                    //6 Plaintiffs 6 Defendants
                    $court = $row["court"];
                    $casenumber = $row["casenumber"];
                    $onepname = $row["onepname"];
                    $twopname = $row["twopname"];
                    $threepname = $row["threepname"];
                    $fourpname = $row["fourpname"];
                    $fivepname = $row["fivepname"];
                    $sixpname = $row["sixpname"];
                    $onedname = $row["onedname"];
                    $twodname = $row["twodname"];
                    $threedname = $row["threedname"];
                    $fourdname = $row["fourdname"];
                    $fivedname = $row["fivedname"];
                    $sixdname = $row["sixdname"];
                    $location = $row["location"];
                    $ourdetails = $row["ourdetails"];
                    $month = strtoupper(date('F'));
                    $year = date('Y');
                    $province = $row["province"];
                    $attorneyone = $row["attorneyone"];
                    $attorneytwo = $row["attorneytwo"];
                    $attorneythree = $row["attorneythree"];
                    $attorneyfour = $row["attorneyfour"];
                    $attorneyfive = $row["attorneyfive"];
                    $attorneysix = $row["attorneysix"];
                    $attorneyseven = $row["attorneyseven"];
                    $attorneyeight = $row["attorneyeight"];
                    $attorneynine = $row["attorneynine"];
                    $attorneyten = $row["attorneyten"];
                    $attorneyeleven = $row["attorneyeleven"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "First";
                    $firstdefendant = "First";
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
                    require_once "autoload.php";
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($test2);

                    //setting string value with variables


                    $templateProcessor->setValue('casenumber', $casenumber);
                    $templateProcessor->setValue('onepname', $onepname);
                    $templateProcessor->setValue('twopname', $twopname);
                    $templateProcessor->setValue('threepname', $threepname);
                    $templateProcessor->setValue('fourpname', $fourpname);
                    $templateProcessor->setValue('fivepname', $fivepname);
                    $templateProcessor->setValue('sixpname', $sixpname);
                    $templateProcessor->setValue('onedname', $onedname);
                    $templateProcessor->setValue('twodname', $twodname);
                    $templateProcessor->setValue('threedname', $threedname);
                    $templateProcessor->setValue('fourdname', $fourdname);
                    $templateProcessor->setValue('fivedname', $fivedname);
                    $templateProcessor->setValue('sixdname', $sixdname);
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
                    $templateProcessor->setValue('twop', '');
                    $templateProcessor->setValue('/twop', '');
                    $templateProcessor->setValue('threep', '');
                    $templateProcessor->setValue('/threep', '');
                    $templateProcessor->setValue('fourp', '');
                    $templateProcessor->setValue('/fourp', '');
                    $templateProcessor->setValue('fivep', '');
                    $templateProcessor->setValue('/fivep', '');
                    $templateProcessor->setValue('sixp', '');
                    $templateProcessor->setValue('/sixp', '');
                    $templateProcessor->setValue('twod', '');
                    $templateProcessor->setValue('/twod', '');
                    $templateProcessor->setValue('threed', '');
                    $templateProcessor->setValue('/threed', '');
                    $templateProcessor->setValue('fourd', '');
                    $templateProcessor->setValue('/fourd', '');
                    $templateProcessor->setValue('fived', '');
                    $templateProcessor->setValue('/fived', '');
                    $templateProcessor->setValue('sixd', '');
                    $templateProcessor->setValue('/sixd', '');

                    //cloning the block once and then replacing \n in database with paragraph <w:br />
                    $templateProcessor->cloneBlock("court", 1);
                    $inputa = str_replace("\r\n", '<w:p />', $court);
                    $inputb = str_replace("*", '<w:rPr><w:b/></w:rPr>', $inputa);
                    $templateProcessor->setValue('court', $inputb);

                    $templateProcessor->cloneBlock("ourdetailsd", 1);
                    $input1 = str_replace("\n", "<w:br />", $ourdetails);
                    $input2 = str_replace('&', '&amp;', $input1);
                    $templateProcessor->setValue('ourdetails', $input2);

                    if ($opponents == 1) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }

                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }

                    if ($opponents == 9) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input25 = explode("\n", $attorneynine);
                        $input26 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input25[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input25); $i++) {
                            $input26 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input25[$i] . "</w:t></w:r>";
                        }
                        $input27 = str_replace('&', '&amp;', $input26);
                        $templateProcessor->setValue('attorneynine', $input27);

                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }
                    if ($opponents == 10) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input25 = explode("\n", $attorneynine);
                        $input26 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input25[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input25); $i++) {
                            $input26 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input25[$i] . "</w:t></w:r>";
                        }
                        $input27 = str_replace('&', '&amp;', $input26);
                        $templateProcessor->setValue('attorneynine', $input27);

                        $templateProcessor->cloneBlock("attorneytend", 1);
                        $input28 = explode("\n", $attorneyten);
                        $input29 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input28[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input28); $i++) {
                            $input29 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input28[$i] . "</w:t></w:r>";
                        }
                        $input30 = str_replace('&', '&amp;', $input29);
                        $templateProcessor->setValue('attorneyten', $input30);
                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }
                    if ($opponents == 11) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input1 = explode("\n", $attorneyone);
                        $input2 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input1[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input1); $i++) {
                            $input2 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input1[$i] . "</w:t></w:r>";
                        }
                        $input3 = str_replace('&', '&amp;', $input2);
                        $templateProcessor->setValue('attorneyone', $input3);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input4 = explode("\n", $attorneytwo);
                        $input5 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input4[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input4); $i++) {
                            $input5 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input4[$i] . "</w:t></w:r>";
                        }
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = explode("\n", $attorneythree);
                        $input8 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input7[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input7); $i++) {
                            $input8 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input7[$i] . "</w:t></w:r>";
                        }
                        $input9 = str_replace('&', '&amp;', $input8);
                        $templateProcessor->setValue('attorneythree', $input9);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input10 = explode("\n", $attorneyfour);
                        $input11 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input10[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input10); $i++) {
                            $input11 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input10[$i] . "</w:t></w:r>";
                        }
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfour', $input12);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input13 = explode("\n", $attorneyfive);
                        $input14 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input13[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input13); $i++) {
                            $input14 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input13[$i] . "</w:t></w:r>";
                        }
                        $input15 = str_replace('&', '&amp;', $input14);
                        $templateProcessor->setValue('attorneyfive', $input15);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input16 = explode("\n", $attorneysix);
                        $input17 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input16[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input16); $i++) {
                            $input17 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input16[$i] . "</w:t></w:r>";
                        }
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneysix', $input18);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input19 = explode("\n", $attorneyseven);
                        $input20 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input19[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input19); $i++) {
                            $input20 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input19[$i] . "</w:t></w:r>";
                        }
                        $input21 = str_replace('&', '&amp;', $input20);
                        $templateProcessor->setValue('attorneyseven', $input21);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input22 = explode("\n", $attorneyeight);
                        $input23 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input22[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input22); $i++) {
                            $input23 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input22[$i] . "</w:t></w:r>";
                        }
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeight', $input24);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input25 = explode("\n", $attorneynine);
                        $input26 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input25[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input25); $i++) {
                            $input26 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input25[$i] . "</w:t></w:r>";
                        }
                        $input27 = str_replace('&', '&amp;', $input26);
                        $templateProcessor->setValue('attorneynine', $input27);

                        $templateProcessor->cloneBlock("attorneytend", 1);
                        $input28 = explode("\n", $attorneyten);
                        $input29 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input28[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input28); $i++) {
                            $input29 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input28[$i] . "</w:t></w:r>";
                        }
                        $input30 = str_replace('&', '&amp;', $input29);
                        $templateProcessor->setValue('attorneyten', $input30);

                        $templateProcessor->cloneBlock("attorneyelevend", 1);
                        $input31 = explode("\n", $attorneyeleven);
                        $input32 = "<w:r><w:rPr><w:b /></w:rPr><w:t xml:space='preserve'>" . $input31[0] . "</w:t></w:r>";
                        for ($i = 1; $i < count($input31); $i++) {
                            $input32 .= "<w:br /><w:r><w:t xml:space='preserve'>" . $input31[$i] . "</w:t></w:r>";
                        }
                        $input33 = str_replace('&', '&amp;', $input32);
                        $templateProcessor->setValue('attorneyeleven', $input33);
                    }

                    //deleting irrelevant plaintiffs

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


                    $templateProcessor->cloneBlock("attorneyfourd", 0);
                    $templateProcessor->cloneBlock("attorneyfived", 0);
                    $templateProcessor->cloneBlock("attorneysixd", 0);
                    $templateProcessor->cloneBlock("attorneysevend", 0);
                    $templateProcessor->cloneBlock("attorneyeightd", 0);
                    $templateProcessor->cloneBlock("attorneynined", 0);
                    $templateProcessor->cloneBlock("attorneytend", 0);


                    $tempfolder = "test";
                    $pathToSave = "Z:\Shared Data - USERS$path.docx";
                }

                if (file_exists($pathToSave)) {;

                    $basename =  $pathToSave;
                    $j = 1;

                    while (file_exists($pathToSave)) {
                        $basename2 = $savename;
                        $pathToSave = "Z:\Shared Data - USERS$path2" . $basename2 . " (" . $j . ")" . ".docx";
                        $j++;
                        $j2 = $j - 1;
                        $j3 = " (" . $j2 . ")";
                    }
                    $directory = "Z:\Shared Data - USERS";
                    $downloadname = $basename2 . $j3;
                    $downloadlink = "$directory\\$filename\\$downloadname.docx";
                    echo "<div><h1 class='heading3'> Your document<br><br> ''$basename2 $j3''<br><br> was successfully created!</h1></div>";
                    echo "<a class = btndownload href = '$downloadlink' download>&nbsp&nbspDownload&nbsp&nbsp</a>";

                    //save in temporary folder
                    $templateProcessor->saveAs($pathToSave);
                } else {
                    echo "<div><h2 class='heading3'> Your document<br><br>''$savename''<br><br> was successfully created!</h2></div>";
                    $templateProcessor->saveAs($pathToSave);
                    $directory = "Z:\Shared Data - USERS";
                    $downloadlink = "$directory\\$filename\\$savename.docx";
                    echo "<a class = btndownload href = '$downloadlink' download>&nbsp&nbspDownload&nbsp&nbsp</a>";
                }
            }
        } else {
            echo "<span class='error'><br>There is no file with that reference number - please try again</span>";
        }

        $conn->close();

        ?>
        <div>
            <a class="btnbackpleadingindex4" tabindex="1" href="../../../messaround4.php">❮&nbsp&nbsp&nbspBack</a>
        </div>

    </body>

</html>