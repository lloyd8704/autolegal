<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css" />
    <title>Contacts Edit</title>
</head>

<body style="background-color: black">
    <div id="test">
        <navi>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../Index.html">Home</a></li>
                <li><a class="nav-link" href="../Pages/newfile.html">New&nbspFile</a></li>
                <li><a class="nav-link" href="../Pages/correspondence.html">Correspondence</a></li>
                <li><a class="nav-link" href="../Pages/pleadings.html">Pleadings</a></li>
                <li><a class="nav-link" href="../Pages/contactshome.html">Contacts</a></li>
                <li><a class="nav-link" href="../Pages/dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-link active" href="edit.php">Edit</a></li>
            </ul>
        </navi>
</body>


<?php
//establish connection to db
require_once '../Pages/connection.php';



// GET CONNECTION ERRORS
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// SQL QUERY
$test = $_POST["reference"];
$query = "SELECT * FROM `contacts` WHERE ref='$test'";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo '<div class="heading3">
    <p>Select the contact you want to edit:</p>
</div>';
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {

        $msg = $row["name"];
        $reference = $row['test'];

        echo "<div class='container'>
                        <form action='../Pages/contactsedit3.php' method='post'>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input type='submit'class='editcontacts' name='register' value='$msg'></div>
                        </form>
                        </div><br><br>";
    }
} else {
    echo "<span class='error'><br>There is no file with that reference number - please try again.</span>";
}


$conn->close();

?>
</div>
<style>
    .editcontacts {
        color: white;
        background-color: black;
        text-decoration: none;
        border: solid 2px white;
        width: 10cm;
        height: 1.5cm;
        font-weight: bold;
        font-family: "Montserrat", sans-serif;
        cursor: pointer;
        left: 476px;
        border-radius: 4px;
        position: relative;
        top: 5px;
    }

    .editcontacts:hover {
        background-color: black;
        color: white;
        border: solid 2px white;
        background: #fff;
        color: #1f1f1f !important;


    }

    body {
        overflow-x: hidden;
    }
</style>

</body>

</html>