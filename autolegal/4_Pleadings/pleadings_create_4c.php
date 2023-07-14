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
    <link rel="stylesheet" href="../9_Style/style.css" />
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
    <title>Create a Pleading</title>
</head>

<body style="background-color: black">
    <nav>
        <div class="heading1">
            <h4>AutoLegal</h4>
        </div>
        <ul class="nav-linker">
            <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
            <li><a class="nav-link" href="../2_New_file/Index.php">New&nbspFile</a></li>
            <li><a class="nav-link" href="../3_Correspondence/Index.php">Correspondence</a></li>
            <li><a class="nav-link active" href="../4_Pleadings/Index.php">Pleadings</a></li>
            <li><a class="nav-link" href="../5_Contacts/Index.php">Contacts</a></li>
            <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
            <li><a class="nav-link" href="../7_Edit/Index.php">Edit</a></li>
            <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
        </ul>
    </nav>

</html>
<?php
require_once "../10_Database/connection.php";

// GET CONNECTION ERRORS
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL QUERY
session_start();
$test = filter_var($_POST["reference"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$_SESSION["reference"] = $_POST["reference"];
$query = "SELECT * FROM `pleadings` WHERE reference='$test'";


// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    include('../4_Pleadings/pleadings_create_5.php');
} else {
    echo "<span class='error'><br>There is no file with that reference number - please try again</span>";
}

$conn->close();
?>