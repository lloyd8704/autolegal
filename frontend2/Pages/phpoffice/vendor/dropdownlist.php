<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Select a Pleading</title>
    <link rel="stylesheet" href="../../../app.css" />

<body>
    <div id="test">
        <nav>
            <div class="heading">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linkerb">
                <li><a class="nav-linked" href="../../../Index.html">Home</a></li>
                <li><a class="nav-linked" href="../../newfile.html">New&nbspFile</a></li>
                <li><a class="nav-linked" href="../../correspondence.html">Correspondence</a></li>
                <li><a class="nav-linked active" href="../../pleadings.html">Pleadings</a></li>
                <li><a class="nav-linked " href="../../contactshome.html">Contacts</a></li>
                <li><a class="nav-linked" href="../../dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-linked" href="../../edit.php">Edit</a></li>
            </ul>
        </nav>
        <style>
            .container {
                max-width: 350px;
                margin: 50px auto;
                text-align: center;
            }

            input[type="submit"] {
                margin-bottom: 20px;
                left: 0px;
            }

            .select-block {
                width: 300px;
                margin: 110px auto 30px;

            }

            select {
                width: 100%;
                height: 50px;
                font-size: 100%;
                font-weight: bold;
                cursor: pointer;
                border-radius: 0;
                background-color: black;
                border: none;
                border: 2px solid black;
                border-radius: 4px;
                color: white;
                appearance: none;
                padding: 8px 38px 10px 18px;
                -webkit-appearance: none;
                -moz-appearance: none;
                transition: color 0.3s ease, background-color 0.3s ease, border-bottom-color 0.3s ease;
                left: 0px;
                top: -105px;
            }

            /* For IE <= 11 */
            select::-ms-expand {
                display: none;
            }

            select:hover,
            select:focus {
                color: #000000;
                background-color: white;
                border: 2px solid black;
            }

            .hexagonssend {
                display: block;
                margin-top: -349px;

            }

            .hexagons2send {
                display: block;
                position: absolute;
                left: 956px;
                top: 341px;

            }
        </style>
        <div class="body-text">
            <h1>Select a Pleading:</h1>
        </div>
        <form action="" method="post" class="mb-3">
            <div class="select-block">
                <select name="Pleadings">
                    <option value disabled selected> Select an item</option>
                    <option value="noticeofbar">Notice of Bar</option>
                    <option value="noticetodefend">Notice of Intention to Defend</option>
                    <option value="rule23notice">Rule 23 Notices</option>
                    <option value="rule35">Rule 35 Notices</option>
                    <option value="summons">Summons - HC</option>
                </select>

            </div>
            <input type="submit" class="input4" name="submit" value="View">
        </form>

        <?php

        if (isset($_POST['submit'])) {
            if (!empty($_POST['Pleadings'])) {
                $selected = $_POST['Pleadings'];
                if ($selected == "noticeofbar") { // The location of the PDF file
                    // on the server
                    $file = "C:\Users\Lloyd\Desktop\PROJECT\PLEADINGS\NOTICE OF BAR.pdf";

                    $fp = fopen($file, "r");

                    header("Cache-Control: maxage=1");
                    header("Pragma: public");
                    header("Content-type: application/pdf");
                    header("Content-Disposition: inline; filename=" . $myFileName . "");
                    header("Content-Description: PHP Generated Data");
                    header("Content-Transfer-Encoding: binary");
                    header('Content-Length:' . filesize($file));
                    ob_clean();
                    flush();
                    while (!feof($fp)) {
                        $buff = fread($fp, 1024);
                        print $buff;
                    }
                }
                if (!empty($_POST['Pleadings'])) {
                    $selected = $_POST['Pleadings'];
                    if ($selected == "summons") { // The location of the PDF file
                        // on the server
                        $file = "C:\Users\Lloyd\Desktop\PROJECT\PLEADINGS\summonshc.pdf";

                        $fp = fopen($file, "r");

                        header("Cache-Control: maxage=1");
                        header("Pragma: public");
                        header("Content-type: application/pdf");
                        header("Content-Disposition: inline; filename=" . $myFileName . "");
                        header("Content-Description: PHP Generated Data");
                        header("Content-Transfer-Encoding: binary");
                        header('Content-Length:' . filesize($file));
                        ob_clean();
                        flush();
                        while (!feof($fp)) {
                            $buff = fread($fp, 1024);
                            @readfile($buff);
                        }
                    }
                    if (!empty($_POST['Pleadings'])) {
                        $selected = $_POST['Pleadings'];
                        if ($selected == "noticetodefend") { // The location of the PDF file
                            // on the server
                            $file = "C:\Users\Lloyd\Desktop\PROJECT\PLEADINGS\\noticeofintentiontodefend.pdf";

                            $fp = fopen($file, "r");

                            header("Cache-Control: maxage=1");
                            header("Pragma: public");
                            header("Content-type: application/pdf");
                            header("Content-Disposition: inline; filename=" . $myFileName . "");
                            header("Content-Description: PHP Generated Data");
                            header("Content-Transfer-Encoding: binary");
                            header('Content-Length:' . filesize($file));
                            ob_clean();
                            flush();
                            while (!feof($fp)) {
                                $buff = fread($fp, 1024);
                                print $buff;
                            }
                        }
                    }
                    if (!empty($_POST['Pleadings'])) {
                        $selected = $_POST['Pleadings'];
                        if ($selected == "rule23notice") { // The location of the PDF file
                            // on the server
                            $file = "C:\Users\Lloyd\Desktop\PROJECT\PLEADINGS\\rule23.pdf";

                            $fp = fopen($file, "r");

                            header("Cache-Control: maxage=1");
                            header("Pragma: public");
                            header("Content-type: application/pdf");
                            header("Content-Disposition: inline; filename=" . $myFileName . "");
                            header("Content-Description: PHP Generated Data");
                            header("Content-Transfer-Encoding: binary");
                            header('Content-Length:' . filesize($file));
                            ob_clean();
                            flush();
                            while (!feof($fp)) {
                                $buff = fread($fp, 1024);
                                print $buff;
                            }
                        }
                    }
                    if (!empty($_POST['Pleadings'])) {
                        $selected = $_POST['Pleadings'];
                        if ($selected == "rule35") { // The location of the PDF file
                            // on the server
                            $file = "C:\Users\Lloyd\Desktop\PROJECT\PLEADINGS\\rule35.pdf";

                            $fp = fopen($file, "r");

                            header("Cache-Control: maxage=1");
                            header("Pragma: public");
                            header("Content-type: application/pdf");
                            header("Content-Disposition: inline; filename=" . $myFileName . "");
                            header("Content-Description: PHP Generated Data");
                            header("Content-Transfer-Encoding: binary");
                            header('Content-Length:' . filesize($file));
                            ob_clean();
                            flush();
                            while (!feof($fp)) {
                                $buff = fread($fp, 1024);
                                print $buff;
                            }
                        }
                    }
                    exit;
                };
            } else {
                echo "<p align='center'><font size='4pt'> Please select a pleading</font> </p>";
            }
        }

        ?>
        <img src="../../../Documents/hex3black.png" class="hexagonssend" alt="Outline of three hexagons">
        <img src="../../../Documents/hex2black.png" class="hexagons2send" alt="Outline of two hexagons">
        <style>
            p {
                color: red;
                font-weight: bold;
                animation-name: disappear, slideout;
                animation-duration: 5s, 5s;
                animation-iteration-count: 1;
                animation-fill-mode: forwards;
            }


            @keyframes disappear {

                100% {
                    opacity: 0;
                }

            }

            @keyframes slideout {
                100% {
                    visibility: hidden;
                }
            }
        </style>

    </div>

</body>


</html>