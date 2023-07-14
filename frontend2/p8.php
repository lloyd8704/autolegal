<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <title>Add Parties</title>
    <link rel="shortcut icon" type="image/x-icon" href="../frontend2/favicon.ico">

</head>
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

    progress {
        color: white;
        background-color: black;
        margin-left: 95px;
        border: black;
    }

    progress::-webkit-progress-bar {
        background: white;
        border: black;
        border: 2px solid black;

    }

    progress::-webkit-progress-value {
        background: black;
        border: black;
        border: 2px solid black;

    }
</style>

<?php


//connection to db
require_once '../frontend2/Pages/connection.php';
//getting submit button post from p4.php 
isset($_POST['register']);

session_start();
//getting variables from reference and attorneys post in p4.php
$plaintiffs = $_POST['plaintiffs'];
$defendants = $_POST['defendants'];
$number = $plaintiffs . $defendants;

$reference = $_SESSION["reference"];

//$_SESSION['reference'] = $reference;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} //checking the number of attorneys
if ($number  == "1P2D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twodname = $_POST['twodname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twodname= '$twodname', number= '$number' WHERE reference= '$reference'";
} else if ($number  == "1P3D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twodname= '$twodname', threedname= '$threedname', number= '$number' 
    WHERE reference= '$reference'";
} else if ($number  == "1P4D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', 
    number= '$number' WHERE reference= '$reference'";
} else if ($number  == "1P5D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    $fivedname = $_POST['fivedname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', 
    fivedname= '$fivedname', number= '$number' WHERE reference= '$reference'";
} else if ($number  == "1P6D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    $fivedname = $_POST['fivedname'];
    $sixdname = $_POST['sixdname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', 
    fivedname= '$fivedname',sixdname= '$sixdname', number= '$number' WHERE reference= '$reference'";
} else if ($number  == "2P1D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', number= '$number' WHERE reference= '$reference'";
} else if ($number  == "2P2D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $twodname = $_POST['twodname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', twodname= '$twodname', number= '$number' WHERE reference= '$reference'";
} else if ($number  == "2P3D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', twodname= '$twodname', threedname= '$threedname', number= '$number' WHERE reference= '$reference'";
} else if ($number  == "2P4D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', twodname= '$twodname', threedname= '$threedname' , fourdname= '$fourdname', number= '$number' WHERE reference= '$reference'";
} else if ($number  == "2P5D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    $fivedname = $_POST['fivedname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', twodname= '$twodname', threedname= '$threedname' , fourdname= '$fourdname', fivedname= '$fivedname', number= '$number' WHERE reference= '$reference'";
} else if ($number  == "2P6D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    $fivedname = $_POST['fivedname'];
    $sixdname = $_POST['sixdname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', twodname= '$twodname', threedname= '$threedname' , fourdname= '$fourdname', fivedname= '$fivedname', sixdname= '$sixdname', number= '$number' WHERE reference= '$reference'";
}
if ($number  == "3P1D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];

    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', number= '$number' WHERE reference= '$reference'";
}
if ($number  == "3P2D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $twodname = $_POST['twodname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', twodname= '$twodname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "3P3D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', twodname= '$twodname', threedname= '$threedname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "3P4D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "3P5D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    $fivedname = $_POST['fivedname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', fivedname= '$fivedname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "3P6D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    $fivedname = $_POST['fivedname'];
    $sixdname = $_POST['sixdname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', fivedname= '$fivedname', sixdname= '$sixdname',
            number= '$number' WHERE reference= '$reference'";
}
if ($number  == "4P1D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];

    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            number= '$number' WHERE reference= '$reference'";
}

if ($number  == "4P2D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $twodname = $_POST['twodname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname'
            , twodname= '$twodname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "4P3D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname'
            , twodname= '$twodname', threedname= '$threedname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "4P4D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname'
            , twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', number= '$number' 
            WHERE reference= '$reference'";
}

if ($number  == "4P5D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    $fivedname = $_POST['fivedname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname'
            , twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', fivedname= '$fivedname'
            , number= '$number' WHERE reference= '$reference'";
}

if ($number  == "4P6D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    $fivedname = $_POST['fivedname'];
    $sixdname = $_POST['sixdname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname'
            , twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', fivedname= '$fivedname'
            , sixdname= '$sixdname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "5P1D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $fivepname = $_POST['fivepname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            fivepname= '$fivepname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "5P2D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $fivepname = $_POST['fivepname'];
    $twodname = $_POST['twodname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            fivepname= '$fivepname', twodname= '$twodname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "5P3D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $fivepname = $_POST['fivepname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            fivepname= '$fivepname', twodname= '$twodname', threedname= '$threedname', number= '$number' 
            WHERE reference= '$reference'";
}

if ($number  == "5P4D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $fivepname = $_POST['fivepname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            fivepname= '$fivepname', twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', 
            number= '$number' WHERE reference= '$reference'";
}

if ($number  == "5P5D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $fivepname = $_POST['fivepname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    $fivedname = $_POST['fivedname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            fivepname= '$fivepname', twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', 
            fivedname= '$fivedname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "5P6D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $fivepname = $_POST['fivepname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    $fivedname = $_POST['fivedname'];
    $sixdname = $_POST['sixdname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            fivepname= '$fivepname', twodname= '$twodname', threedname= '$threedname', fourdname= '$fourdname', 
            fivedname= '$fivedname', sixdname= '$sixdname', number= '$number' WHERE reference= '$reference'";
}
if ($number  == "6P1D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $fivepname = $_POST['fivepname'];
    $sixpname = $_POST['sixpname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            fivepname= '$fivepname', sixpname= '$sixpname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "6P2D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $fivepname = $_POST['fivepname'];
    $sixpname = $_POST['sixpname'];
    $twodname = $_POST['twodname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            fivepname= '$fivepname', sixpname= '$sixpname', twodname= '$twodname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "6P3D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $fivepname = $_POST['fivepname'];
    $sixpname = $_POST['sixpname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            fivepname= '$fivepname', sixpname= '$sixpname', twodname= '$twodname', threedname= '$threedname', 
            number= '$number' WHERE reference= '$reference'";
}

if ($number  == "6P4D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $fivepname = $_POST['fivepname'];
    $sixpname = $_POST['sixpname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            fivepname= '$fivepname', sixpname= '$sixpname', twodname= '$twodname', threedname= '$threedname', 
            fourdname= '$fourdname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "6P5D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $fivepname = $_POST['fivepname'];
    $sixpname = $_POST['sixpname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    $fivedname = $_POST['fivedname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            fivepname= '$fivepname', sixpname= '$sixpname', twodname= '$twodname', threedname= '$threedname', 
            fourdname= '$fourdname', fivedname= '$fivedname', number= '$number' WHERE reference= '$reference'";
}

if ($number  == "6P6D") {
    //getting submit post from p4.php
    isset($_POST['register']);
    //getting post from attorneyone and setting variable to $attorneyone
    $twopname = $_POST['twopname'];
    $threepname = $_POST['threepname'];
    $fourpname = $_POST['fourpname'];
    $fivepname = $_POST['fivepname'];
    $sixpname = $_POST['sixpname'];
    $twodname = $_POST['twodname'];
    $threedname = $_POST['threedname'];
    $fourdname = $_POST['fourdname'];
    $fivedname = $_POST['fivedname'];
    $sixdname = $_POST['sixdname'];
    //setting the number of opponents manually for the database

    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE Pleadings SET twopname= '$twopname', threepname= '$threepname', fourpname= '$fourpname', 
            fivepname= '$fivepname', sixpname= '$sixpname', twodname= '$twodname', threedname= '$threedname', 
            fourdname= '$fourdname', fivedname= '$fivedname', sixdname= '$sixdname', number= '$number' 
            WHERE reference= '$reference'";
}

//msg if successful
if ($conn->query($sql) === TRUE) {
    echo "<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='stylesheet' href=''>
    <title>Add a Party</title>

</head>

<navi>
    <div class='heading1'>
        <h4>AutoLegal
            <label1 for='file'>Progress:
                <progress id='file' value='60' max='90'></progress>
            </label1>
        </h4>
    </div>
    <ul class='nav-linker'>

    </ul>
</navi><br><br>
</head>

<body style='background-color: black'>
<span class='success'><br>The parties were successfully added!</span><br><br>
    <form action='p9.php' method='post'>
  
   <input type='text' class='col-85' id='input2' hidden name='reference' value='$reference' >
   <input type='submit' class='input20' value='Next &nbsp❯' name='register' tabindex='3' />";
} else {
    //msg if error
    echo "Error updating record: " . $conn->error;
}



$conn->close();
?>
<style>
    .input20[type=submit] {
        background-color: black;
        color: white;
        font-weight: bold;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        border: 2px solid white;
        cursor: pointer;
        margin-top: 0px;
        margin-top: 38px;
        margin-left: 630px;
    }

    .input20[type=submit]:hover {
        background-color: white;
        color: black;
        border: solid 2px black;
        background: #fff;
        color: #1f1f1f !important;

    }

    .input20[type=reset] {
        background-color: black;
        color: white;
        font-weight: bold;
        padding: 13px 28px;
        border: none;
        border-radius: 4px;
        border: 2px solid white;
        cursor: pointer;
    }

    .input20[type=reset]:hover {
        background-color: white;
        color: black;
        border: solid 2px black;
        background: #fff;
        color: #1f1f1f !important;
    }
</style>