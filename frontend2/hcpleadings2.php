<?php
session_start();
$_SESSION['Pleadings'] = $_POST['pleadings'];


$name1 = $_SESSION['Pleadings'];
if (str_contains($name1, '- Code P0')) {
    include("../vendor/pageb1a.php");
} else if (str_contains($name1, '- Code PA')) {
    include("../vendor/pageb1a.php");
} else if (str_contains($name1, '- Code A')) {
    include("../vendor/pageb1a.php");
} else if (str_contains($name1, '- Code W')) {
    include("../vendor/pageb1a.php");
} else
    include("../frontend2/hcpleadings3.php");
