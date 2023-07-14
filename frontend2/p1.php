<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Generate Pleading Database</title>
    <link rel="shortcut icon" type="image/x-icon" href="../frontend2/favicon.ico">
    <link rel="stylesheet" href="" />

    <?php
    session_start();
    $courtselection = $_POST['courts'];
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
    $_SESSION['reference'] = strtoupper($_POST['reference']);
    $_SESSION['casenumber'] = $_POST['casenumber'];
    $_SESSION['location'] = strtoupper($_POST['location']);
    $_SESSION['ourdetails'] = $_POST['ourdetails'];
    $_SESSION['author'] = $_POST['author'];
    $_SESSION['represent'] = ucfirst($_POST['represent']);
    require "../frontend2/Pages/database.php";
    if (($_POST['reference']) == "") {
        echo "Reference number is required";
    } else {
        $test = $_SESSION['reference'];
        $query = $pdo->prepare("SELECT * FROM pleadings WHERE reference = ?");
        $query->execute([$test]);
        $result = $query->rowCount();
        if ($result > 0) {
            header("Location: ../frontend2/generatorp.php?error=<span class='error'><br>This file already exists - Please try again.</span>");
        } else  readfile("p2.1.php");
    }
    $_SESSION['reference'] = $_POST['reference'];
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