<?php
require "../database.php";

// Get user input from POST request
$ref = filter_input(INPUT_POST, 'ref', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$name = ucwords(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
$theirref = filter_input(INPUT_POST, 'theirref', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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
    <link rel="stylesheet" href="../../app1.css">
    <title>Contact Search</title>
</head>

<body>
    <nav>
        <div class="heading">
            <h4>AutoLegal</h4>
        </div>
    </nav>

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