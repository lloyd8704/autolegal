<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../frontend2/app.css">
    <title>Edit Pleadings</title>
</head>
<div id="test">

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
        session_start();
        require_once '../Pages/connection.php';
        $reference =  $_SESSION['reference'];
        $savelocation = $_POST['saveLocation'];


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //if the user fails to make a selection.
        if ($savelocation == "prompt") {
            $number = "";

            $sql = "UPDATE pleadings SET save = '$number' WHERE reference= '$reference'";
        }
        if ($savelocation == "folder") {
            $number = $_POST['path1'];


            $sql = "UPDATE pleadings SET save = '$number' WHERE reference= '$reference'";
        }

        // Check connection
        //updating database - updating attorneyone and opponents column


        if ($conn->query($sql) === TRUE) {
            echo "<span class='success'><br>Your file was sucessfully created!</span>";
        } else {
            //msg if error
            echo "Error updating record: " . $conn->error;
        }
