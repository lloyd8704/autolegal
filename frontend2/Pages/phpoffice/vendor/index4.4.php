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
                <li><a class="nav-link" id="plus" href="../../extras.html">+</a></li>
            </ul>
        </navi>


        <?php
        session_start();


        $judgmentdebt1 = $_POST['input1'];
        $judgmentdebt2 = str_replace(',', '', $judgmentdebt1);
        $judgmentdebt = number_format($judgmentdebt2, 2, '.', ',');
        if ($judgmentdebt2 <= 7000) {
            $costs = "165.00";
        } else if ($judgmentdebt2 > 7000 && $judgmentdebt2 <= 50000) {
            $costs = "547.00";
        } else if ($judgmentdebt2 > 50000 && $judgmentdebt2 <= 200000) {
            $costs = "808.00";
        } else $costs = "1055.00";



        $name1 = $_SESSION['Pleadings'];
        if (str_contains($name1, '- Code WI')) {
            $rate = $_POST['rate'];
            if ($testinterest = $_POST['interest'] == '') {
                $testinterest1 = "0";
            } elseif ($testinterest = $_POST['interest']) {
                $testinterest1 = number_format($testinterest, 2, '.', ',');
            }
        }
        if (str_contains($name1, '- Code W0')) {
            $rate = "10.25";
            $testinterest1 = "0";
        }

        $costswarrant = "121.50";
        $vat1 = 0.155 * ($costs + $costswarrant);
        $vat = number_format($vat1, 2, '.', ',');
        $subtotal1 = $judgmentdebt2 + $costs + $testinterest1 + $costswarrant + $vat;
        $subtotal = number_format($subtotal1, 2, '.', ',');
        $paid1 = $_POST['input2'];
        $paid2 = str_replace(',', '', $paid1);
        $paid = number_format($paid2, 2, '.', ',');
        $total1 = $subtotal1 - $paid2;
        $total = number_format($total1, 2, '.', ',');
        $name2 = $_SESSION['Pleadings'];
        $name1 = substr($name2, 0, strrpos($name2, '-'));

        $debtorname = $_POST["input8"];
        $addrestype = $_POST["input9"];
        $debtoraddress = $_POST["input10"];

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
        $input3 = $costswarrant;
        $input4 = $vat;
        $input5 = $subtotal;
        $input6 = $paid;
        $input7 = $total;
        $input8 = $debtorname;
        $input9 = $addrestype;
        $input10 = $debtoraddress;
        $input11 = $testinterest1;
        $input12 = $rate;
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);

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

                    include('index4saving.php');
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
                    $attorneyone = "hello";
                    $attorneytwo = $row["attorneytwo"];
                    $savename = strtoupper($name1) . " (" . date('Y-m-d') . ")";
                    $firstplaintiff = "";
                    $firstdefendant = "First";
                    $author = $row["author"];
                    $authorwithcaps = strtoupper($row["authorwithcaps"]);
                    $represent = $row["represent"];
                    $representcaps = strtoupper($represent);
                    $reference = $row["reference"];
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                    }
                    if ($opponents == 2) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneyone);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneyone', $input6);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneytwo', $input8);

                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
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
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);

                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);

                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);

                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);

                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
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
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
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
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);


                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);


                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);


                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);


                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }
                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
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
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
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
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
                        $templateProcessor->cloneBlock("attorneytwo", 0);
                        $templateProcessor->cloneBlock("attorneytwod", 0);
                        $templateProcessor->cloneBlock("attorneythree", 0);
                        $templateProcessor->cloneBlock("attorneythreed", 0);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
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
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }
                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }
                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }

                    if ($opponents == 9) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input19 = str_replace("\n", "<w:br />", $attorneynine);
                        $input20 = str_replace('&', '&amp;', $input19);
                        $templateProcessor->setValue('attorneynine', $input20);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);
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
                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);
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
                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);
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
                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }
                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);
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
                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                    }
                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                    }

                    if ($opponents == 9) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input19 = str_replace("\n", "<w:br />", $attorneynine);
                        $input20 = str_replace('&', '&amp;', $input19);
                        $templateProcessor->setValue('attorneynine', $input20);
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
                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }
                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 9) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input19 = str_replace("\n", "<w:br />", $attorneynine);
                        $input20 = str_replace('&', '&amp;', $input19);
                        $templateProcessor->setValue('attorneynine', $input20);

                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 10) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input19 = str_replace("\n", "<w:br />", $attorneynine);
                        $input20 = str_replace('&', '&amp;', $input19);
                        $templateProcessor->setValue('attorneynine', $input20);

                        $templateProcessor->cloneBlock("attorneytend", 1);
                        $input21 = str_replace("\n", "<w:br />", $attorneyten);
                        $input22 = str_replace('&', '&amp;', $input21);
                        $templateProcessor->setValue('attorneyten', $input22);
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
                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
                        $templateProcessor->cloneBlock("attorneyfour", 0);
                        $templateProcessor->cloneBlock("attorneyfourd", 0);
                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }
                    if ($opponents == 4) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfive", 0);
                        $templateProcessor->cloneBlock("attorneyfived", 0);
                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 5) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysix", 0);
                        $templateProcessor->cloneBlock("attorneysixd", 0);
                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 6) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                    }

                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneyseven", 0);
                        $templateProcessor->cloneBlock("attorneysevend", 0);
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 7) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                    }

                    if ($opponents == 9) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input19 = str_replace("\n", "<w:br />", $attorneynine);
                        $input20 = str_replace('&', '&amp;', $input19);
                        $templateProcessor->setValue('attorneynine', $input20);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }
                    if ($opponents == 3) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeight", 0);
                        $templateProcessor->cloneBlock("attorneyeightd", 0);
                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 8) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 9) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input19 = str_replace("\n", "<w:br />", $attorneynine);
                        $input20 = str_replace('&', '&amp;', $input19);
                        $templateProcessor->setValue('attorneynine', $input20);

                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                    }

                    if ($opponents == 10) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input19 = str_replace("\n", "<w:br />", $attorneynine);
                        $input20 = str_replace('&', '&amp;', $input19);
                        $templateProcessor->setValue('attorneynine', $input20);

                        $templateProcessor->cloneBlock("attorneytend", 1);
                        $input21 = str_replace("\n", "<w:br />", $attorneyten);
                        $input22 = str_replace('&', '&amp;', $input21);
                        $templateProcessor->setValue('attorneyten', $input22);
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

                    include('index4saving.php');
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
                    $save = $row['save'];
                    $filename1 = $row["author"];
                    $filename = $row["author"];

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

                    $templateProcessor->setValue('debt', $input1);
                    $templateProcessor->setValue('costs', $input2);
                    $templateProcessor->setValue('costwarrant', $input3);
                    $templateProcessor->setValue('vat', $input4);
                    $templateProcessor->setValue('subtotal', $input5);
                    $templateProcessor->setValue('paid', $input6);
                    $templateProcessor->setValue('total', $input7);

                    $templateProcessor->setValue('debtorname', $input8);
                    $templateProcessor->setValue('addresstype', $input9);
                    $templateProcessor->setValue('debtoraddress', $input10);
                    $templateProcessor->setValue('interest', $input11);
                    $templateProcessor->setValue('interestrate', $input12);


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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);
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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

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
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynine", 0);
                        $templateProcessor->cloneBlock("attorneynined", 0);
                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }

                    if ($opponents == 9) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input19 = str_replace("\n", "<w:br />", $attorneynine);
                        $input20 = str_replace('&', '&amp;', $input19);
                        $templateProcessor->setValue('attorneynine', $input20);

                        $templateProcessor->cloneBlock("attorneyten", 0);
                        $templateProcessor->cloneBlock("attorneytend", 0);
                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }
                    if ($opponents == 10) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input19 = str_replace("\n", "<w:br />", $attorneynine);
                        $input20 = str_replace('&', '&amp;', $input19);
                        $templateProcessor->setValue('attorneynine', $input20);

                        $templateProcessor->cloneBlock("attorneytend", 1);
                        $input21 = str_replace("\n", "<w:br />", $attorneyten);
                        $input22 = str_replace('&', '&amp;', $input21);
                        $templateProcessor->setValue('attorneyten', $input22);

                        $templateProcessor->cloneBlock("attorneyeleven", 0);
                        $templateProcessor->cloneBlock("attorneyelevend", 0);
                    }
                    if ($opponents == 11) {
                        $templateProcessor->cloneBlock("attorneyoned", 1);
                        $input3 = str_replace("\n", "<w:br />", $attorneyone);
                        $input4 = str_replace('&', '&amp;', $input3);
                        $templateProcessor->setValue('attorneyone', $input4);

                        $templateProcessor->cloneBlock("attorneytwod", 1);
                        $input5 = str_replace("\n", "<w:br />", $attorneytwo);
                        $input6 = str_replace('&', '&amp;', $input5);
                        $templateProcessor->setValue('attorneytwo', $input6);

                        $templateProcessor->cloneBlock("attorneythreed", 1);
                        $input7 = str_replace("\n", "<w:br />", $attorneythree);
                        $input8 = str_replace('&', '&amp;', $input7);
                        $templateProcessor->setValue('attorneythree', $input8);

                        $templateProcessor->cloneBlock("attorneyfourd", 1);
                        $input9 = str_replace("\n", "<w:br />", $attorneyfour);
                        $input10 = str_replace('&', '&amp;', $input9);
                        $templateProcessor->setValue('attorneyfour', $input10);

                        $templateProcessor->cloneBlock("attorneyfived", 1);
                        $input11 = str_replace("\n", "<w:br />", $attorneyfive);
                        $input12 = str_replace('&', '&amp;', $input11);
                        $templateProcessor->setValue('attorneyfive', $input12);

                        $templateProcessor->cloneBlock("attorneysixd", 1);
                        $input13 = str_replace("\n", "<w:br />", $attorneysix);
                        $input14 = str_replace('&', '&amp;', $input13);
                        $templateProcessor->setValue('attorneysix', $input14);

                        $templateProcessor->cloneBlock("attorneysevend", 1);
                        $input15 = str_replace("\n", "<w:br />", $attorneyseven);
                        $input16 = str_replace('&', '&amp;', $input15);
                        $templateProcessor->setValue('attorneyseven', $input16);

                        $templateProcessor->cloneBlock("attorneyeightd", 1);
                        $input17 = str_replace("\n", "<w:br />", $attorneyeight);
                        $input18 = str_replace('&', '&amp;', $input17);
                        $templateProcessor->setValue('attorneyeight', $input18);

                        $templateProcessor->cloneBlock("attorneynined", 1);
                        $input19 = str_replace("\n", "<w:br />", $attorneynine);
                        $input20 = str_replace('&', '&amp;', $input19);
                        $templateProcessor->setValue('attorneynine', $input20);

                        $templateProcessor->cloneBlock("attorneytend", 1);
                        $input21 = str_replace("\n", "<w:br />", $attorneyten);
                        $input22 = str_replace('&', '&amp;', $input21);
                        $templateProcessor->setValue('attorneyten', $input22);

                        $templateProcessor->cloneBlock("attorneyelevend", 1);
                        $input23 = str_replace("\n", "<w:br />", $attorneyeleven);
                        $input24 = str_replace('&', '&amp;', $input23);
                        $templateProcessor->setValue('attorneyeleven', $input24);
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


                    include('index4saving.php');
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