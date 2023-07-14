<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app1.css" />
    <title>Create Letter</title>
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
$query = "SELECT * FROM `pleadings` WHERE number='$test'";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {
        $msg = $row["number"];
        $number = $row["number"];
        $testref = $row["test"];

        //'<button type="submit" name="reference" value"' . $testref . '">Hello</button>';
        echo //"<a class='one'><br><br>$msg</a><br>" .
        '<form action="./././phpoffice/vendor/pleadings.php" method="post" "<br><br><br>' .
            '<button type="submit" class="test" name="reference" 
            value="' . $testref .  '"> ' . $msg . ' </button>';
    }
} else {
    //echo "<script>alert('There is no file with that reference number - please try again')</script>";
    echo "<br><span class='warning'>There is no file with that reference number - please try again.</span>";
}



$conn->close();

?>

</body>

</html>