<?php

// Start the session
session_start();
if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}


// Check if the user submitted the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the reference from the form
    $reference = filter_var($_POST["reference"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Connect to the database
    require_once "../../10_Database/connection.php";

    // Prepare the SQL statement to check if the reference exists in the database
    $stmt = $conn->prepare("SELECT * FROM pleadings WHERE reference=?");
    $stmt->bind_param("s", $reference);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there is a row in the database with the given reference
    if ($result->num_rows == 1) {
        // Set the session variable
        $_SESSION["loggedin"] = true;
        $_SESSION["reference"] = $reference;

        // Return an error message
        echo "error";
    } else {
        // Return a success message
        echo "success";

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

        if ($courtselection == "4") {
            $otherhc = strtoupper($_POST['otherhc']);

            $_SESSION['court'] = "*IN THE HIGH COURT OF SOUTH AFRICA*\r\n*($otherhc)*";
        }

        if ($courtselection == "5") {
            $other = strtoupper($_POST['other']);

            $_SESSION['court'] = "$other";
        }

        $_SESSION['reference'] = strtoupper($_POST['reference']);
        $_SESSION['casenumber'] = $_POST['casenumber'];
        $_SESSION['location'] = strtoupper($_POST['location']);
        $_SESSION['ourdetails'] = $_POST['ourdetails'];
        $_SESSION['author'] = $_POST['author'];
        $_SESSION['represent'] = ucwords($_POST['represent']);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
