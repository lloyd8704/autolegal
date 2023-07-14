<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
    <title>Contacts Edit</title>
</head>

<body>


    </ul>
    </nav>

    <div id="test">

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
            require_once '../Pages/connection.php';


            //$_POST["reference"];
            $test = $_POST['reference'];
            $query = "SELECT * FROM `pleadings` WHERE reference='$test'";


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
                        <form action='../Pages/pleadingsupdate3.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='8' cols='40' value='' autofocus='on'>$attorneyone</textarea>
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
                        <form action='../Pages/pleadingsupdate3.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='8' cols='40' value=''>$attorneyone</textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='8' cols='40' value=''>$attorneytwo</textarea>
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
                        <form action='../Pages/pleadingsupdate3.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='8' cols='40' value=''>$attorneyone</textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='8' cols='40' value=''>$attorneytwo</textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>

                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='8' cols='40' value=''>$attorneythree</textarea>
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
                        <form action='../Pages/pleadingsupdate3.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='8' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='8' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='8' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='8' cols='40' value=''>$attorneyfour
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
                        <form action='../Pages/pleadingsupdate3.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='8' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='8' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='8' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='8' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='8' cols='40' value=''>$attorneyfive
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
                        <form action='../Pages/pleadingsupdate3.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='8' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='8' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='8' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='8' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='8' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneysix' rows='8' cols='40' value=''>$attorneysix
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
                        <form action='../Pages/pleadingsupdate3.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='8' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='8' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='8' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='8' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='8' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneysix' rows='8' cols='40' value=''>$attorneysix
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Seventh Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyseven' rows='8' cols='40' value=''>$attorneyseven
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
                        <form action='../Pages/pleadingsupdate3.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='8' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='8' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='8' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='8' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='8' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneysix' rows='8' cols='40' value=''>$attorneysix
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Seventh Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyseven' rows='8' cols='40' value=''>$attorneyseven
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Eighth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyeight' rows='8' cols='40' value=''>$attorneyeight
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
                        <form action='../Pages/pleadingsupdate3.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='8' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='8' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='8' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='8' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='8' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneysix' rows='8' cols='40' value=''>$attorneysix
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Seventh Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyseven' rows='8' cols='40' value=''>$attorneyseven
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Eighth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyeight' rows='8' cols='40' value=''>$attorneyeight
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Ninth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneynine' rows='8' cols='40' value=''>$attorneynine
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
                        <form action='../Pages/pleadingsupdate3.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='8' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='8' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='8' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='8' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='8' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneysix' rows='8' cols='40' value=''>$attorneysix
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Seventh Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyseven' rows='8' cols='40' value=''>$attorneyseven
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Eighth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyeight' rows='8' cols='40' value=''>$attorneyeight
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Ninth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneynine' rows='8' cols='40' value=''>$attorneynine
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Tenth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyten' rows='8' cols='40' value=''>$attorneyten
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
                        <form action='../Pages/pleadingsupdate3.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyone' rows='8' cols='40' value=''>$attorneyone
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneytwo' rows='8' cols='40' value=''>$attorneytwo
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneythree' rows='8' cols='40' value=''>$attorneythree
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfour' rows='8' cols='40' value=''>$attorneyfour
                        </textarea>
                        </div>
                        </div>
    
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyfive' rows='8' cols='40' value=''>$attorneyfive
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneysix' rows='8' cols='40' value=''>$attorneysix
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Seventh Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyseven' rows='8' cols='40' value=''>$attorneyseven
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Eighth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyeight' rows='8' cols='40' value=''>$attorneyeight
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Ninth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneynine' rows='8' cols='40' value=''>$attorneynine
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Tenth Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyten' rows='8' cols='40' value=''>$attorneyten
                        </textarea>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Eleventh Attorney:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='attorneyeleven' rows='8' cols='40' value=''>$attorneyeleven
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
