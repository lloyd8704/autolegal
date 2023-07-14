<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Generate Pleading Database</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../12_Icons/favicon.ico">
    <link rel="stylesheet" href="../../9_Style/style.css" />

    <?php

    $courtselection = $_SESSION['courts'];
    if ($courtselection == "1") {
        $mc = strtoupper($_POST['mc']);
        $mcone = strtoupper($_POST['mcone']);
        $_SESSION['court'] = "IN THE MAGISTRATE'S COURT FOR THE DISTRICT OF *$mc*\r\nHELD AT *$mcone*";
    }
    if ($courtselection == "2") {
        $rc = strtoupper($_POST['rc']);
        $mcone = strtoupper($_POST['mcone']);
        $_SESSION['court'] = "IN THE REGIONAL COURT FOR THE DIVISION OF *$rc*\r\nHELD AT *$mcone*";
    }

    if ($courtselection == "3") {
        $highcourts = strtoupper($_POST['highcourts']);

        $_SESSION['court'] = "*IN THE HIGH COURT OF SOUTH AFRICA*\r\n*$highcourts*";
    }

    if ($courtselection == "4") {
        $otherhc = strtoupper($_POST['otherhc']);

        $_SESSION['court'] = "*IN THE HIGH COURT OF SOUTH AFRICA*\r\n*$otherhc*";
    }

    if ($courtselection == "5") {
        $other = strtoupper($_POST['other']);

        $_SESSION['court'] = "$other";
    }

    require "../../10_Database/database.php";
    readfile("../New_file_pleading/new_file_pleading_database_2.php");


    ?>
    <div class="container test-center register">

        <?php if (isset($error)) {
            echo $error;
        } ?>
        <?php if (isset($msg)) {
            echo $msg;
        } ?>
        <style>
            .error {
                color: #D8000C;
                background-color: #FFBABA;
                background-image: url('../frontend2/Documents/error.png');
                pointer-events: none;
                font-family: "Montserrat", sans-serif;
                font-size: 16px;
                font-weight: bold;
            }


            .info,
            .success,
            .warning,
            .error,
            .validation {

                display: flex;
                border: 1px solid;
                margin: 18px 0px;
                padding: 3px 20px 15px 55px;
                background-repeat: no-repeat;
                background-position: 10px 12px;
            }
        </style>