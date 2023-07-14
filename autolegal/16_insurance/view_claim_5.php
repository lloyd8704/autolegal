<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, destroy session and redirect to login page
    session_destroy();
    header("Location: login.html");
    exit;
}

// Connect to the database
include "../16_insurance/db_connection.php";

$reference = $_SESSION['reference'];
// Retrieve data from the database
$sql = "SELECT reference, policy_number, name, email, contact, identity, address, insured_vehicle, 
insured_registration, driver, driver_identity, driver_contact, driver_address, location, date, prescription, 
third_party_name, third_party_contact, third_party_address, third_party_identity, third_party_vehicle, 
third_party_registration, details, type_of_claim FROM claim_form 
WHERE reference='$reference'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Claim Details</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-A8XQHx7vzKgUyV7EMiO6M+jV6w10b6jFDM6UZjxvbez9iDwhNNlJy+BtysVcGj8+t1WZ91AeZqlgSY4zv4B9jA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {

            background-color: #6e6e6e;
            margin: 0;
            padding: 0;
            width: 100%;

        }


        form {
            width: 700px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: white;
            position: relative;
            top: -18px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            margin-left: 20px;
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
            resize: vertical;

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

        input[type="submit"]:hover {
            background-color: #0062cc;
        }

        .button:hover {
            background-color: #0062cc;
        }

        textarea {
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
        }

        #spinner-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        #spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2rem;
            color: white;
        }

        .container_bottom {
            flex-basis: 100%;
            padding: 0 10px;
        }

        h1 {
            text-align: center;
            background-color: #0062cc;
            ;
            margin-top: -1px;
            padding-top: 8px;
            padding-bottom: 9px;
            color: white;
            border-radius: 5px;
            position: relative;
            top: 1px;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: -8px;

            position: relative;
            top: 7px;
            font-family: "Montserrat", sans-serif;

        }

        input[type="text"],
        input[type="email"] {
            width: 54%;
            padding: 10px;
            margin-bottom: -1px;
            margin-left: 250px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            resize: vertical;
            position: relative;
            top: -15px;
            resize: none;
        }

        textarea {
            width: 87%;
            padding: 10px;
            margin-bottom: -1px;
            margin-left: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            resize: vertical;
            position: relative;
            top: -8px;
            resize: none;
        }

        input[type="submit"] {
            display: block;
            margin: 0 auto;
            width: 150px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #0062cc;
        }

        .button:hover {
            background-color: #0062cc;
        }

        textarea {
            font-family: Arial, sans-serif;
            font-size: 15px;
            line-height: 1.5;
            resize: vertical;
            min-height: 180px;
        }

        #date {
            cursor: pointer;
        }

        .underline {
            text-decoration: underline;
        }

        .editable-line {

            position: relative;
            top: 13px;

        }


        #name-label,
        #date-label,
        #position-label,
        #signature-label {
            display: inline-block;
            width: 100px;
            margin-right: 20px;
        }

        .button {
            display: block;
            margin: 0 auto;
            width: 150px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
        }

        .button:hover {
            background-color: #0062cc;
        }

        .home-icon {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;

        }

        .home-icon a {
            color: white;
        }

        .home-icon a:hover,
        .home-icon a:active,
        .home-icon a:visited {
            color: white;
        }
    </style>
</head>

