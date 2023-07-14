<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Log Report</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../16_insurance/style.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-A8XQHx7vzKgUyV7EMiO6M+jV6w10b6jFDM6UZjxvbez9iDwhNNlJy+BtysVcGj8+t1WZ91AeZqlgSY4zv4B9jA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../16_insurance/script.js"></script>

</head>

<body>
    <nav>
        <ul>
            <li><a href="../16_insurance/index.php">Home</a></li>
            <li><a href="view_claim_select.php">View</a></li>
            <li><a href="update_select.php">Update</a></li>
            <li><a href="send_email_select.php">Send</a></li>
            <li><a href="choice_of_letters.php">Draft</a></li>
            <li><a class="active" href="">Log</a></li>
            <li><a class="user" href="../16_insurance/logout_1.php">Welcome <?php echo ucfirst(strtolower($_SESSION['username'])); ?></a></li>
            <li>
                <a class="sign_out" href="../16_insurance/logout_2.php">
                    <i class="fas fa-sign-out-alt" alt="Sign Out"></i>
                </a>
                <div class="tooltip">
                    <p>Sign Out</p>
                </div>
            </li>
        </ul>
    </nav>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;

            overflow-y: auto;
        }

        .diary-entry {
            display: grid;
            grid-template-columns: auto 1fr;
            background-color: #F9F9F9;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 3px solid #ccc;
            margin-left: 4px;
            margin-right: 4px;
        }

        .diary-entry .timestamp {
            font-size: 16px;
            font-weight: bold;
            color: white;
            /* margin-top: 5px; */
            grid-column: 1;
            margin: auto;
            background-color: #0062cc;
            padding: 10px;
            border-radius: 5px;
            height: auto;
        }


        .diary-entry .update-content {
            margin-top: 5px;
            margin-bottom: 0px;
            font-size: 18px;
            line-height: 1.5;
            grid-column: 2;
            padding: 10px;
            width: 900px;
            padding-left: 50px;
        }

        .centered {
            text-align: center;
        }

        .claim-report {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 0 auto;
            max-width: 500px;
        }

        .claim-report h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .claim-report p {
            margin-bottom: 10px;
        }

        .diary-entry .user {
            margin-top: auto;
            margin-bottom: auto;
            height: fit-content;
            color: white;
            font-size: 16px;
            line-height: 1.5;
            grid-column: 3;
            padding: 10px;
            padding-left: 25px;
            background-color: rgba(128, 128, 128, 0.9);
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
            font-family: Orbitron;
            font-weight: bolder;
            font-size: 30px;
            margin-bottom: 20px;
            text-align: center;
            font-family: Orbitron;
            font-weight: bolder;
            font-weight: bold;
            color: #151A7B;
        }

        .email {
            border: solid #483D8B !important;
            background-color: #B0C4DE;
        }

        .closed {
            border: solid green !important;
            background-color: #A9D9A7;
        }

        .key {
            position: relative;
            left: 88%;
            margin-top: -40px;
            transform: translateY(-50%);
            margin-bottom: -30px;
        }

        .key-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .key-item label {
            margin-left: 5px;
        }

        .key-item .square {
            width: 20px;
            height: 20px;
            border-radius: 3px;
            margin-right: 5px;
        }

        .edit-button {
            display: inline-block;
            padding: 5px 10px;

            color: #333;
            text-decoration: none;
            border-radius: 4px;
        }

        .edit-button:hover {

            color: #0062cc;

        }

        .edit-button i {
            margin-right: 5px;
        }
    </style>

    <?php
    // Assuming you have already established a database connection
    include "../16_insurance/db_connection.php";

    // Check if the reference parameter is set in the URL
    if (isset($_GET["reference"])) {
        $reference = $_GET["reference"];

        // Prepare a SELECT statement to check if the claim reference exists in the claim_form table
        $stmt = $conn->prepare("SELECT id, reference, update_content, update_date, user, status FROM updates WHERE reference = ?");
        $stmt->bind_param("s", $reference);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if there are any updates
        if (mysqli_num_rows($result) > 0) {
            echo "<h1 class='centered'>Log Report for $reference</h1>
        <div class='key'>
        <div class='key-item'>
        <div class='square email'></div>
        <label>Communication</label>
        </div>
        <div class='key-item'>
        <div class='square closed'></div>
        <label>Matter Closed</label>
        </div>
        </div>";

            // Loop through each row and display the update details
            while ($row = mysqli_fetch_assoc($result)) {
                $updateId = $row['id'];
                $updateContent = $row['update_content'];
                $timestamp = $row['update_date'];
                $user = $row['user'];
                $status = $row['status'];

                // Divide the timestamp into date and time components
                $date = date('Y-m-d', strtotime($timestamp));
                $time = date('H:i:s', strtotime($timestamp));

                $dateTime = $date . '<br>' . '&nbsp;&nbsp;' . $time;

                // Determine the CSS class for the diary entry based on the status
                if ($status == 'email') {
                    $diaryClass = 'email';
                } else if ($status == 'closed') {
                    $diaryClass = 'closed';
                } else {
                    $diaryClass = '';
                }

                // Display the update details with the combined date and time and apply the CSS class
                echo "<div class='diary-entry $diaryClass'>";
                echo "<p class='timestamp'>$dateTime</p>";
                echo "<p class='update-content'>$updateContent</p>";
                echo "<p class='user'>Logged by: $user</p>";
                echo "<a class='edit-button' href='event_update_7.php?updateId=$updateId'><i class='fas fa-edit'></i>Edit</a>";
                echo "</div>";
            }
        } else {
            // No updates found
            echo "<h1 class='centered'>Logbook for $reference</h1>";
            echo "<p>No updates found.</p>";
        }
    }
    ?>