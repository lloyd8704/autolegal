<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
    <title>Correspondence</title>
</head>

<body style="background-color: black">
    <navi>
        <div class="heading1">
            <h4>AutoLegal</h4>
        </div>
        <ul class="nav-linker">
            <li><a class="nav-link" href="../Index.html">Home </a></li>
            <li><a class="nav-link" href="newfile.html">New&nbspFile </a></li>
            <li><a class="nav-link" href="correspondence.html">Correspondence</a></li>
            <li><a class="nav-link" href="pleadings.html">Pleadings </a></li>
            <li><a class="nav-link" href="contactshome.html">Contacts</a></li>
            <li><a class="nav-link" href="dropdownlegislation.php">Legislation</a></li>
            <li><a class="nav-link active" href="edit.php">Edit</a></li>
        </ul>
    </navi>

    <?php


    //establish connection to db
    include '../Pages/connection.php';
    //getting submit button post from p4.php 

    //getting variables from reference and attorneys post in p4.php

    $ref = $_POST['ref'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST["email"];
    $theirref = $_POST["theirref"];
    $test = $_POST['ref'] . $_POST["email"];

    $reference = $_POST['reference'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } //checking the number of attorneys


    //updating database - updating attorneyone and opponents column
    $sql = "UPDATE contacts SET ref = '$ref', name = '$name', phone= '$phone', email= '$email', theirref= '$theirref', test= '$test' WHERE test= '$reference'";

    //msg if successful
    if ($conn->query($sql) === TRUE) {
        echo "<span class='success'><br>Your file was sucessfully created!</span>";
    } else {
        //msg if error
        echo "Error updating record: " . $conn->error;
    }