<body>

    <?php

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "correspdb";

    // Create database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check if connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $reference = $_SESSION['reference'];

    // Retrieve data from the database
    $sql = "SELECT reference, type_of_claim , policy_number, name, email, contact, identity, address, insured_vehicle, 
    insured_registration, location, date, prescription, driver, driver_identity, driver_contact, driver_address,
    third_party_name, third_party_contact, third_party_identity, third_party_vehicle, third_party_registration, 
    second_driver_name, second_driver_contact, second_driver_identity, second_driver_vehicle, 
    second_driver_registration, details FROM claim_form 
    WHERE reference='$reference'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
    ?>

    <body>
        <h1>Claim Details for <?php echo $row['reference']; ?>
            <div class="home-icon">
                <a href="../16_insurance/index.html">
                    <i class="fas fa-home"></i>
                </a>
        </h1>
        <div class="container"><br>
            <form>
                <label for="claim_form" style="text-align: center;">COLLISION CLAIM FORM:</label><br>
                <hr><br>
                <label for="name">INSURED:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" readonly>

                <label for="identity">IDENTITY NO:</label>
                <input type="text" id="identity" name="identity" value="<?php echo $row['identity']; ?>" readonly>

                <label for="email">EMAIL ADDRESS:</label>
                <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" readonly>

                <label for="contact">CONTACT NO:</label>
                <input type="text" id="contact" name="contact" value="<?php echo $row['contact']; ?>" readonly>

                <label for="address">ADDRESS:</label>
                <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" readonly>

                <label for="policy_number">POLICY NUMBER:</label>
                <input type="text" id="policy_number" name="policy_number" value="<?php echo $row['policy_number']; ?>" readonly>

                <label for="date">DATE OF COLLISION:</label>
                <input type="text" id="date" name="date" value="<?php echo $row['date']; ?>" readonly>

                <label for="location">WHERE DID IT HAPPEN:</label>
                <input type="text" id="location" name="location" value="<?php echo $row['location']; ?>" readonly>

                <label for="details">DESCRIBE THE INCIDENT IN DETAIL:</label><br><br>
                <textarea id="details" name="details" rows="3" cols="30"><?php echo $row['details']; ?></textarea>

                <label for="insured_vehicle">VEHICLE MAKE:</label>
                <input type="text" id="insured_vehicle" name="insured_vehicle" value="<?php echo $row['insured_vehicle']; ?>" readonly>

                <label for="insured_registration">REGISTRATION NO:</label>
                <input type="text" id="insured_registration" name="insured_registration" value="<?php echo $row['insured_registration']; ?>" readonly>

                <label for="driver">DRIVER'S NAME:</label>
                <input type="text" id="driver" name="driver" value="<?php echo $row['driver']; ?>" readonly>

                <label for="driver_identity">DRIVER'S IDENTITY:</label>
                <input type="text" id="driver_identity" name="driver_identity" value="<?php echo $row['driver_identity']; ?>" readonly>

                <label for="driver_contact">DRIVER'S TEL NO:</label>
                <input type="text" id="driver_contact" name="driver_contact" value="<?php echo $row['driver_contact']; ?>" readonly>

                <label for="driver_address">DRIVER'S ADDRESS:</label>
                <input type="text" id="driver_address" name="driver_address" value="<?php echo $row['driver_address']; ?>" readonly>

                <label for="test1" class="underline">FIRST DRIVER'S DETAILS:</label><br><br>

                <label for="third_party_name">NAME OF DRIVER 1:</label>
                <input type="text" id="third_party_name" name="third_party_name" value="<?php echo $row['third_party_name']; ?>" readonly>

                <label for="third_party_contact">TEL OF DRIVER 1:</label>
                <input type="text" id="third_party_contact" name="third_party_contact" value="<?php echo $row['third_party_contact']; ?>" readonly>

                <label for="third_party_identity">IDENTITY OF DRIVER 1:</label>
                <input type="text" id="third_party_identity" name="third_party_identity" value="<?php echo $row['third_party_identity']; ?>" readonly>

                <label for="third_party_vehicle">MAKE OF VEHICLE:</label>
                <input type="text" id="third_party_vehicle" name="third_party_vehicle" value="<?php echo $row['third_party_vehicle']; ?>" readonly>

                <label for="third_party_registration">REGISTRATION NO:</label>
                <input type="text" id="third_party_registration" name="third_party_registration" value="<?php echo $row['third_party_registration']; ?>" readonly>

                <label for="test1" class="underline">SECOND DRIVER'S DETAILS:</label><br><br>

                <label for="third_party_name">NAME OF DRIVER 2:</label>
                <input type="text" id="third_party_name" name="second_driver_name" value="<?php echo $row['second_driver_name']; ?>" readonly>

                <label for="third_party_contact">TEL OF DRIVER 2:</label>
                <input type="text" id="third_party_contact" name="second_driver_contact" value="<?php echo $row['second_driver_contact']; ?>" readonly>

                <label for="second_driver_identity">ID NO OF DRIVER 2:</label>
                <input type="text" id="second_driver_identity" name="second_driver_identity" value="<?php echo $row['second_driver_identity']; ?>" readonly>

                <label for="third_party_vehicle">MAKE OF VEHICLE:</label>
                <input type="text" id="third_party_vehicle" name="second_driver_vehicle" value="<?php echo $row['second_driver_vehicle']; ?>" readonly>

                <label for="third_party_registration">REGISTRATION NO:</label>
                <input type="text" id="third_party_registration" name="second_driver_registration" value="<?php echo $row['second_driver_registration']; ?>" readonly>

                <div class="container_bottom"><br>
                    <a href="../16_insurance/view_claim_test_1.html" class="button">Back</a>
                </div>
            </form>
        </div>
    </body>

</html>

</html>