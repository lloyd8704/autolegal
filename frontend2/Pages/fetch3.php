<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app1.css" />
    <title>Create Letter</title>
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
</head>
<div id="test">

    <body>
        <nav>
            <div class="heading">
                <h4>AutoLegal</h4>
            </div>
        </nav>
</div>
</body>

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




// post recieved from test3.html
$test = $_POST["reference"];
$query = "SELECT * FROM `correspondence` WHERE ref='$test'";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo '<div class="heading3">
        <p>Who do you want to send the letter to?</p>
    </div><br><br><br><br>
    <img src="../Documents/hex3black.png" class="hexagonssend" alt="Outline of three hexagons">
    <img src="../Documents/hex2black.png" class="hexagons2send" alt="Outline of two hexagons">';
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {

        $msg = $row["contact"];
        $ref = $row["ref"];
        $testref = $row["test"];

        //'<button type="submit" name="reference" value"' . $testref . '">Hello</button>';

        echo //"<a class='one'><br><br>$msg</a><br>" .
        '<form action="./././phpoffice/vendor/index2.php" method="post" "<br><br><br>' .
            '<button type="submit" class="test" name="reference" 
            value="' . $testref .  '"> ' . $msg . ' </button>';
    }
} else {
    //echo "<script>alert('There is no file with that reference number - please try again')</script>";
    header("Location: test3.php?error=<span class='error'><br>There is no file with that reference number - please try again.</span>");
    //echo "<span class='error'><br>There is no file with that reference number - please try again.</span>";
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