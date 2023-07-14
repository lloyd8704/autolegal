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
    <title>Add a Party</title>

</head>
<div id="test">

    <body style="background-color: black">
        <nav>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">

            </ul>
        </nav>
        </head>

        <?php
        //connection to db
        require_once '../10_Database/connection.php';
        //getting submit button post from p4.php 
        isset($_POST['register']);

        //getting variables from reference and attorneys post in p4.php
        $reference = $_SESSION['reference'];
        $attorneys = $_POST['attorneys'];

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } //checking the number of attorneys
        if ($attorneys  == "1O") {
            //getting submit post from p4.php
            isset($_POST['register']);
            //getting post from attorneyone and setting variable to $attorneyone
            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            //setting the number of opponents manually for the database
            $opponents = "1";
            //updating database - updating attorneyone and opponents column
            $sql = "UPDATE Pleadings SET attorneyone= '$attorneyone', opponents= '$opponents' WHERE reference= '$reference'";
        } else if ($attorneys  == "2O") {
            isset($_POST['register']);
            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $opponents = "2";

            $sql = "UPDATE Pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', opponents= '$opponents' 
    WHERE reference= '$reference'";
        } else if ($attorneys  == "3O") {
            isset($_POST['register']);
            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $opponents = "3";

            $sql = "UPDATE Pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', attorneythree= 
    '$attorneythree', opponents= '$opponents'  WHERE reference= '$reference'";
        } else if ($attorneys  == "4O") {
            isset($_POST['register']);
            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $opponents = "4";

            $sql = "UPDATE Pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', attorneythree= 
    '$attorneythree', attorneyfour= '$attorneyfour', opponents= '$opponents' WHERE reference= '$reference'";
        } else if ($attorneys  == "5O") {
            isset($_POST['register']);
            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $opponents = "5";

            $sql = "UPDATE Pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', attorneythree= 
    '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive'
    , opponents= '$opponents' WHERE reference= '$reference'";
        } else if ($attorneys  == "6O") {
            isset($_POST['register']);
            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $attorneysix = mysqli_real_escape_string($conn, $_POST['attorneysix']);
            $opponents = "6";

            $sql = "UPDATE Pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', attorneythree= 
    '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive', attorneysix= '$attorneysix'
    , opponents= '$opponents' WHERE reference= '$reference'";
        } else if ($attorneys  == "7O") {
            isset($_POST['register']);
            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $$attorneysix = mysqli_real_escape_string($conn, $_POST['attorneysix']);
            $attorneyseven = mysqli_real_escape_string($conn, $_POST['attorneyseven']);
            $opponents = "7";

            $sql = "UPDATE Pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', attorneythree= 
    '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive', attorneysix= '$attorneysix'
    ,attorneyseven= '$attorneyseven', opponents= '$opponents'  WHERE reference= '$reference'";
        } else if ($attorneys  == "8O") {
            isset($_POST['register']);
            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $$attorneysix = mysqli_real_escape_string($conn, $_POST['attorneysix']);
            $attorneyseven = mysqli_real_escape_string($conn, $_POST['attorneyseven']);
            $attorneyeight = mysqli_real_escape_string($conn, $_POST['attorneyeight']);
            $opponents = "8";

            $sql = "UPDATE Pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', attorneythree= 
    '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive', attorneysix= '$attorneysix'
    ,attorneyseven= '$attorneyseven',attorneyeight= '$attorneyeight', opponents= '$opponents' 
    WHERE reference= '$reference'";
        } else if ($attorneys  == "9O") {
            isset($_POST['register']);
            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $$attorneysix = mysqli_real_escape_string($conn, $_POST['attorneysix']);
            $attorneyseven = mysqli_real_escape_string($conn, $_POST['attorneyseven']);
            $attorneyeight = mysqli_real_escape_string($conn, $_POST['attorneyeight']);
            $attorneynine = mysqli_real_escape_string($conn, $_POST['attorneynine']);
            $opponents = "9";

            $sql = "UPDATE Pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', attorneythree= 
    '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive', attorneysix= '$attorneysix'
    ,attorneyseven= '$attorneyseven',attorneyeight= '$attorneyeight',attorneynine= '$attorneynine', opponents= '$opponents' 
    WHERE reference= '$reference'";
        } else if ($attorneys  == "10O") {
            isset($_POST['register']);
            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $$attorneysix = mysqli_real_escape_string($conn, $_POST['attorneysix']);
            $attorneyseven = mysqli_real_escape_string($conn, $_POST['attorneyseven']);
            $attorneyeight = mysqli_real_escape_string($conn, $_POST['attorneyeight']);
            $attorneynine = mysqli_real_escape_string($conn, $_POST['attorneynine']);
            $attorneyten = mysqli_real_escape_string($conn, $_POST['attorneyten']);
            $opponents = "10";

            $sql = "UPDATE Pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', attorneythree= 
    '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive', attorneysix= '$attorneysix'
    ,attorneyseven= '$attorneyseven',attorneyeight= '$attorneyeight',attorneynine= '$attorneynine'
    ,attorneyten= '$attorneyten', opponents= '$opponents'  WHERE reference= '$reference'";
        } else if ($attorneys  == "11O") {
            isset($_POST['register']);
            $attorneyone = mysqli_real_escape_string($conn, $_POST['attorneyone']);
            $attorneytwo = mysqli_real_escape_string($conn, $_POST['attorneytwo']);
            $attorneythree = mysqli_real_escape_string($conn, $_POST['attorneythree']);
            $attorneyfour = mysqli_real_escape_string($conn, $_POST['attorneyfour']);
            $attorneyfive = mysqli_real_escape_string($conn, $_POST['attorneyfive']);
            $$attorneysix = mysqli_real_escape_string($conn, $_POST['attorneysix']);
            $attorneyseven = mysqli_real_escape_string($conn, $_POST['attorneyseven']);
            $attorneyeight = mysqli_real_escape_string($conn, $_POST['attorneyeight']);
            $attorneynine = mysqli_real_escape_string($conn, $_POST['attorneynine']);
            $attorneyten = mysqli_real_escape_string($conn, $_POST['attorneyten']);
            $attorneyeleven = mysqli_real_escape_string($conn, $_POST['attorneyeleven']);
            $opponents = "10";

            $sql = "UPDATE Pleadings SET attorneyone= '$attorneyone', attorneytwo= '$attorneytwo', attorneythree= 
    '$attorneythree', attorneyfour= '$attorneyfour', attorneyfive= '$attorneyfive', attorneysix= '$attorneysix'
    ,attorneyseven= '$attorneyseven',attorneyeight= '$attorneyeight',attorneynine= '$attorneynine'
    ,attorneyten= '$attorneyten',attorneyeleven= '$attorneyeleven', opponents= '$opponents' WHERE reference= '$reference'";
        }
        //msg if successful
        if ($conn->query($sql) === TRUE) {
            echo "<span class='success'><br>Your file was sucessfully created!</span>";
        } else {
            //msg if error
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
        ?>
        <style>
            .success {
                color: #4F8A10;
                background-color: #DFF2BF;
                background-image: url(../frontend2/Documents/success.png);
                pointer-events: none;
                font-weight: bold;
            }

            .info,
            .success,
            .warning,
            .error,
            .validation {
                display: flex;
                border: 1px solid;
                position: absolute;
                left: 502px;
                top: 85px;

                padding: 0px 67px 14px 75px;
                background-repeat: no-repeat;
                background-position: 10px 12px;

            }
        </style>
        <a class="btnpleading" tabindex="1" href="../7_Edit/edit_pleadings_1.php">❮&nbsp&nbsp&nbspBack</a>