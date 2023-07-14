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
    <link rel="stylesheet" href="../9_Style/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
    <title>Edit Pleadings</title>
</head>
<div id="test">

    <body>
        <nav>
            <div class="heading1">
                <h4>AutoLegal</h4>

                <body style="background-color: black">
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
                <li><a class="nav-link" href="../2_New_file/Index.php">New&nbspFile</a></li>
                <li><a class="nav-link" href="../3_Correspondence/Index.php">Correspondence</a></li>
                <li><a class="nav-link" href="../4_Pleadings/Index.php">Pleadings</a></li>
                <li><a class="nav-link" href="../5_Contacts/Index.php">Contacts</a></li>
                <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
                <li><a class="nav-link active" href="../7_Edit/Index.php">Edit</a></li>
                <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
            </ul>
        </nav>
        <?php

        include "../16_insurance/db_connection.php";
        //getting submit button post from p4.php 


        $reference =  filter_var($_POST['reference'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $onepname =  filter_var($_POST['onepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $onedname =  filter_var($_POST['onedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } //checking the number of attorneys
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "1P1D") {

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', onedname= '$onedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "1P2D") {

            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', onedname= '$onedname', twodname= '$twodname' 
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "1P3D") {

            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', onedname= '$onedname', twodname= '$twodname', 
        threedname= '$threedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "1P4D") {

            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', onedname= '$onedname', twodname= '$twodname', 
        threedname= '$threedname', fourdname= '$fourdname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "1P5D") {

            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivedname =  filter_var($_POST['fivedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', onedname= '$onedname', twodname= '$twodname', 
        threedname= '$threedname', fourdname= '$fourdname', fivedname= '$fivedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "1P6D") {

            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivedname =  filter_var($_POST['fivedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sixdname =  filter_var($_POST['sixdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', onedname= '$onedname', twodname= '$twodname', 
        threedname= '$threedname', fourdname= '$fourdname', fivedname= '$fivedname', sixdname= '$sixdname' 
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "2P1D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', onedname= '$onedname' 
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "2P2D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', onedname= '$onedname', 
        twodname= '$twodname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "2P3D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', onedname= '$onedname', 
        twodname= '$twodname', threedname= '$threedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "2P4D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', onedname= '$onedname', 
        twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "2P5D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivedname =  filter_var($_POST['fivedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', onedname= '$onedname', 
        twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', fivedname= '$fivedname'  
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "2P6D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivedname =  filter_var($_POST['fivedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sixdname =  filter_var($_POST['sixdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', onedname= '$onedname', 
        twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', fivedname= '$fivedname',
        sixdname= '$sixdname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "3P1D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        onedname= '$onedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "3P2D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        onedname= '$onedname', twodname= '$twodname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "3P3D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        onedname= '$onedname', twodname= '$twodname', threedname= '$threedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "3P4D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        onedname= '$onedname', twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname'
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "3P5D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivedname =  filter_var($_POST['fivedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        onedname= '$onedname', twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', 
        fivedname= '$fivedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "3P6D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivedname =  filter_var($_POST['fivedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sixdname =  filter_var($_POST['sixdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        onedname= '$onedname', twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', 
        fivedname= '$fivedname', sixdname= '$sixdname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "4P1D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', onedname= '$onedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "4P2D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', onedname= '$onedname', twodname= '$twodname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "4P3D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', onedname= '$onedname', twodname= '$twodname', threedname= '$threedname'
         WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "4P4D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', onedname= '$onedname', twodname= '$twodname', threedname= '$threedname',
        fourdname= '$fourdname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "4P5D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivedname =  filter_var($_POST['fivedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', onedname= '$onedname', twodname= '$twodname', threedname= '$threedname',
        fourdname= '$fourdname', fivedname= '$fivedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "4P6D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivedname =  filter_var($_POST['fivedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sixdname =  filter_var($_POST['sixdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', onedname= '$onedname', twodname= '$twodname', threedname= '$threedname',
        fourdname= '$fourdname', fivedname= '$fivedname', sixdname= '$sixdname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "5P1D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivepname =  filter_var($_POST['fivepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', fivepname= '$fivepname', onedname= '$onedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "5P2D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivepname =  filter_var($_POST['fivepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', fivepname= '$fivepname', onedname= '$onedname',
        twodname= '$twodname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "5P3D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivepname =  filter_var($_POST['fivepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', fivepname= '$fivepname', onedname= '$onedname',
        twodname= '$twodname', threedname= '$threedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "5P4D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivepname =  filter_var($_POST['fivepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', fivepname= '$fivepname', onedname= '$onedname',
        twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "5P5D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivepname =  filter_var($_POST['fivepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivedname =  filter_var($_POST['fivedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', fivepname= '$fivepname', onedname= '$onedname', twodname= '$twodname', 
        threedname= '$threedname', fourdname= '$fourdname',  fivedname= '$fivedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "5P6D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivepname =  filter_var($_POST['fivepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivedname =  filter_var($_POST['fivedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sixdname =  filter_var($_POST['sixdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', fivepname= '$fivepname', onedname= '$onedname', twodname= '$twodname', 
        threedname= '$threedname', fourdname= '$fourdname', fivedname= '$fivedname', sixdname= '$sixdname'
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "6P1D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivepname =  filter_var($_POST['fivepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sixpname =  filter_var($_POST['sixpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', fivepname= '$fivepname',sixpname= '$sixpname', onedname= '$onedname' 
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "6P2D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivepname =  filter_var($_POST['fivepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sixpname =  filter_var($_POST['sixpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', fivepname= '$fivepname',sixpname= '$sixpname', onedname= '$onedname', 
        twodname= '$twodname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "6P3D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivepname =  filter_var($_POST['fivepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sixpname =  filter_var($_POST['sixpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', fivepname= '$fivepname',sixpname= '$sixpname', onedname= '$onedname', 
        twodname= '$twodname', threedname= '$threedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "6P4D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivepname =  filter_var($_POST['fivepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sixpname =  filter_var($_POST['sixpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', fivepname= '$fivepname',sixpname= '$sixpname', onedname= '$onedname', 
        twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname' 
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "6P5D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivepname =  filter_var($_POST['fivepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sixpname =  filter_var($_POST['sixpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivedname =  filter_var($_POST['fivedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', fivepname= '$fivepname',sixpname= '$sixpname', onedname= '$onedname', 
        twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', fivedname= '$fivedname'  
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  filter_var($_POST['number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) == "6P6D") {

            $twopname =  filter_var($_POST['twopname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threepname =  filter_var($_POST['threepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourpname =  filter_var($_POST['fourpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivepname =  filter_var($_POST['fivepname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sixpname =  filter_var($_POST['sixpname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $twodname =  filter_var($_POST['twodname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $threedname =  filter_var($_POST['threedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fourdname =  filter_var($_POST['fourdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $fivedname =  filter_var($_POST['fivedname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sixdname =  filter_var($_POST['sixdname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', twopname= '$twopname', threepname= '$threepname',
        fourpname= '$fourpname', fivepname= '$fivepname',sixpname= '$sixpname', onedname= '$onedname', 
        twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', fivedname= '$fivedname',  
        sixdname= '$sixdname'WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        ?>