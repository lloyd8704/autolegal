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
    <title>Edit</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../16_insurance/style.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
            <li><a class="active" href="">Edit</a></li>
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
    <div class="container">
        <h1>Log Edit</h1>

        <style>
            textarea {
                width: 97%;
                padding: 10px;
                margin-top: 2%;
                border-radius: 5px;
                border: 1px solid #ccc;
                font-size: 16px;
                font-family: Arial, Helvetica, sans-serif;
                resize: vertical;
            }

            select {
                width: 100%;
                cursor: pointer;
            }


            label {
                font-weight: bold;
            }

            body {
                background-image: url("../11_Images/LOG_IN.jpg");
                background-repeat: no-repeat;
                background-size: cover;
            }

            form {
                padding-top: 45px;
                padding-bottom: 45px;
                padding-left: 40px;
                padding-right: 40px;
                width: 50%;
            }

            h1 {
                margin-bottom: 20px;
                text-align: center;
                font-family: Orbitron;
                font-weight: bolder;
                font-size: 40px;
                margin-bottom: 20px;
                text-align: center;
                font-family: Orbitron;
                font-weight: bolder;
                font-weight: bold;
                color: #151A7B;
                margin-top: 5px;
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
                width: 100%;

            }

            .container {
                margin-top: 50px;
            }
        </style>

</html>
<?php
// Establish a database connection
include "../16_insurance/db_connection.php";

if (isset($_GET["updateId"])) {
    $updateId = $_GET["updateId"];

    // Retrieve the diary entry content based on the update ID
    $stmt = $conn->prepare("SELECT update_content FROM updates WHERE id = ?");
    $stmt->bind_param("i", $updateId);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $updateContent = $row['update_content'];

        // Display the text area for editing the diary entry content
        echo "<form method='POST' action='../16_insurance/event_update_8.php'>
              <textarea name='newContent' rows='6' cols='40'>$updateContent</textarea>
              <input type='hidden' name='updateId' value='$updateId'><br><br>
              <input class='button' type='submit' value='Save Edit'>
              </form>";
    } else {
        echo "Diary entry not found.";
    }
} else {
    echo "Invalid update ID.";
}
