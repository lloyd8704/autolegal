<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, destroy session and redirect to login page
    session_destroy();
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../16_insurance/style.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
    <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Aclonica' type='text/css' />
    <style>
        .button {
            width: 170px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        form {
            width: 500px;
            height: 110px;
            padding: 20px;
            border: 3px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <ul>
        <li><a href="../16_insurance/index.php">Home</a></li>
        <li><a href="view_claim_select.php">View</a></li>
        <li><a href="update_select.php">Update</a></li>
        <li><a href="send_email_select.php">Send</a></li>
        <li><a href="choice_of_letters.php">Draft</a></li>
        <li><a class="active" href="#">User</a></li>
        <li><a class="user" href="#">Welcome <?php echo ucfirst(strtolower($_SESSION['username'])); ?></a></li>
    </ul>
    <div class="container">
        <div class="logo">AI</div>
        <h2>What would you like to do?</h2><br>
        <form>
            <div class="button-container">
                <a href="../16_insurance/logout_2.php" class="button">Logout</a>
                <a href="../16_insurance/reset_password_logged_1.php" class="button">Change Password</a>
            </div>
        </form>
    </div>
</body>

</html>