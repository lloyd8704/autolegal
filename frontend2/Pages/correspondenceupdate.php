<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
    <title>Edit Correspondence</title>
</head>

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

    //getting variables from reference and attorneys post in p4.php

    $ref = $_POST['ref'];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $contact = $_POST["contact"];
    $theirref = $_POST["theirref"];
    $recipient = $_POST["recipient"];
    $test = $_POST['ref'] . $_POST["email"];
    $eparagraph = $_POST["eparagraph"];
    $author = $_POST["author"];

    $reference = $_POST['reference'];
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
