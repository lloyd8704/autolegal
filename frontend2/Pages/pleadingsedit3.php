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
                background-color: black;
                font-family: "Montserrat", sans-serif;
                letter-spacing: 0px;
                font-size: 23px;
                text-align: center;
                margin: 0px;
            }

            .container {
                border-radius: 5px;
                padding: 20px;
                margin-top: -20px;
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
                if (($row["number"]) == '1P1D') {

                    $onepname = $row['onepname'];
                    $onedname = $row['onedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<br><br>
                        <div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>
                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '1P2D') {

                    $onepname = $row['onepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '1P3D') {

                    $onepname = $row['onepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '1P4D') {

                    $onepname = $row['onepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '1P5D') {

                    $onepname = $row['onepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $fivedname = $row['fivedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivedname' type='text' class='input1' id='fivedname' value='$fivedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }

                if (($row["number"]) == '1P6D') {

                    $onepname = $row['onepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $fivedname = $row['fivedname'];
                    $sixdname = $row['sixdname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivedname' type='text' class='input1' id='fivedname' value='$fivedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='sixdname' type='text' class='input1' id='sixdname' value='$sixdname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '2P1D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $onedname = $row['onedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>
                        
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '2P2D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>
                                     
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                                    
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '2P3D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>
                                 
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '2P4D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>
                        
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>
                                 
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '2P5D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $fivedname = $row['fivedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>
                                    
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>
                                 
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivedname' type='text' class='input1' id='fivedname' value='$fivedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '2P6D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $fivedname = $row['fivedname'];
                    $sixdname = $row['sixdname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>
                                    
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>
                                 
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivedname' type='text' class='input1' id='fivedname' value='$fivedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='sixdname' type='text' class='input1' id='sixdname' value='$sixdname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '3P1D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $onedname = $row['onedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname'autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>
                                    
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '3P2D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>
                                    
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '3P3D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '3P4D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>
                                        
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '3P5D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $fivedname = $row['fivedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>
                                       
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivedname' type='text' class='input1' id='fivedname' value='$fivedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '3P6D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $fivedname = $row['fivedname'];
                    $sixdname = $row['sixdname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>
                                     
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivedname' type='text' class='input1' id='fivedname' value='$fivedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='sixdname' type='text' class='input1' id='sixdname' value='$sixdname' autocomplete='off' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div><br><br><br><br>
                        </form>
                       
                        </div>
                        ";
                }
                if (($row["number"]) == '4P1D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $onedname = $row['onedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>
                                    
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '4P2D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '4P3D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '4P4D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '4P5D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $fivedname = $row['fivedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivedname' type='text' class='input1' id='fivedname' value='$fivedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div><br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '4P6D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $fivedname = $row['fivedname'];
                    $sixdname = $row['sixdname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivedname' type='text' class='input1' id='fivedname' value='$fivedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='sixdname' type='text' class='input1' id='sixdname' value='$sixdname' autocomplete='off' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div><br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '5P1D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $fivepname = $row['fivepname'];
                    $onedname = $row['onedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivepname' type='text' class='input1' id='fivepname' value='$fivepname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '5P2D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $fivepname = $row['fivepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivepname' type='text' class='input1' id='fivepname' value='$fivepname' autocomplete='off'/>
                        </div>
                        </div>
                                           
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id=twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '5P3D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $fivepname = $row['fivepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivepname' type='text' class='input1' id='fivepname' value='$fivepname' autocomplete='off'/>
                        </div>
                        </div>
                                            
                        <br><br>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id=twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id=threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '5P4D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $fivepname = $row['fivepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivepname' type='text' class='input1' id='fivepname' value='$fivepname' autocomplete='off'/>
                        </div>
                        </div>
                        
                        <br><br>           

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id=twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id=threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id=fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '5P5D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $fivepname = $row['fivepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $fivedname = $row['fivedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivepname' type='text' class='input1' id='fivepname' value='$fivepname' autocomplete='off'/>
                        </div>
                        </div>
                        
                        <br><br>           

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id=twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id=threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id=fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivedname' type='text' class='input1' id=fivedname' value='$fivedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '5P6D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $fivepname = $row['fivepname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $fivedname = $row['fivedname'];
                    $sixdname = $row['sixdname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivepname' type='text' class='input1' id='fivepname' value='$fivepname' autocomplete='off'/>
                        </div>
                        </div>
                        
                        <br><br>           

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id=twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id=threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id=fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivedname' type='text' class='input1' id=fivedname' value='$fivedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='sixdname' type='text' class='input1' id=sixdname' value='$sixdname' autocomplete='off' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>

                        </form>
                        </div>";
                }
                if (($row["number"]) == '6P1D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $fivepname = $row['fivepname'];
                    $sixpname = $row['sixpname'];
                    $onedname = $row['onedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivepname' type='text' class='input1' id='fivepname' value='$fivepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='sixpname' type='text' class='input1' id='sixpname' value='$sixpname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '6P2D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $fivepname = $row['fivepname'];
                    $sixpname = $row['sixpname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivepname' type='text' class='input1' id='fivepname' value='$fivepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='sixpname' type='text' class='input1' id='sixpname' value='$sixpname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                  
                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '6P3D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $fivepname = $row['fivepname'];
                    $sixpname = $row['sixpname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivepname' type='text' class='input1' id='fivepname' value='$fivepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='sixpname' type='text' class='input1' id='sixpname' value='$sixpname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                       
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '6P4D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $fivepname = $row['fivepname'];
                    $sixpname = $row['sixpname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivepname' type='text' class='input1' id='fivepname' value='$fivepname'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='sixpname' type='text' class='input1' id='sixpname' value='$sixpname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '6P5D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $fivepname = $row['fivepname'];
                    $sixpname = $row['sixpname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $fivedname = $row['fivedname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivepname' type='text' class='input1' id='fivepname' value='$fivepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='sixpname' type='text' class='input1' id='sixpname' value='$sixpname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivedname' type='text' class='input1' id='fivedname' value='$fivedname' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        <br><br><br><br>
                        </form>
                        </div>";
                }
                if (($row["number"]) == '6P6D') {

                    $onepname = $row['onepname'];
                    $twopname = $row['twopname'];
                    $threepname = $row['threepname'];
                    $fourpname = $row['fourpname'];
                    $fivepname = $row['fivepname'];
                    $sixpname = $row['sixpname'];
                    $onedname = $row['onedname'];
                    $twodname = $row['twodname'];
                    $threedname = $row['threedname'];
                    $fourdname = $row['fourdname'];
                    $fivedname = $row['fivedname'];
                    $sixdname = $row['sixdname'];
                    $number = $row['number'];
                    $reference = $row['reference'];

                    echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/pleadingsupdate2.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onepname' type='text' class='input1' id='onepname' value='$onepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twopname' type='text' class='input1' id='twopname' value='$twopname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threepname' type='text' class='input1' id='threepname' value='$threepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourpname' type='text' class='input1' id='fourpname' value='$fourpname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivepname' type='text' class='input1' id='fivepname' value='$fivepname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Plaintiff's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='sixpname' type='text' class='input1' id='sixpname' value='$sixpname' autocomplete='off'/>
                        </div>
                        </div>

                        <br><br>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>First Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='onedname' type='text' class='input1' id='onedname' value='$onedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Second Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='twodname' type='text' class='input1' id='twodname' value='$twodname' autocomplete='off'/>
                        </div>
                        </div>
                  
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Third Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='threedname' type='text' class='input1' id='threedname' value='$threedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fourth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fourdname' type='text' class='input1' id='fourdname' value='$fourdname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Fifth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='fivedname' type='text' class='input1' id='fivedname' value='$fivedname' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Sixth Defendant's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='sixdname' type='text' class='input1' id='sixdname' value='$sixdname' autocomplete='off' autocomplete='off'/>
                        </div>
                        </div>

                        <input name='number' type='hidden' id='number' value='$number'/>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>

                        <input type='submit' class='btncorrespondenceedit' name='register' value='Submit'></div>
                        
                        <br><br><br><br>

                        </form>
                        </div>";
                }
            }
        } else echo "<span class='error'><br>There is no file with that reference number - Please try a different reference number</span>";
