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
    <title>Claim Update Form</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../16_insurance/style.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-A8XQHx7vzKgUyV7EMiO6M+jV6w10b6jFDM6UZjxvbez9iDwhNNlJy+BtysVcGj8+t1WZ91AeZqlgSY4zv4B9jA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../16_insurance/script.js"></script>
    <style>
        .container p {
            margin: 0 0 10px;
        }

        form {
            padding-top: 0px;
            width: 400px;
            padding-right: 55px;
        }

        .button {
            background-color: #223BC9;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            font-family: 'Open Sans', sans-serif;
            font-size: 18px;
            font-weight: bold;
            height: 40px;
            line-height: 00px;
            padding: 11px;
            text-align: center;
            text-decoration: none;
            width: 140px;
            padding-left: 55px;
            padding-right: 60px;
            margin-left: 27px;
        }

        h3 {
            font-family: 'Open Sans', sans-serif;
            font-size: 25px;
            letter-spacing: -1px;
            margin-left: 38px;
            color: #151A7B;
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="../16_insurance/index.php">Home</a></li>
            <li><a href="view_claim_select.php">View</a></li>
            <li><a href="update_select.php">Update</a></li>
            <li><a href="send_email_select.php">Send</a></li>
            <li><a href="choice_of_letters.php">Draft</a></li>
            <li><a class="active" href="../16_insurance/index.php">Update</a></li>
            <li><a class="user" href="../16_insurance/logout_1.php">Welcome </a></li>
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
    <div class="container"><br>
        <div class="logo">SI</div>
        <?php

        if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
            // Session does not exist or has expired, redirect to login page
            header("Location: login.html");
            exit;
        }

        // Assuming you have already established a database connection
        include "../16_insurance/db_connection.php";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Retrieve form data
            $claimReference = $_POST["reference"];
            $updateContent = $_POST["update_content"];
            $user = $_SESSION["username"];
            $user = ucfirst($user); // Capitalize the first letter
            $status = $_POST["special_remark"];
            // Prepare a SELECT statement to check if the claim reference exists in the claim_form table
            $stmt = $conn->prepare("SELECT reference, type_of_claim FROM claim_form WHERE reference = ?");
            $stmt->bind_param("s", $claimReference);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if there is a row in the database with the given reference
            if ($result->num_rows >= 1) {
                // Update claim form
                $updateQuery = "UPDATE claim_form SET `update` = ? WHERE `reference` = ?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("ss", $updateContent, $claimReference);
                $updateResult = $stmt->execute();

                if ($updateResult) {
                    // Insert new update into updates table
                    $insertQuery = "INSERT INTO updates (reference, update_content, user, status) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($insertQuery);
                    $stmt->bind_param("ssss", $claimReference, $updateContent, $user, $status);
                    $insertResult = $stmt->execute();

                    if ($insertResult) {
                        // Update and insertion successful
                        echo "<h2>Claim $claimReference has been updated!</h2>";

                        // Ask the user if they want to send the update to the insured
                        echo "<br><div style='text-align: center; '>";
                        echo "<form action='../16_insurance/event_update_email.php' method='POST'>";
                        echo "<h3>Send an update to the insured?</h3>";
                        echo "<input type='hidden' name='reference' value='$claimReference'>";
                        echo "<input type='hidden' name='update_content' value='$updateContent'>";
                        echo "<button class='button' type='submit' name='send_email' value='yes'>Yes</button>";
                        echo "<a href='../16_insurance/index.php' class='button'>No</a>";
                        echo "</form>";
                        echo "</div>";
                    } else {
                        // Error inserting new update
                        echo "<p>Error: Failed to insert new update.</p>";
                    }
                } else {
                    // Error updating claim form
                    echo "<p>Error: Failed to update claim form.</p>";
                }
            } else {
                // Claim reference not found in the database
                echo "<p>Error: Claim reference not found.</p>";
            }
        }
        ?>
    </div>
</body>

</html>