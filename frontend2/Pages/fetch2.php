<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app1.css" />
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
    <title>Contact Details</title>
</head>

<body>

    <?php
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
    $query = "SELECT * FROM `contacts` WHERE ref='$test'";


    // FETCHING DATA FROM DATABASE
    $result = $conn->query($query);
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        // fetch the first row as an associative array
        $row = $result->fetch_assoc();
        $reference = $row['ref'];

        echo "<nav>
            <div class='heading'>
                <h4>AutoLegal</h4>
                <h5>Contacts for: $reference</h5>
            </div>
        </nav>";

        // output data of each row starting from the first row
        do {
            if ($row['theirref'] == "" && $row['email'] == "") {
                echo '<br>' . "<a class='contact'> &nbsp$row[name]:<br><br> 
            </a>&nbspPhone number: &nbsp&nbsp; $row[phone]<br><br><hr>";
            } else if ($row['theirref'] == "") {
                echo '<br>' . "<a class='contact'> &nbsp$row[name]:<br><br> 
            </a>&nbspPhone number: &nbsp&nbsp; $row[phone]<br>
            &nbspEmail address: &nbsp&nbsp&nbsp; $row[email]
            <br><br><hr>";
            } else {
                echo '<br>' . "<a class='contact'> &nbsp$row[name]:<br><br> 
            </a>&nbspPhone number: &nbsp&nbsp; $row[phone]<br>
            &nbspEmail address: &nbsp&nbsp&nbsp; $row[email]<br>
            &nbspTheir reference: &nbsp; $row[theirref]<br><br><hr>";
            }
        } while ($row = $result->fetch_assoc());
    } else {
        echo '<nav>
        <div class="heading">
            <h4>AutoLegal</h4>&nbsp&nbsp
        </div>
    </nav>
    </div><br>';
        header("Location: test2.php?error=<span class='error'><br>There is no file with that reference number - please try again.</span>");
    }

    $conn->close();

    ?>


</body>
<style>
    body {
        font-family: "Montserrat", sans-serif;
        font-size: 16px;
        position: relative;
        left: -1px;
    }

    .heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        position: relative;

    }

    .heading h4 {
        margin: 0;
        margin-left: 86px;
        padding-right: 20px;
        /* add some right padding to move it a little to the right */
        flex-shrink: 0;
        margin-left: -660px;
    }

    .heading h5 {
        white-space: nowrap;
        margin: 0;
        text-align: center;
        /* center the text */
        flex-grow: 1;
        /* make it take up all available space on the right */
        position: relative;
        left: 260px;
    }
</style>

</html>