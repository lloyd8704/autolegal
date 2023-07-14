<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
    <title>Edit Pleadings</title>
</head>
<div id="test">

    <body>
        <navi>
            <div class="heading1">
                <h4>AutoLegal</h4>

                <body style="background-color: black">
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../Index.html">Home</a></li>
                <li><a class="nav-link" href="../Pages/newfile.html">New&nbspFile</a></li>
                <li><a class="nav-link" href="../Pages/correspondence.html">Correspondence</a></li>
                <li><a class="nav-link" href="../Pages/pleadings.html">Pleadings</a></li>
                <li><a class="nav-link" href="../Pages/contactshome.html">Contacts</a></li>
                <li><a class="nav-link" href="../Pages/dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-link active" href="../Pages/edit.php">Edit</a></li>
            </ul>
        </navi>

        <?php

        $server = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'correspdb';


        $conn = new mysqli($server, $user, $pass, $db);
        //getting submit button post from p4.php 


        $reference =  $_POST['reference'];
        $number =  $_POST['number'];
        $onepname =  $_POST['onepname'];
        $onedname =  $_POST['onedname'];

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } //checking the number of attorneys
        if (($number =  $_POST['number']) == "1P1D") {

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET onepname= '$onepname', onedname= '$onedname' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was successfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if (($number =  $_POST['number']) == "1P2D") {

            $twodname =  $_POST['twodname'];
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
        if (($number =  $_POST['number']) == "1P3D") {

            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
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
        if (($number =  $_POST['number']) == "1P4D") {

            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
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
        if (($number =  $_POST['number']) == "1P5D") {

            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
            $fivedname =  $_POST['fivedname'];
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
        if (($number =  $_POST['number']) == "1P6D") {

            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
            $fivedname =  $_POST['fivedname'];
            $sixdname =  $_POST['sixdname'];
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
        if (($number =  $_POST['number']) == "2P1D") {

            $twopname =  $_POST['twopname'];
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
        if (($number =  $_POST['number']) == "2P2D") {

            $twopname =  $_POST['twopname'];
            $twodname =  $_POST['twodname'];
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
        if (($number =  $_POST['number']) == "2P3D") {

            $twopname =  $_POST['twopname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
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
        if (($number =  $_POST['number']) == "2P4D") {

            $twopname =  $_POST['twopname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
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
        if (($number =  $_POST['number']) == "2P5D") {

            $twopname =  $_POST['twopname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
            $fivedname =  $_POST['fivedname'];
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
        if (($number =  $_POST['number']) == "2P6D") {

            $twopname =  $_POST['twopname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
            $fivedname =  $_POST['fivedname'];
            $sixdname =  $_POST['sixdname'];
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
        if (($number =  $_POST['number']) == "3P1D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];

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
        if (($number =  $_POST['number']) == "3P2D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $twodname =  $_POST['twodname'];

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
        if (($number =  $_POST['number']) == "3P3D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];

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
        if (($number =  $_POST['number']) == "3P4D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];

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
        if (($number =  $_POST['number']) == "3P5D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
            $fivedname =  $_POST['fivedname'];

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
        if (($number =  $_POST['number']) == "3P6D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
            $fivedname =  $_POST['fivedname'];
            $sixdname =  $_POST['sixdname'];

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
        if (($number =  $_POST['number']) == "4P1D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];

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
        if (($number =  $_POST['number']) == "4P2D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $twodname =  $_POST['twodname'];

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
        if (($number =  $_POST['number']) == "4P3D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];

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
        if (($number =  $_POST['number']) == "4P4D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];

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
        if (($number =  $_POST['number']) == "4P5D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
            $fivedname =  $_POST['fivedname'];

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
        if (($number =  $_POST['number']) == "4P6D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
            $fivedname =  $_POST['fivedname'];
            $sixdname =  $_POST['sixdname'];

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
        if (($number =  $_POST['number']) == "5P1D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $fivepname =  $_POST['fivepname'];

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
        if (($number =  $_POST['number']) == "5P2D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $fivepname =  $_POST['fivepname'];
            $twodname =  $_POST['twodname'];

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
        if (($number =  $_POST['number']) == "5P3D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $fivepname =  $_POST['fivepname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];

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
        if (($number =  $_POST['number']) == "5P4D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $fivepname =  $_POST['fivepname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];

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
        if (($number =  $_POST['number']) == "5P5D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $fivepname =  $_POST['fivepname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
            $fivedname =  $_POST['fivedname'];

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
        if (($number =  $_POST['number']) == "5P6D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $fivepname =  $_POST['fivepname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
            $fivedname =  $_POST['fivedname'];
            $sixdname =  $_POST['sixdname'];

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
        if (($number =  $_POST['number']) == "6P1D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $fivepname =  $_POST['fivepname'];
            $sixpname =  $_POST['sixpname'];

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
        if (($number =  $_POST['number']) == "6P2D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $fivepname =  $_POST['fivepname'];
            $sixpname =  $_POST['sixpname'];
            $twodname =  $_POST['twodname'];

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
        if (($number =  $_POST['number']) == "6P3D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $fivepname =  $_POST['fivepname'];
            $sixpname =  $_POST['sixpname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];

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
        if (($number =  $_POST['number']) == "6P4D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $fivepname =  $_POST['fivepname'];
            $sixpname =  $_POST['sixpname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];

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
        if (($number =  $_POST['number']) == "6P5D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $fivepname =  $_POST['fivepname'];
            $sixpname =  $_POST['sixpname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
            $fivedname =  $_POST['fivedname'];

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
        if (($number =  $_POST['number']) == "6P6D") {

            $twopname =  $_POST['twopname'];
            $threepname =  $_POST['threepname'];
            $fourpname =  $_POST['fourpname'];
            $fivepname =  $_POST['fivepname'];
            $sixpname =  $_POST['sixpname'];
            $twodname =  $_POST['twodname'];
            $threedname =  $_POST['threedname'];
            $fourdname =  $_POST['fourdname'];
            $fivedname =  $_POST['fivedname'];
            $sixdname =  $_POST['sixdname'];

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
    //msg if successful
