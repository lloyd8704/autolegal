<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
    <title>Contacts Edit</title>
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
    //establish connection to db
    require_once '../Pages/connection.php';


    //$_POST["reference"];
    $test = $_POST['reference'];
    $query = "SELECT * FROM `contacts` WHERE test='$test'";


    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (isset($row["phone"])) {
                $ref = $row['ref'];
                $name = $row["name"];
                $phone = $row["phone"];
                $email = $row["email"];
                $theirref = $row["theirref"];
                $reference = $row['test'];

                echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../Pages/contactsupdate.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>*Reference number:</label>
                        </div>
                        <div class='col-75'>
                        <input name='ref' type='text' class='input1' id='ref' value='$ref' autofocus='on' required autocomplete='off'/> 
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>*Contact's name:</label>
                        </div>
                        <div class='col-75'>
                        <input name='name' type='text' class='input1' id='name' value='$name' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Contact's phone number:</label>
                        </div>
                        <div class='col-75'>
                        <input name='phone' type='text' class='input1' id='phone' value='$phone' autocomplete='off'/>
                        </div>
                        </div>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Contact's email address:</label>
                        </div>
                        <div class='col-75'>
                        <input name='email' type='text' class='input1' id='email' value='$email' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>Contact's reference:</label>
                        </div>
                        <div class='col-75'>
                        <input name='theirref' type='text' class='input1' id='theirref' value='$theirref' autocomplete='off'/>
                        </div>
                        </div>

                        
                        <div class='col-75'>
                        <input name='reference' type='hidden' id='reference' value='$reference' />
                        </div>
                        </div>
                        
                        <input type='submit' class='btncontactsedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
            } else
                $phone = "";
        }
    }
