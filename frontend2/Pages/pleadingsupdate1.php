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

        require_once '../Pages/connection.php';
        //getting submit button post from p4.php 

        session_start();
        $reference =  $_POST['reference'];
        $represent =  $_POST['represent'];
        $casenumber =  $_POST['casenumber'];
        $location =  $_POST['location'];
        $ourdetails =  $_POST['ourdetails'];
        $author =  $_POST['author'];
        $courtselection = $_POST['courts'];
        $id = $_POST['id'];

        require "../../frontend2/Pages/database.php";
        if ($_SESSION['reference'] == $_POST['reference']) {
            if ($courtselection == "0") {

                $sql = "UPDATE pleadings SET reference= '$reference', represent= '$represent', casenumber= '$casenumber', 
    location= '$location', ourdetails= '$ourdetails', author= '$author' WHERE id= '$id'";
            }

            if ($courtselection == "1") {
                $mc = strtoupper($_POST['mc']);
                $mcone = strtoupper($_POST['mcone']);
                $court = "IN THE MAGISTRATE\'S COURT FOR THE DISTRICT OF *$mc*\r\nHELD AT *$mcone*";

                $sql = "UPDATE pleadings SET reference= '$reference', represent= '$represent', court= '$court', casenumber= '$casenumber', 
location= '$location', ourdetails= '$ourdetails', author= '$author' WHERE id= '$id'";
            }
            if ($courtselection == "2") {
                $rc = strtoupper($_POST['rc']);
                $mcone = strtoupper($_POST['mcone']);
                $court = "IN THE REGIONAL COURT FOR THE DIVISION OF *$rc*\r\nHELD AT *$mcone*";

                $sql = "UPDATE pleadings SET reference= '$reference', represent= '$represent', court= '$court', casenumber= '$casenumber', 
location= '$location', ourdetails= '$ourdetails', author= '$author' WHERE id= '$id'";
            }

            if ($courtselection == "3") {
                $highcourts = strtoupper($_POST['highcourts']);

                $court = "*IN THE HIGH COURT OF SOUTH AFRICA*\r\n*$highcourts*";

                $sql = "UPDATE pleadings SET reference= '$reference', represent= '$represent', court= '$court', casenumber= '$casenumber', 
location= '$location', ourdetails= '$ourdetails', author= '$author' WHERE id= '$id'";
            }

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } //checking the number of attorneys


            //updating database - updating attorneyone and opponents column


            //msg if successful
            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was sucessfully updated!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        } else {

            $test = $_POST['reference'];
            $query = $pdo->prepare("SELECT * FROM pleadings WHERE reference = ?");
            $query->execute([$test]);
            $result = $query->rowCount();
            if ($result > 0) {
                echo  "<span class='error'><br>This file already exists - Please try again</span>";
            } else {


                if ($courtselection == "0") {

                    $sql = "UPDATE pleadings SET reference= '$reference', casenumber= '$casenumber', 
        location= '$location', ourdetails= '$ourdetails', author= '$author' WHERE id= '$id'";
                }

                if ($courtselection == "1") {
                    $mc = strtoupper($_POST['mc']);
                    $mcone = strtoupper($_POST['mcone']);
                    $court = "IN THE MAGISTRATE\'S COURT FOR THE DISTRICT OF *$mc*\r\nHELD AT *$mcone*";

                    $sql = "UPDATE pleadings SET reference= '$reference', court= '$court', casenumber= '$casenumber', 
    location= '$location', ourdetails= '$ourdetails', author= '$author' WHERE id= '$id'";
                }
                if ($courtselection == "2") {
                    $rc = strtoupper($_POST['rc']);
                    $mcone = strtoupper($_POST['mcone']);
                    $court = "IN THE REGIONAL COURT FOR THE DIVISION OF *$rc*\r\nHELD AT *$mcone*";

                    $sql = "UPDATE pleadings SET reference= '$reference', court= '$court', casenumber= '$casenumber', 
    location= '$location', ourdetails= '$ourdetails', author= '$author' WHERE id= '$id'";
                }

                if ($courtselection == "3") {
                    $highcourts = strtoupper($_POST['highcourts']);

                    $court = "*IN THE HIGH COURT OF SOUTH AFRICA*\r\n*$highcourts*";

                    $sql = "UPDATE pleadings SET reference= '$reference', court= '$court', casenumber= '$casenumber', 
    location= '$location', ourdetails= '$ourdetails', author= '$author' WHERE id= '$id'";
                }

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } //checking the number of attorneys


                //updating database - updating attorneyone and opponents column


                //msg if successful
                if ($conn->query($sql) === TRUE) {
                    echo "<span class='success'><br>Your file was sucessfully updated!</span>";
                } else {
                    //msg if error
                    echo "Error updating record: " . $conn->error;
                }
            }
        }
