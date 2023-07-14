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
    <title>Edit Correspondence</title>
</head>

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
    $reference = filter_var($_POST['reference'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $ref = filter_var($_POST['ref'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $subject = filter_var($_POST["subject"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contact = filter_var($_POST["contact"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $theirref = filter_var($_POST["theirref"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $recipient = filter_var($_POST["recipient"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $test = filter_var($_POST['ref'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . filter_var($_POST["email"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $eparagraph = filter_var($_POST["eparagraph"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $author = filter_var($_POST["author"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $reference = filter_var($_POST['reference'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $savelocation = $_POST['saveLocation'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } //checking the number of attorneys
    if ($savelocation == "") {

        //updating database - updating attorneyone and opponents column
        $sql = "UPDATE correspondence SET ref = '$ref', email = '$email', subject= '$subject', 
    contact= '$contact', theirref= '$theirref', recipient= '$recipient', test= '$test', eparagraph='$eparagraph', author = '$author' WHERE test= '$reference'";
    } else if ($savelocation == "prompt") {
        $number = "";
        //updating database - updating attorneyone and opponents column
        $sql = "UPDATE correspondence SET ref = '$ref', email = '$email', subject= '$subject', 
    contact= '$contact', theirref= '$theirref', recipient= '$recipient', test= '$test', eparagraph='$eparagraph', author = '$author', number='$number' WHERE test= '$reference'";
    } else if (isset($_POST['register'])) {
        $number = $_POST['path1'];
        //updating database - updating attorneyone and opponents column
        $sql = "UPDATE correspondence SET ref = '$ref', email = '$email', subject= '$subject', 
    contact= '$contact', theirref= '$theirref', recipient= '$recipient', test= '$test', eparagraph='$eparagraph', author = '$author', number='$number' WHERE test= '$reference'";
    }
    //msg if successful
    if ($conn->query($sql) === TRUE) {
        echo "<span class='success'><br>Your file was sucessfully created!</span>";
    } else {
        //msg if error
        echo "Error updating record: " . $conn->error;
    }
    ?>