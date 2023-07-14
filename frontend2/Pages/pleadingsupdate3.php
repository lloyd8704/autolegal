<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
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


        //connection to db
        require_once '../Pages/connection.php';


        $reference =  $_POST['reference'];
        $opponents =  $_POST['opponents'];

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } //checking the number of attorneys
        if ($opponents == "1") {

            $attorneyone = $_POST['attorneyone'];

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

            $attorneyone = $_POST['attorneyone'];
            $attorneytwo = $_POST['attorneytwo'];

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

            $attorneyone = $_POST['attorneyone'];
            $attorneytwo = $_POST['attorneytwo'];
            $attorneythree = $_POST['attorneythree'];

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

            $attorneyone = $_POST['attorneyone'];
            $attorneytwo = $_POST['attorneytwo'];
            $attorneythree = $_POST['attorneythree'];
            $attorneyfour = $_POST['attorneyfour'];

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

            $attorneyone = $_POST['attorneyone'];
            $attorneytwo = $_POST['attorneytwo'];
            $attorneythree = $_POST['attorneythree'];
            $attorneyfour = $_POST['attorneyfour'];
            $attorneyfive = $_POST['attorneyfive'];

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

            $attorneyone = $_POST['attorneyone'];
            $attorneytwo = $_POST['attorneytwo'];
            $attorneythree = $_POST['attorneythree'];
            $attorneyfour = $_POST['attorneyfour'];
            $attorneyfive = $_POST['attorneyfive'];
            $attorneysix = $_POST['attorneysix'];

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

            $attorneyone = $_POST['attorneyone'];
            $attorneytwo = $_POST['attorneytwo'];
            $attorneythree = $_POST['attorneythree'];
            $attorneyfour = $_POST['attorneyfour'];
            $attorneyfive = $_POST['attorneyfive'];
            $attorneysix = $_POST['attorneysix'];
            $attorneyseven = $_POST['attorneyseven'];

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

            $attorneyone = $_POST['attorneyone'];
            $attorneytwo = $_POST['attorneytwo'];
            $attorneythree = $_POST['attorneythree'];
            $attorneyfour = $_POST['attorneyfour'];
            $attorneyfive = $_POST['attorneyfive'];
            $attorneysix = $_POST['attorneysix'];
            $attorneyseven = $_POST['attorneyseven'];
            $attorneyeight = $_POST['attorneyeight'];

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

            $attorneyone = $_POST['attorneyone'];
            $attorneytwo = $_POST['attorneytwo'];
            $attorneythree = $_POST['attorneythree'];
            $attorneyfour = $_POST['attorneyfour'];
            $attorneyfive = $_POST['attorneyfive'];
            $attorneysix = $_POST['attorneysix'];
            $attorneyseven = $_POST['attorneyseven'];
            $attorneyeight = $_POST['attorneyeight'];
            $attorneynine = $_POST['attorneynine'];

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

            $attorneyone = $_POST['attorneyone'];
            $attorneytwo = $_POST['attorneytwo'];
            $attorneythree = $_POST['attorneythree'];
            $attorneyfour = $_POST['attorneyfour'];
            $attorneyfive = $_POST['attorneyfive'];
            $attorneysix = $_POST['attorneysix'];
            $attorneyseven = $_POST['attorneyseven'];
            $attorneyeight = $_POST['attorneyeight'];
            $attorneynine = $_POST['attorneynine'];
            $attorneyten = $_POST['attorneyten'];

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

            $attorneyone = $_POST['attorneyone'];
            $attorneytwo = $_POST['attorneytwo'];
            $attorneythree = $_POST['attorneythree'];
            $attorneyfour = $_POST['attorneyfour'];
            $attorneyfive = $_POST['attorneyfive'];
            $attorneysix = $_POST['attorneysix'];
            $attorneyseven = $_POST['attorneyseven'];
            $attorneyeight = $_POST['attorneyeight'];
            $attorneynine = $_POST['attorneynine'];
            $attorneyten = $_POST['attorneyten'];
            $attorneyeleven = $_POST['attorneyeleven'];

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
    
    
    //msg if successful
