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
    <title>Edit Pleadings</title>
</head>
<div id="test">

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
        </style>
        </head>
        <style>
            .heading4 {
                color: white;

                font-family: "Montserrat", sans-serif;
                letter-spacing: 0px;
                font-size: 23px;
                text-align: center;
                margin: 0px;
            }
        </style>
        <?php

        //connection to db
        require_once '../10_Database/connection.php';


        //$_POST["reference"];
        $reference = ($_SESSION['reference']);
        $query = "SELECT * FROM `pleadings` WHERE reference='$reference'";


        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (($row["opponents"]) == '1') {

                    $attorneyone = $row['attorneyone'];

                    $reference = $row['reference'];
                    $opponents = $row['opponents'];

                    echo "<br><br>
                        <div class='container'>
                        <h1 class='heading4'>Edit</h1>
                        <form action='../7_Edit/edit_pleadings_3c.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='10' cols='40' value='' autofocus='on'>$attorneyone</textarea>
                        </div>
                        </div>
                                     
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input name='opponents' type='hidden' id='reference' value='$opponents'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["opponents"]) == '2') {

                    $attorneyone = $row['attorneyone'];
                    $attorneytwo = $row['attorneytwo'];

                    $reference = $row['reference'];
                    $opponents = $row['opponents'];

                    echo "<br><br><div class='container'>
                        <h1 class='heading4'>Edit</h1>
                        <form action='../7_Edit/edit_pleadings_3c.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='10' cols='40' value=''>$attorneyone</textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='10' cols='40' value=''>$attorneytwo</textarea>
                        </div>
                        </div>
                                     
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input name='opponents' type='hidden' id='reference' value='$opponents'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["opponents"]) == '3') {

                    $attorneyone = $row['attorneyone'];
                    $attorneytwo = $row['attorneytwo'];
                    $attorneythree = $row['attorneythree'];

                    $reference = $row['reference'];
                    $opponents = $row['opponents'];

                    echo "<br><br><div class='container'>
                        <h1 class='heading4'>Edit</h1>
                        <form action='../7_Edit/edit_pleadings_3c.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='10' cols='40' value=''>$attorneyone</textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='10' cols='40' value=''>$attorneytwo</textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>

                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='10' cols='40' value=''>$attorneythree</textarea>
                        </div>
                        </div>
                                     
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input name='opponents' type='hidden' id='reference' value='$opponents'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["opponents"]) == '4') {

                    $attorneyone = $row['attorneyone'];
                    $attorneytwo = $row['attorneytwo'];
                    $attorneythree = $row['attorneythree'];
                    $attorneyfour = $row['attorneyfour'];

                    $reference = $row['reference'];
                    $opponents = $row['opponents'];

                    echo "<br><br><div class='container'>
                        <h1 class='heading4'>Edit</h1>
                        <form action='../7_Edit/edit_pleadings_3c.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='10' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='10' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='10' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='10' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
                                     
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input name='opponents' type='hidden' id='reference' value='$opponents'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["opponents"]) == '5') {

                    $attorneyone = $row['attorneyone'];
                    $attorneytwo = $row['attorneytwo'];
                    $attorneythree = $row['attorneythree'];
                    $attorneyfour = $row['attorneyfour'];
                    $attorneyfive = $row['attorneyfive'];

                    $reference = $row['reference'];
                    $opponents = $row['opponents'];

                    echo "<br><br><div class='container'>
                        <h1 class='heading4'>Edit</h1>
                        <form action='../7_Edit/edit_pleadings_3c.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='10' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='10' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='10' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='10' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='10' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>
                                     
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input name='opponents' type='hidden' id='reference' value='$opponents'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["opponents"]) == '6') {

                    $attorneyone = $row['attorneyone'];
                    $attorneytwo = $row['attorneytwo'];
                    $attorneythree = $row['attorneythree'];
                    $attorneyfour = $row['attorneyfour'];
                    $attorneyfive = $row['attorneyfive'];
                    $attorneysix = $row['attorneysix'];

                    $reference = $row['reference'];
                    $opponents = $row['opponents'];

                    echo "<br><br><div class='container'>
                        <h1 class='heading4'>Edit</h1>
                        <form action='../7_Edit/edit_pleadings_3c.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='10' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='10' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='10' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='10' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='10' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneysix' rows='10' cols='40' value=''>$attorneysix
                        </textarea>
                        </div>
                        </div>
                                     
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input name='opponents' type='hidden' id='reference' value='$opponents'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["opponents"]) == '7') {

                    $attorneyone = $row['attorneyone'];
                    $attorneytwo = $row['attorneytwo'];
                    $attorneythree = $row['attorneythree'];
                    $attorneyfour = $row['attorneyfour'];
                    $attorneyfive = $row['attorneyfive'];
                    $attorneysix = $row['attorneysix'];
                    $attorneyseven = $row['attorneyseven'];

                    $reference = $row['reference'];
                    $opponents = $row['opponents'];

                    echo "<br><br><div class='container'>
                        <h1 class='heading4'>Edit</h1>
                        <form action='../7_Edit/edit_pleadings_3c.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='10' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='10' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='10' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='10' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='10' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneysix' rows='10' cols='40' value=''>$attorneysix
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Seventh Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyseven' rows='10' cols='40' value=''>$attorneyseven
                        </textarea>
                        </div>
                        </div>
                                     
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input name='opponents' type='hidden' id='reference' value='$opponents'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["opponents"]) == '8') {

                    $attorneyone = $row['attorneyone'];
                    $attorneytwo = $row['attorneytwo'];
                    $attorneythree = $row['attorneythree'];
                    $attorneyfour = $row['attorneyfour'];
                    $attorneyfive = $row['attorneyfive'];
                    $attorneysix = $row['attorneysix'];
                    $attorneyseven = $row['attorneyseven'];
                    $attorneyeight = $row['attorneyeight'];

                    $reference = $row['reference'];
                    $opponents = $row['opponents'];

                    echo "<br><br><div class='container'>
                        <h1 class='heading4'>Edit</h1>
                        <form action='../7_Edit/edit_pleadings_3c.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='10' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='10' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='10' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='10' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='10' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneysix' rows='10' cols='40' value=''>$attorneysix
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Seventh Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyseven' rows='10' cols='40' value=''>$attorneyseven
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Eighth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyeight' rows='10' cols='40' value=''>$attorneyeight
                        </textarea>
                        </div>
                        </div>
                                     
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input name='opponents' type='hidden' id='reference' value='$opponents'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["opponents"]) == '9') {

                    $attorneyone = $row['attorneyone'];
                    $attorneytwo = $row['attorneytwo'];
                    $attorneythree = $row['attorneythree'];
                    $attorneyfour = $row['attorneyfour'];
                    $attorneyfive = $row['attorneyfive'];
                    $attorneysix = $row['attorneysix'];
                    $attorneyseven = $row['attorneyseven'];
                    $attorneyeight = $row['attorneyeight'];
                    $attorneynine = $row['attorneynine'];

                    $reference = $row['reference'];
                    $opponents = $row['opponents'];

                    echo "<br><br><div class='container'>
                        <h1 class='heading4'>Edit</h1>
                        <form action='../7_Edit/edit_pleadings_3c.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='10' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='10' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='10' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='10' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='10' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneysix' rows='10' cols='40' value=''>$attorneysix
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Seventh Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyseven' rows='10' cols='40' value=''>$attorneyseven
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Eighth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyeight' rows='10' cols='40' value=''>$attorneyeight
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Ninth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneynine' rows='10' cols='40' value=''>$attorneynine
                        </textarea>
                        </div>
                        </div>
                                     
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input name='opponents' type='hidden' id='reference' value='$opponents'/>
                        
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["opponents"]) == '10') {

                    $attorneyone = $row['attorneyone'];
                    $attorneytwo = $row['attorneytwo'];
                    $attorneythree = $row['attorneythree'];
                    $attorneyfour = $row['attorneyfour'];
                    $attorneyfive = $row['attorneyfive'];
                    $attorneysix = $row['attorneysix'];
                    $attorneyseven = $row['attorneyseven'];
                    $attorneyeight = $row['attorneyeight'];
                    $attorneynine = $row['attorneynine'];
                    $attorneyten = $row['attorneyten'];

                    $reference = $row['reference'];
                    $opponents = $row['opponents'];

                    echo "<br><br><div class='container'>
                        <h1 class='heading4'>Edit</h1>
                        <form action='../7_Edit/edit_pleadings_3c.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='10' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='10' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='10' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='10' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='10' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneysix' rows='10' cols='40' value=''>$attorneysix
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Seventh Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyseven' rows='10' cols='40' value=''>$attorneyseven
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Eighth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyeight' rows='10' cols='40' value=''>$attorneyeight
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Ninth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneynine' rows='10' cols='40' value=''>$attorneynine
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Tenth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyten' rows='10' cols='40' value=''>$attorneyten
                        </textarea>
                        </div>
                        </div>
                                     
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input name='opponents' type='hidden' id='reference' value='$opponents'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["opponents"]) == '11') {

                    $attorneyone = $row['attorneyone'];
                    $attorneytwo = $row['attorneytwo'];
                    $attorneythree = $row['attorneythree'];
                    $attorneyfour = $row['attorneyfour'];
                    $attorneyfive = $row['attorneyfive'];
                    $attorneysix = $row['attorneysix'];
                    $attorneyseven = $row['attorneyseven'];
                    $attorneyeight = $row['attorneyeight'];
                    $attorneynine = $row['attorneynine'];
                    $attorneyten = $row['attorneyten'];
                    $attorneyeleven = $row['attorneyeleven'];

                    $reference = $row['reference'];
                    $opponents = $row['opponents'];

                    echo "<br><br><div class='container'>
                        <h1 class='heading4'>Edit</h1>
                        <form action='../7_Edit/edit_pleadings_3c.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='10' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='10' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='10' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='10' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='10' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneysix' rows='10' cols='40' value=''>$attorneysix
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Seventh Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyseven' rows='10' cols='40' value=''>$attorneyseven
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Eighth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyeight' rows='10' cols='40' value=''>$attorneyeight
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Ninth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneynine' rows='10' cols='40' value=''>$attorneynine
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Tenth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyten' rows='10' cols='40' value=''>$attorneyten
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Eleventh Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyeleven' rows='10' cols='40' value=''>$attorneyeleven
                        </textarea>
                        </div>
                        </div>
                                     
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input name='opponents' type='hidden' id='reference' value='$opponents'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>
                        </form>
                        </div>";
                }
            }
        } else echo "<span class='error'><br>There is no file with that reference number - Please try a different reference number</span>";
        ?>