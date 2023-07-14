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
$sql = "SELECT reference, company_name, email, contact_name, address, contact, date, prescription, 
location, quantum, third_party_name, third_party_contact, third_party_address, third_party_email, details, 
policy_number FROM damage_claim
WHERE reference='$reference'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $date = date('d-m-Y - l', strtotime($row['date'])); // format date with day of the week
    $prescription = date('d-m-Y - l', strtotime($row['prescription'])); // format date with day of the week
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
            width: 740px;
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
            top: -13px;
            resize: none;
            cursor: default;
        }

        textarea {
            font-family: Arial, sans-serif;
            font-size: 15px;
            line-height: 1.5;
            resize: vertical;


        }

        textarea {
            width: 85%;
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
            cursor: default;
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

        textarea {
            font-family: Arial, sans-serif;
            font-size: 15px;
            line-height: 1.5;
            resize: vertical;
            min-height: 150px;
        }

        #date {
            cursor: default;
        }

        hr {
            border-width: 4px;
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

    <h1>Claim Details for <?php echo $row['reference']; ?>
        <div class="home-icon">
            <a href="../16_insurance/index.php">
                <i class="fas fa-home"></i>
            </a>
    </h1><br>
    <div class="container">
        <form action="#" method="post">
            <img src="../11_Images/ACE_CLAIM_FORM.png" alt="Logo">
            <label for="company_name" style="text-align: center;">DAMAGES CLAIM FORM:</label><br>
            <hr><br>
            <label for="company_name">INSURED:</label>
            <input type="text" id="company_name" name="company_name" value="<?php echo $row['company_name']; ?>" readonly>

            <label for="contact_name">CONTACT PERSON:</label>
            <input type="text" id="contact_name" name="contact_name" value="<?php echo $row['contact_name']; ?>" readonly>

            <label for="email">EMAIL:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" readonly>

            <label for="contact">CONTACT NO:</label>
            <input type="text" id="contact" name="contact" value="<?php echo $row['contact']; ?>" readonly>

            <label for="address">ADDRESS:</label>
            <input type="text" id="address" name="address" value="<?php echo $row['address']; ?>" readonly>

            <label for="policy_number">POLICY NUMBER:</label>
            <input type="text" id="policy_number" name="policy_number" value="<?php echo $row['policy_number']; ?>" readonly>

            <label for="date">DATE OF INCIDENT:</label>
            <input type="text" id="date" name="date" value="<?php echo $date; ?>" readonly>

            <label for="prescription">PRESCRIPTION:</label>
            <input type="text" id="date" name="date" value="<?php echo $prescription; ?>" readonly>

            <label for="location">WHERE DID IT HAPPEN:</label>
            <input type="text" id="location" name="location" value="<?php echo $row['location']; ?>" readonly>

            <label for="details">DESCRIBE THE INCIDENT IN DETAIL:</label><br><br>
            <textarea id="details" name="details" rows="3" cols="30" readonly><?php echo $row['company_name']; ?></textarea>

            <label for="quantum">&nbsp;ESTIMATED QUANTUM <br>&nbsp;OF THE CLAIM:</label>
            <input type="text" id="quantum" name="quantum" value="<?php echo $row['quantum']; ?>" readonly>

            <label for="third_party_name">&nbsp;NAME OF THIRD PARTY:</label>
            <input type="text" id="third_party_name" name="third_party_name" value="<?php echo $row['third_party_name']; ?>" readonly>

            <label for="third_party_contact">&nbsp;TEL NO OF THIRD PARTY:</label>
            <input type="text" id="third_party_contact" name="third_party_contact" value="<?php echo $row['third_party_contact']; ?>" readonly>

            <label for="third_party_email">&nbsp;EMAIL OF THIRD PARTY:</label>
            <input type="text" id="third_party_email" name="third_party_email" value="<?php echo $row['third_party_email']; ?>" readonly>

            <label for="third_party_address">&nbsp;ADDRESS OF THIRD PARTY:</label>
            <input type="text" id="third_party_address" name="third_party_address" value="<?php echo $row['third_party_address']; ?>" readonly><br><br>

            <div class="container_bottom"><br>
                <a href="../16_insurance/view_claim_1.php" class="button">Back</a>
            </div>
        </form>
    </div>
</body>

</html>