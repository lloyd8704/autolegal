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

        require_once '../10_Database/connection.php';
        //getting submit button post from p4.php 


        $reference = filter_var($_POST['reference'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $represent =  filter_var($_POST['represent'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $casenumber =  filter_var($_POST['casenumber'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $location =  filter_var($_POST['location'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ourdetails =  filter_var($_POST['ourdetails'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $author =  filter_var($_POST['author'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $courtselection = filter_var($_POST['courts'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = filter_var($_POST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        require "../10_Database/database.php";
        if ($_SESSION['reference'] == filter_var($_POST['reference'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
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

            $test = filter_var($_POST['reference'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
        ?>