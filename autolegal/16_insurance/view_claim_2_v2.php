<!DOCTYPE html>
<html>

<head>
    <title>Claim Details</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <style>
        body {
            margin-top: -10px;
            overflow: hidden;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #e6e6e6;
            padding-top: 36px;
            padding-bottom: 20px;
            margin-top: -30px;

        }

        .container_left {
            flex: 1;
            padding: 0 35px;
            position: relative;
            left: 31px;
        }

        .container_right {
            flex: 1;
            padding: 0 10px;
            position: relative;
            left: -20px;
        }

        .container_bottom {
            flex-basis: 100%;
            padding: 0 10px;
        }

        h1 {
            text-align: center;
            background-color: #009bff;
            margin-top: 0px;
            padding-top: 8px;
            padding-bottom: 9px;
            color: white;
            border-radius: 5px;
            position: relative;
            top: 9px;
        }

        label {
            display: block;
            margin-bottom: -8px;
            position: relative;
            top: 7px;
            font-family: "Montserrat", sans-serif;

        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 54%;
            padding: 10px;
            margin-bottom: -1px;
            margin-left: 207px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            resize: vertical;
            position: relative;
            top: -13px;
            resize: none;
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

        input[type="submit"]:hover {
            background-color: #0062cc;
        }



        textarea {
            font-family: Arial, sans-serif;
            font-size: 15px;
            line-height: 1.5;
        }
    </style>

</head>

<body>

    <?php
    session_start();
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
    $sql = "SELECT policy_number, name, email, location, date, prescription, details, reference, prescription, contact, identity, address, 
    insured_vehicle, insured_registration, driver, driver_identity, driver_address, third_party_name, third_party_contact, 
    third_party_address, third_party_vehicle, third_party_registration FROM claim_form 
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
    <h1>Claim Details for <?php echo $row['reference']; ?></h1>
    <div class="container">
        <div class="container_left">
            <form>

                <label for="reference">REFERENCE:</label>
                <input type="text" id="reference" name="reference" autocomplete="off" value="<?php echo $row['reference']; ?>" readonly>

                <label for="policy_number">POLICY NUMBER:</label>
                <input type="text" id="policy_number" name="policy_number" autocomplete="off" value="<?php echo $row['policy_number']; ?>" readonly>

                <label for="name">INSURED:</label>
                <input type="text" id="name" name="name" autocomplete="off" value="<?php echo $row['name']; ?>" readonly>

                <label for="email">EMAIL:</label>
                <input type="email" id="email" name="email" autocomplete="off" value="<?php echo $row['email']; ?>" readonly>

                <label for="address">ADDRESS:</label>
                <input type="text" id="address" name="address" autocomplete="off" value="<?php echo $row['address']; ?>" readonly>

                <label for="contact">CONTACT NO:</label>
                <input type="text" id="contact" name="contact" autocomplete="off" value="<?php echo $row['contact']; ?>" readonly>

                <label for="insured_vehicle">INSURED'S VEHICLE:</label>
                <input type="text" id="insured_vehicle" name="insured_vehicle" autocomplete="off" value="<?php echo $row['insured_vehicle']; ?>" readonly>

                <label for="insured_registration">INSURED'S REGISTRATION:</label>
                <input type="text" id="insured_registration" name="insured_registration" autocomplete="off" value="<?php echo $row['insured_registration']; ?>" readonly>

                <label for="date">DATE:</label>
                <input type="text" id="date" name="date" autocomplete="off" value="<?php echo $row['date']; ?>" readonly>

                <label for="prescription">PRESCRIPTION:</label>
                <input type="text" id="prescription" name="prescription" autocomplete="off" value="<?php echo $row['prescription']; ?>" readonly>

                <label for="location">LOCATION:</label>
                <input type="text" id="location" name="location" autocomplete="off" value="<?php echo $row['location']; ?>" readonly>

        </div>
        <div class="container_right">

            <label for="driver">DRIVER:</label>
            <input type="text" id="driver" name="driver" autocomplete="off" value="<?php echo $row['driver']; ?>">

            <label for="driver_identity">DRIVER'S ID:</label>
            <input type="text" id="driver_identity" name="driver_identity" autocomplete="off" value="<?php echo $row['driver_identity']; ?>">

            <label for="third_party_name">THIRD PARTY:</label>
            <input type="text" id="third_party_name" name="third_party_name" autocomplete="off" value="<?php echo $row['third_party_name']; ?>">

            <label for="third_party_email">THIRD PARTY EMAIL:</label>
            <input type="text" id="third_party_email" name="third_party_email" autocomplete="off" value="<?php echo $row['third_party_address']; ?>">

            <label for="third_party_contact">THIRD PARTY CONTACT:</label>
            <input type="text" id="third_party_contact" name="third_party_contact" autocomplete="off" value="<?php echo $row['third_party_contact']; ?>">

            <label for="third_party_address">THIRD PARTY ADDRESS:</label>
            <input type="text" id="third_party_address" name="third_party_address" autocomplete="off" value="<?php echo $row['third_party_address']; ?>">

            <label for="third_party_vehicle">THIRD PARTY VEHICLE:</label>
            <input type="text" id="third_party_vehicle" name="third_party_vehicle" autocomplete="off" value="<?php echo $row['third_party_vehicle']; ?>">

            <label for="third_party_registration">TP'S REGISTRATION:</label>
            <input type="text" id="third_party_registration" name="third_party_registration" autocomplete="off" value="<?php echo $row['third_party_registration']; ?>">

            <label for="details">DETAILS:</label>
            <textarea id="details" name="details" rows="4" cols="30"><?php echo $row['details']; ?></textarea>

        </div>
        <div class="container_bottom"><br>
            <a href="../16_insurance/view_claim_select.html" class="button">Back</a>
        </div>
        </form>
    </div>
</body>

</html>

</html>