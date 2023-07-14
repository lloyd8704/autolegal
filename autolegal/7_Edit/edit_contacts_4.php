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
    </div>
</body>

</html>
<?php
//establish connection to db
include '../10_Database/connection.php';

$ref = $_POST['ref'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$theirref = $_POST['theirref'];
$test = $ref . $name;

$reference = $_POST['reference'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Escape special characters in variables
$ref = mysqli_real_escape_string($conn, $ref);
$name = mysqli_real_escape_string($conn, $name);
$phone = mysqli_real_escape_string($conn, $phone);
$email = mysqli_real_escape_string($conn, $email);
$theirref = mysqli_real_escape_string($conn, $theirref);
$test = mysqli_real_escape_string($conn, $test);
$reference = mysqli_real_escape_string($conn, $reference);

// Updating database - updating columns
$sql = "UPDATE contacts SET ref = '$ref', name = '$name', phone = '$phone', email = '$email', theirref = '$theirref', test = '$test' WHERE test = '$reference'";

// Execute the update query
if ($conn->query($sql) === TRUE) {
    echo "<span class='success'><br>Your file was successfully updated!</span>";
} else {
    echo "Error updating record: " . $conn->error;
}

// Close the connection
$conn->close();
?>