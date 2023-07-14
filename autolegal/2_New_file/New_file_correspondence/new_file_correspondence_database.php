<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../9_Style/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
    <title>Delete Correspondence</title>
</head>
<style>
    a.btnbackpleading_correspondence:link,
    a.btnbackpleading_correspondence:visited,
    a.btnbackpleading_correspondence:hover,
    a.btnbackpleading_correspondence:active {
        border: solid 2px white;
    }
</style>

<body style="background-color: black">
    <div id="test">
        <nav>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
                <li><a class="nav-link active" href="../2_New_file/Index.php">New&nbspFile</a></li>
                <li><a class="nav-link" href="../3_Correspondence/Index.php">Correspondence</a></li>
                <li><a class="nav-link" href="../4_Pleadings/Index.php">Pleadings</a></li>
                <li><a class="nav-link" href="../5_Contacts/Index.php">Contacts</a></li>
                <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
                <li><a class="nav-link " href="../7_Edit/Index.php">Edit</a></li>
                <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
            </ul>
        </nav>
</body>

<?php
// Include database configuration
require_once "../../10_Database/database.php";

// Validate input values
$savelocation = $_SESSION['saveLocation'];
$email = $_SESSION['email'];
$subject = $_SESSION["subject"];
$contact = $_SESSION["contact"];
$theirref = $_SESSION["theirref"];
$recipient = $_SESSION["recipient"];
$eparagraph = $_SESSION["eparagraph"];
$author = $_SESSION["author"];
$author_full_name = $_SESSION["author_full_name"];
$reference = $_SESSION["reference"];

if ($savelocation === "prompt") {
    // Check if email is valid

    if (!$email) {
        die("<span class='warning'><br>Please enter a valid email address</span>");
    }

    // Check if the file already exists

    $test = $reference . $email;

    $query = $pdo->prepare("SELECT * FROM correspondence WHERE test = ?");
    $query->execute([$test]);
    $result = $query->rowCount();
    if ($result > 0) {
        die("<span class='error'><br>This file already exists - Please try again</span>");
    }

    // Insert values into database
    $query = $pdo->prepare("INSERT INTO correspondence (ref, email, subject, contact, theirref, recipient, eparagraph, author, author_full_name, test, number) 
    VALUES(:ref, :email, :subject, :contact, :theirref, :recipient, :eparagraph, :author, :author_full_name, :test, :number)");
    $query->execute([
        'email' => $email,
        'test' => $test,
        'ref' => $reference,
        'subject' => $subject,
        'contact' => $contact,
        'theirref' => $theirref,
        'recipient' => $recipient,
        'eparagraph' => $eparagraph,
        'author' => $author,
        'author_full_name' => $author_full_name,
        'number' => "",
    ]);

    // Print success message
    echo "<span class='success'><br>Your file has been successfully created!</span>";
    echo "<a href='../New_file_correspondence.php' class='btnbackpleading_correspondence'>❮ Back</a>";
    unset($_SESSION['reference']);
    unset($_SESSION['saveLocation']);
    unset($_SESSION['email']);
    unset($_SESSION["subject"]);
    unset($_SESSION["contact"]);
    unset($_SESSION["theirref"]);
    unset($_SESSION["recipient"]);
    unset($_SESSION["eparagraph"]);
    unset($_SESSION["author"]);
    unset($_SESSION["author_full_name"]);
}
if ($savelocation === "folder") {

    $number = $_SESSION["path1"];
    $test = $reference . $email;
    $query = $pdo->prepare("SELECT COUNT(*) FROM correspondence WHERE test = ?");
    $query->execute([$test]);
    $result = $query->fetchColumn();
    if ($result > 0) {
        $error =  "<span class='error'><br>This file already exists - Please try again</span>";
    }

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO correspondence 
        (ref, email, subject, contact, theirref, recipient, eparagraph, author, author_full_name, test, number) 
        VALUES(:ref, :email, :subject, :contact, :theirref, :recipient, :eparagraph, :author, :author_full_name, :test, :number)");

        $query->execute([
            'email' => $email,
            'test' => $test,
            'ref' => $reference,
            'subject' => $subject,
            'contact' => $contact,
            'theirref' => $theirref,
            'recipient' => $recipient,
            'eparagraph' => $eparagraph,
            'author' => $author,
            'number' => $number,
            'author_full_name' => $author_full_name,
        ]);
        echo "<span class='success'><br>Your file has been successfully created!</span>";
        echo "<a  href='../New_file_correspondence.php' class='btnbackpleading_correspondence'>❮ Back</a>";
        unset($_SESSION['reference']);
        unset($_SESSION['saveLocation']);
        unset($_SESSION['email']);
        unset($_SESSION["subject"]);
        unset($_SESSION["contact"]);
        unset($_SESSION["theirref"]);
        unset($_SESSION["recipient"]);
        unset($_SESSION["eparagraph"]);
        unset($_SESSION["author"]);
        unset($_SESSION["path1"]);
        unset($_SESSION["author_full_name"]);
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