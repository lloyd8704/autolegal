<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}

$plaintiffs = $_POST['plaintiffs'];
$defendants = $_POST['defendants'];
$number = $plaintiffs . $defendants;
$_SESSION['opponents'] = $number;

if ($number == "0P0D") {
    echo "No items selected";
} elseif (
    $number == "1P0D" or $number == "2P0D" or $number == "3P0D" or $number == "4P0D"
    or $number == "5P0D" or $number == "6P0D"
) {
    echo "No Defendants selected";
} elseif (
    $number == "0P1D" or $number == "0P2D" or $number == "0P3D" or $number == "0P4D"
    or $number == "0P5D" or $number == "0P6D"
) {
    echo "No Plaintiffs selected";
} elseif (
    $number == "1P1D" & $_POST['onepname'] == ""
) {
    echo "Please insert Plaintiff's name";
} elseif (
    $number == "1P1D" & $_POST['onedname'] == ""
) {
    echo "Please insert Defendant's name";
} elseif (
    $number == "1P1D" & $_POST['onepname'] == "" &
    $_POST['onedname']  == ""
) {
    echo "Please insert Plaintiff's and Defendant's name";
} elseif ($_SESSION['opponents'] == "1P1D") {
    isset($_POST['register']);
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "1P2D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "1P3D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "1P4D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "1P5D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['fivedname'] = strtoupper($_POST['fivedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "1P6D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['fivedname'] = strtoupper($_POST['fivedname']);
    $_SESSION['sixdname'] = strtoupper($_POST['sixdname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "2P1D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "2P2D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "2P3D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "2P4D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "2P5D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['fivedname'] = strtoupper($_POST['fivedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "2P6D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['fivedname'] = strtoupper($_POST['fivedname']);
    $_SESSION['sixdname'] = strtoupper($_POST['sixdname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "3P1D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "3P2D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "3P3D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "3P4D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "3P5D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['fivedname'] = strtoupper($_POST['fivedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "3P6D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['fivedname'] = strtoupper($_POST['fivedname']);
    $_SESSION['sixdname'] = strtoupper($_POST['sixdname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "4P1D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "4P2D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "4P3D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "4P4D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "4P5D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['fivedname'] = strtoupper($_POST['fivedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "4P6D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['fivedname'] = strtoupper($_POST['fivedname']);
    $_SESSION['sixdname'] = strtoupper($_POST['sixdname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "5P1D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['fivepname'] = strtoupper($_POST['fivepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "5P2D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['fivepname'] = strtoupper($_POST['fivepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "5P3D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['fivepname'] = strtoupper($_POST['fivepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "5P4D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['fivepname'] = strtoupper($_POST['fivepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "5P5D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['fivepname'] = strtoupper($_POST['fivepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['fivedname'] = strtoupper($_POST['fivedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "5P6D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['fivepname'] = strtoupper($_POST['fivepname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['fivedname'] = strtoupper($_POST['fivedname']);
    $_SESSION['sixdname'] = strtoupper($_POST['sixdname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "6P1D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['fivepname'] = strtoupper($_POST['fivepname']);
    $_SESSION['sixpname'] = strtoupper($_POST['sixpname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "6P2D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['fivepname'] = strtoupper($_POST['fivepname']);
    $_SESSION['sixpname'] = strtoupper($_POST['sixpname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "6P3D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['fivepname'] = strtoupper($_POST['fivepname']);
    $_SESSION['sixpname'] = strtoupper($_POST['sixpname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "6P4D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['fivepname'] = strtoupper($_POST['fivepname']);
    $_SESSION['sixpname'] = strtoupper($_POST['sixpname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "6P5D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['fivepname'] = strtoupper($_POST['fivepname']);
    $_SESSION['sixpname'] = strtoupper($_POST['sixpname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['fivedname'] = strtoupper($_POST['fivedname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
} elseif ($_SESSION['opponents'] == "6P6D") {
    $_SESSION['onepname'] = strtoupper($_POST['onepname']);
    $_SESSION['twopname'] = strtoupper($_POST['twopname']);
    $_SESSION['threepname'] = strtoupper($_POST['threepname']);
    $_SESSION['fourpname'] = strtoupper($_POST['fourpname']);
    $_SESSION['fivepname'] = strtoupper($_POST['fivepname']);
    $_SESSION['sixpname'] = strtoupper($_POST['sixpname']);
    $_SESSION['onedname'] = strtoupper($_POST['onedname']);
    $_SESSION['twodname'] = strtoupper($_POST['twodname']);
    $_SESSION['threedname'] = strtoupper($_POST['threedname']);
    $_SESSION['fourdname'] = strtoupper($_POST['fourdname']);
    $_SESSION['fivedname'] = strtoupper($_POST['fivedname']);
    $_SESSION['sixdname'] = strtoupper($_POST['sixdname']);
    $_SESSION['number'] = $_SESSION['number'];
    include '../New_file_pleading/new_file_pleadings_register_database.php';
    readfile("../New_file_pleading/new_file_pleadings_database_5.php");
}
