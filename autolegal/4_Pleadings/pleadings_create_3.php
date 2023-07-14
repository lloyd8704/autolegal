<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}

$_SESSION['Pleadings'] = $_POST['pleadings'];
$_SESSION['whichcourt'] = filter_var($_POST['whichcourt'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$name1 = $_SESSION['Pleadings'];
if (str_contains($name1, '- Code P0')) {
    include("../4_Pleadings/pleadings_create_5.php");
} else if (str_contains($name1, '- Code PA')) {
    include("../4_Pleadings/pleadings_create_5.php");
} else if (str_contains($name1, '- Code A')) {
    include("../4_Pleadings/pleadings_create_5.php");
} else if (str_contains($name1, '- Code W')) {
    include("../4_Pleadings/pleadings_create_5.php");
} else if (str_contains($name1, '- Code PD')) {
    include("../4_Pleadings/pleadings_create_5.php");
} else
    include("../4_Pleadings/pleadings_create_5e.php");
?>
<style>
    body {
        overflow: hidden;
    }

    #btnsearchpleadings {
        top: 22px;
    }
</style>