<?php

session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}

require "../10_Database/database.php";

// Get user input from POST request
$ref = filter_input(INPUT_POST, 'ref', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = $_POST['email'];
$name = ucwords($_POST['name']);
$phone = $_POST['phone'];
$theirref = $_POST['theirref'];

// Prepare SQL statement with placeholders
$query = $pdo->prepare("SELECT * FROM contacts WHERE test = ?");
$query->execute([$ref . $name]);
$result = $query->rowCount();
if ($result > 0) {
    $error = "<span class='error'><br>This contact already exists - Please ensure the details are correct</span>";
}

if (empty($error)) {
    // Prepare SQL statement with placeholders
    $query = $pdo->prepare("INSERT INTO contacts (ref, name, phone, email, test, theirref) VALUES(:ref, :name, :phone, :email, :test, :theirref)");

    // Execute the prepared statement with values passed directly to the execute function
    $query->execute([
        ':ref' => $ref,
        ':name' => $name,
        ':phone' => $phone,
        ':email' => $email,
        ':test' => $ref . $name,
        ':theirref' => $theirref,
    ]);

    $msg = "<span class='success'><br>Your file has been successfully created!</span>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../9_Style/style.css">
    <title>Contacts</title>
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
</head>

<body style="background-color: black">
    <div id="test">
        <nav>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
                <li><a class="nav-link" href="../2_New_file/Index.php">New&nbspFile</a></li>
                <li><a class="nav-link" href="../3_Correspondence/Index.php">Correspondence</a></li>
                <li><a class="nav-link" href="../4_Pleadings/Index.php">Pleadings</a></li>
                <li><a class="nav-link active" href="../5_Contacts/Index.php">Contacts</a></li>
                <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
                <li><a class="nav-link" href="../7_Edit/Index.php">Edit</a></li>
                <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
            </ul>
        </nav>
</body>

<div class="container test-center register">
    <?php if (isset($error)) {
        echo $error;
    } ?>
    <?php if (isset($msg)) {
        echo $msg;
    } ?>
</div>

<style>
    body {
        overflow-x: hidden;
    }
</style>
</body>

</html>