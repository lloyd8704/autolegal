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

        //connection to db
        require_once '../10_Database/connection.php';

        $reference =  filter_var($_POST['reference'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $opponents =  filter_var($_POST['opponents'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } //checking the number of attorneys
        if ($opponents == "1") {

            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET attorneyone= '$attorneyone' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was sucessfully created!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if ($opponents == "2") {

            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo' 
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was sucessfully created!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if ($opponents == "3") {

            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', 
        attorneythree= '$attorneythree' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was sucessfully created!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if ($opponents == "4") {

            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', 
        attorneythree= '$attorneythree', attorneyfour= '$attorneyfour' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was sucessfully created!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if ($opponents == "5") {

            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', 
        attorneythree= '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive' 
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was sucessfully created!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if ($opponents == "6") {

            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $attorneysix = mysqli_real_escape_string($conn, $_POST['attorneysix']);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', 
        attorneythree= '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive',
        attorneysix= '$attorneysix' 
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was sucessfully created!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if ($opponents == "7") {

            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $attorneysix = mysqli_real_escape_string($conn, $_POST['attorneysix']);
            $attorneyseven = mysqli_real_escape_string($conn, $_POST['attorneyseven']);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', 
        attorneythree= '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive',
        attorneysix= '$attorneysix', attorneyseven= '$attorneyseven' 
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was sucessfully created!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if ($opponents == "8") {

            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $attorneysix = mysqli_real_escape_string($conn, $_POST['attorneysix']);
            $attorneyseven = mysqli_real_escape_string($conn, $_POST['attorneyseven']);
            $attorneyeight = mysqli_real_escape_string($conn, $_POST['attorneyeight']);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', 
        attorneythree= '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive',
        attorneysix= '$attorneysix', attorneyseven= '$attorneyseven', attorneyeight= '$attorneyeight' 
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was sucessfully created!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if ($opponents == "9") {

            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $attorneysix = mysqli_real_escape_string($conn, $_POST['attorneysix']);
            $attorneyseven = mysqli_real_escape_string($conn, $_POST['attorneyseven']);
            $attorneyeight = mysqli_real_escape_string($conn, $_POST['attorneyeight']);
            $attorneynine = mysqli_real_escape_string($conn, $_POST['attorneynine']);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', 
        attorneythree= '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive',
        attorneysix= '$attorneysix', attorneyseven= '$attorneyseven', attorneyeight= '$attorneyeight', 
        attorneynine= '$attorneynine' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was sucessfully created!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if ($opponents == "10") {

            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $attorneysix = mysqli_real_escape_string($conn, $_POST['attorneysix']);
            $attorneyseven = mysqli_real_escape_string($conn, $_POST['attorneyseven']);
            $attorneyeight = mysqli_real_escape_string($conn, $_POST['attorneyeight']);
            $attorneynine = mysqli_real_escape_string($conn, $_POST['attorneynine']);
            $attorneyten = mysqli_real_escape_string($conn, $_POST['attorneyten']);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', 
        attorneythree= '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive',
        attorneysix= '$attorneysix', attorneyseven= '$attorneyseven', attorneyeight= '$attorneyeight', 
        attorneynine= '$attorneynine', attorneyten= '$attorneyten' WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was sucessfully created!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        if ($opponents == "11") {

            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $attorneysix = mysqli_real_escape_string($conn, $_POST['attorneysix']);
            $attorneyseven = mysqli_real_escape_string($conn, $_POST['attorneyseven']);
            $attorneyeight = mysqli_real_escape_string($conn, $_POST['attorneyeight']);
            $attorneynine = mysqli_real_escape_string($conn, $_POST['attorneynine']);
            $attorneyten = mysqli_real_escape_string($conn, $_POST['attorneyten']);
            $attorneyeleven = mysqli_real_escape_string($conn, $_POST['attorneyeleven']);

            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', 
        attorneythree= '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive',
        attorneysix= '$attorneysix', attorneyseven= '$attorneyseven', attorneyeight= '$attorneyeight', 
        attorneynine= '$attorneynine', attorneyten= '$attorneyten', attorneyeleven= '$attorneyeleven'
        WHERE reference= '$reference'";

            if ($conn->query($sql) === TRUE) {
                echo "<span class='success'><br>Your file was sucessfully created!</span>";
            } else {
                //msg if error
                echo "Error updating record: " . $conn->error;
            }
        }
        ?>