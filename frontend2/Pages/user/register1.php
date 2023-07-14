<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../app1.css" />
    <title>New file</title>
</head>

<body>
    <nav>
        <div class="heading">
            <h4>AutoLegal</h4>
        </div>
    </nav>
    </div>
</body>
<?php
session_start();

// Include database configuration
require "../database.php";

// Validate input values
if (empty($_POST['saveLocation'])) {
    die("<span class='error'><br>Please select where you want the file to be saved</span>");
}

if ($_POST['saveLocation'] === "prompt") {
    // Check if email is valid
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if (!$email) {
        die("<span class='warning'><br>Please enter a valid email address</span>");
    }

    // Check if the file already exists
    $test = $_POST['ref'] . $_POST['email'];
    $query = $pdo->prepare("SELECT * FROM correspondence WHERE test = ?");
    $query->execute([$test]);
    $result = $query->rowCount();
    if ($result > 0) {
        die("<span class='error'><br>This file already exists - Please try again</span>");
    }

    // Store values in session
    $_SESSION['ref'] = $_POST['ref'];
    $_SESSION['subject'] = $_POST['subject'];

    // Insert values into database
    $query = $pdo->prepare("INSERT INTO correspondence (ref, email, subject, contact, theirref, recipient, eparagraph, author, test, number) VALUES(:ref, :email, :subject, :contact, :theirref, :recipient, :eparagraph, :author, :test, :number)");
    $query->execute([
        'email' => $email,
        'test' => $test,
        'ref' => $_POST['ref'],
        'subject' => $_POST['subject'],
        'contact' => $_POST['contact'],
        'theirref' => $_POST['theirref'],
        'recipient' => $_POST['recipient'],
        'eparagraph' => $_POST['eparagraph'],
        'author' => $_POST['author'],
        'number' => "",
    ]);

    // Print success message
    echo "<span class='success'><br>Your file has been successfully created!</span>";
    echo "<a href='../../generatorctest.php' class='btn'>Create again</a>";
} else if (isset($_POST['register'])) {

    // Validate email
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "<span class='warning'><br>Please enter a valid email address</span>";
    }

    // Check if user email exists 
    $test = $_POST['ref'] . $email;
    $query = $pdo->prepare("SELECT COUNT(*) FROM correspondence WHERE test = ?");
    $query->execute([$test]);
    $result = $query->fetchColumn();
    if ($result > 0) {
        $error =  "<span class='error'><br>This file already exists - Please try again</span>";
    }

    // Sanitize and validate inputs
    $ref = filter_var($_POST['ref'], FILTER_SANITIZE_STRING);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $contact = filter_var($_POST['contact'], FILTER_SANITIZE_STRING);
    $theirref = filter_var($_POST['theirref'], FILTER_SANITIZE_STRING);
    $recipient = filter_var($_POST['recipient'], FILTER_SANITIZE_STRING);
    $eparagraph = filter_var($_POST['eparagraph'], FILTER_SANITIZE_STRING);
    $author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['path1'], FILTER_SANITIZE_STRING);
    $test = $ref . $email;

    $_SESSION['ref'] = $ref;
    $_SESSION['subject'] = $subject;

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO correspondence (ref, email, subject, contact, theirref, recipient, eparagraph, author, test, number) VALUES(:ref, :email, :subject, :contact, :theirref, :recipient, :eparagraph, :author, :test, :number)");
        $query->execute([
            'email' => $email,
            'test' => $test,
            'ref' => $ref,
            'subject' => $subject,
            'contact' => $contact,
            'theirref' => $theirref,
            'recipient' => $recipient,
            'eparagraph' => $eparagraph,
            'author' => $author,
            'number' => $number,
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
        echo "<a href='../../generatorctest.php' class='btn'>Create again</a>";
    }
}

?>

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
        overflow: hidden;
    }
</style>


</html>