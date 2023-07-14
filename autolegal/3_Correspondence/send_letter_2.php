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
    <link rel="stylesheet" href="../9_Style/style2.css" />
    <title>Email Post</title>
</head>
<div id="test">

    <body>
        <nav>
            <div class="heading">
                <h4>AutoLegal</h4>
            </div>
        </nav>

</div>


<?php
require_once "../10_Database/connection.php";

// GET CONNECTION ERRORS
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL QUERY
$test = $_SESSION['reference'];
$query = "SELECT * FROM `correspondence` WHERE ref='$test'";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo '<div class="heading3">
    <p>Who do you want to send the email to?</p>
</div><br><br>
<img src="../11_Images/hex3black.png" class="hexagonssend" alt="Outline of three hexagons">
<img src="../11_Images/hex2black.png" class="hexagons2send" alt="Outline of two hexagons">';
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {

        $msg = $row["contact"];
        $email = $row['email'];
        $subject = $row['subject'];
        $contact = $row['contact'];
        $ourref = $row['ref'];
        $theirref = $row['theirref'];
        $eparagraph = $row['eparagraph'];
        $author_full_name = $row['author_full_name'];
        echo //"<a class='one'><br><br>$msg</a><br>" .
        "<a href='mailto: $email?subject=RE:%20 $subject
            &body=Dear%20$contact,
            %0D%0A%0D%0AYOUR%20REF: $theirref   
            %0D%0AOUR%20REF:   $ourref
            %0D%0A%0D%0AKindly%20find%20attached%20hereto%20for%20your%20attention.
            %0D%0A%0D%0A$eparagraph,%0D%0A$author_full_name 

            '><br><br><br><input type='submit' class='test' value='$msg' />
        </a>";
    }
}

$conn->close();

?>
</div>
<style>
    body {
        overflow-x: hidden;
    }
</style>

</body>

</html>