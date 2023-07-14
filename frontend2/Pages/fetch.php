<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app1.css" />
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
$template = "echo '/frontend2/Documents/warning.png' ?>" >

    $servername = "localhost";
$username = "root";
$password = "";
$databasename = "correspdb";

// CREATE CONNECTION
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $databasename,
);




// GET CONNECTION ERRORS
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// SQL QUERY
$test = $_POST["reference"];
$query = "SELECT * FROM `correspondence` WHERE ref='$test'";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo '<div class="heading3">
    <p>Who do you want to send the email to?</p>
</div><br><br>
<img src="../Documents/hex3black.png" class="hexagonssend" alt="Outline of three hexagons">
<img src="../Documents/hex2black.png" class="hexagons2send" alt="Outline of two hexagons">';
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {

        $msg = $row["contact"];
        $email = $row['email'];
        $subject = $row['subject'];
        $contact = $row['contact'];
        $ourref = $row['ref'];
        $theirref = $row['theirref'];
        $eparagraph = $row['eparagraph'];
        $author = $row['author'];
        echo //"<a class='one'><br><br>$msg</a><br>" .
        "<a href='mailto: $email?subject=RE:%20 $subject
            &body=Dear%20$contact,
            %0D%0A%0D%0AYOUR%20REF: $theirref   
            %0D%0AOUR%20REF:   $ourref
            %0D%0A%0D%0AKindly%20find%20attached%20hereto%20for%20your%20attention.
            %0D%0A%0D%0A$eparagraph,%0D%0A$author

            '><br><br><br><input type='submit' class='test' value='$msg' />
        </a>";
    }
} else {
    header("Location: test.php?error=<span class='error'><br>There is no file with that reference number - please try again.</span>");
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