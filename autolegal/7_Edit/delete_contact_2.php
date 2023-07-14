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
    <title>Delete a Contact</title>
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

        <?php
        include "../16_insurance/db_connection.php";


        // GET CONNECTION ERRORS
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        // SQL QUERY
        $test = $_SESSION["reference"];
        $query = "SELECT * FROM `contacts` WHERE ref='$test'";

        // FETCHING DATA FROM DATABASE
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo '<div class="heading3">Select the contact you want to delete:</div>';
            // OUTPUT DATA OF EACH ROW
            while ($row = $result->fetch_assoc()) {

                $msg = $row["name"];
                $reference = $row['test'];

                echo "<div class='container'>
                        <form action='../7_Edit/delete_contact_3.php' method='post'>
                        <input name='reference' type='hidden' id='reference' value='$reference'/>
                        <input type='submit'class='editcontacts' name='register' value='$msg'></div>
                        </form>
                        </div><br><br>";
            }
        }

        $conn->close();

        ?>
    </div>
    <style>
        .editcontacts {
            color: white;
            background-color: black;
            text-decoration: none;
            width: 6cm;
            height: 1.5cm;
            font-weight: bold;
            font-family: "Montserrat", sans-serif;
            cursor: pointer;
            left: 534px;
            border-radius: 4px;
            position: relative;
            border: solid 2px white;
            top: 5px;
        }

        .editcontacts:hover {
            background-color: white;
            color: black;
            border: solid 2px white;
            background: #fff;
            color: #1f1f1f !important;


        }
    </style>

</body>

</html>