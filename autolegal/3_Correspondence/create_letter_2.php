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
    <link rel="stylesheet" href="../9_Style/style2.css">
    <title>Create Letter</title>
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
</head>
<div id="test">

    <body>
        <nav class="navblack">
            <div class="heading">
                <h4>AutoLegal</h4>
            </div>
        </nav>
</div>
</body>

<?php

require_once "../10_Database/connection.php";


// GET CONNECTION ERRORS
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// post recieved from test3.html
$test = $_SESSION['reference'];
$query = "SELECT * FROM `correspondence` WHERE ref='$test'";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo '<div class="heading3">
        <p>Who do you want to send the letter to?</p>
    </div><br><br><br><br>
    <img src="../11_Images/hex3black.png" class="hexagonssend" alt="Outline of three hexagons">
    <img src="../11_Images/hex2black.png" class="hexagons2send" alt="Outline of two hexagons">';
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {

        $msg = $row["contact"];
        $ref = $row["ref"];
        $testref = $row["test"];

        //'<button type="submit" name="reference" value"' . $testref . '">Hello</button>';

        echo //"<a class='one'><br><br>$msg</a><br>" .
        '<form action="../3_Correspondence/create_letter_3.php" method="post" "<br><br><br>' .
            '<button type="submit" class="test" name="reference" 
            value="' . $testref .  '"> ' . $msg . ' </button>';
    }
}


$conn->close();

?>
<style>
    body {
        overflow: hidden;
    }
</style>
</body>

</html>