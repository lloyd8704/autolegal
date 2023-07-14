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
    <title>Contacts Edit</title>
</head>

<body style="background-color: black">
    <div id="test">
        <nav>
            <div class="heading1">
                <h4>AutoLegal</h4>
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
</body>

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
require_once '../10_Database/connection.php';

//$_POST["reference"];
$test = $_POST['reference'];
// prepare the query with a placeholder
$query = "SELECT * FROM `contacts` WHERE test=?";

// create a prepared statement
$stmt = $conn->prepare($query);

// bind the parameter to the statement
$stmt->bind_param("s", $test);

// execute the statement
$stmt->execute();

// get the result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (isset($row["phone"])) {
            $ref = htmlspecialchars($row['ref']);
            $name = htmlspecialchars($row["name"]);
            $phone = htmlspecialchars($row["phone"]);
            $email = htmlspecialchars($row["email"]);
            $theirref = htmlspecialchars($row["theirref"]);
            $reference = htmlspecialchars($row['test']);
            echo "<div class='container'>
                        <h1 class='heading4'><br>Edit</h1>
                        <form action='../7_Edit/edit_contacts_4.php' method='post'>
                        
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
?>