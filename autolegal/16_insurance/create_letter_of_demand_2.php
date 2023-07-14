<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, destroy session and redirect to login page
    session_destroy();
    header("Location: login.html");
    exit;
}

$reference = $_SESSION['reference'];
$selected_options = $_POST['instructions'];

// Connect to the database
include "../16_insurance/db_connection.php";

$test = $reference;
$query = "SELECT * FROM `claim_form` WHERE reference='$test'";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    require_once "../10_Database/phpoffice/vendor/autoload.php";
    // OUTPUT DATA OF EACH ROW
    while ($row = $result->fetch_assoc()) {
        $third_party_name = $row['third_party_name'];
        $third_party_email = $row['third_party_email'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Letter</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Aclonica' type='text/css' />
    <style>
        form {
            width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            position: relative;
            top: -25px;
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 20px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 95%;
            padding: 10px;
            margin-bottom: -1px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .logo {
            display: block;
            margin: 0 auto;
            margin-top: -15px;
        }

        body {
            margin-top: 40px;
            padding: 0;
            background-color: #f1f1f1;
            overflow: hidden;
        }

        input[type="submit"]:hover {
            background-color: #0062cc;
        }

        .back-button {
            width: 100%;
            padding: 10px;
            background-color: #ccc;
            color: black;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .back-button:hover {
            background-color: #ddd;
        }

        #date {
            cursor: pointer;
        }

        .logo {
            background-color: #151A7B;
            border: 3px solid #C0C0C0;
            border-radius: 20px;
            color: white;
            cursor: default;
            cursor: pointer;
            font-family: Orbitron;
            font-size: 87px;
            font-weight: bold;
            height: 102px;
            padding: 10px;
            padding-top: 5px;
            text-align: center;
            text-decoration: wavy;
            width: 111px;
        }
    </style>

</head>
<script>
    $(document).ready(function() {
        $('#date').datepicker({
            dateFormat: 'dd-mm-yy'
        });
    });
</script>

<body>
    <div>
        <!-- <img src="../11_Images/AI-LOGO.png" class="logo" alt="Letter and email"><br><br>-->
        <div class="logo">SI</div><br><br>
    </div>
    <form action="../16_insurance/create_letter_of_demand_3.php" method="post">
        <label for="quantum">The amount claimed:</label>
        <input type="text" id="quantum" name="quantum" value="R" autocomplete="off"><br><br>
        <label for="response_date">Date by which to respond to the demand:</label>
        <input type="text" id="date" name="response_date" autocomplete="off" placeholder="Please Select" required><br><br>
        <label for="third_party_name">To whom is the letter going to be sent:</label>
        <input type="text" id="third_party_name" name="third_party_name" value="<?php echo $third_party_name; ?>" required><br><br>
        <label for="third_party_email">What is their email address:</label>
        <input type="text" id="third_party_email" name="third_party_email" value="<?php echo $third_party_email; ?>"><br>
        <input type="hidden" id="reference" name="reference" value="<?php echo $reference; ?>"><br>
        <input type="hidden" id="selected_options" name="selected_options" value="<?php echo $selected_options; ?>">
        <input type="submit" value="Next">
        <button type="button" class="back-button" onclick="window.location.href='../16_insurance/choice_of_letters.php'">Back</button>
    </form>
</body>

</html>