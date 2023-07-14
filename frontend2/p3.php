<?php

session_start();
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
    $number == "1P1D" & $_POST['onepname'] == "" & $_POST['onedname'] == ""
) {
    echo "Please insert Plaintiff's and Defendant's name";
} elseif ($_SESSION['opponents'] == "1P1D") {
    isset($_POST['register']);
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "1P2D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "1P3D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "1P4D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "1P5D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['fivedname'] = $_POST['fivedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "1P6D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['fivedname'] = $_POST['fivedname'];
    $_SESSION['sixdname'] = $_POST['sixdname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "2P1D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "2P2D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "2P3D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "2P4D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "2P5D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['fivedname'] = $_POST['fivedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "2P6D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['fivedname'] = $_POST['fivedname'];
    $_SESSION['sixdname'] = $_POST['sixdname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "3P1D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "3P2D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "3P3D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['number'] = $_SESSION['number'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "3P4D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "3P5D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['fivedname'] = $_POST['fivedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "3P6D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['fivedname'] = $_POST['fivedname'];
    $_SESSION['sixdname'] = $_POST['sixdname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "4P1D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "4P2D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "4P3D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "4P4D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "4P5D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['fivedname'] = $_POST['fivedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "4P6D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['fivedname'] = $_POST['fivedname'];
    $_SESSION['sixdname'] = $_POST['sixdname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "5P1D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['fivepname'] = $_POST['fivepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "5P2D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['fivepname'] = $_POST['fivepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "5P3D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['fivepname'] = $_POST['fivepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "5P4D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['fivepname'] = $_POST['fivepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "5P5D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['fivepname'] = $_POST['fivepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['fivedname'] = $_POST['fivedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "5P6D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['fivepname'] = $_POST['fivepname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['fivedname'] = $_POST['fivedname'];
    $_SESSION['sixdname'] = $_POST['sixdname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "6P1D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['fivepname'] = $_POST['fivepname'];
    $_SESSION['sixpname'] = $_POST['sixpname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "6P2D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['fivepname'] = $_POST['fivepname'];
    $_SESSION['sixpname'] = $_POST['sixpname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "6P3D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['fivepname'] = $_POST['fivepname'];
    $_SESSION['sixpname'] = $_POST['sixpname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "6P4D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['fivepname'] = $_POST['fivepname'];
    $_SESSION['sixpname'] = $_POST['sixpname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "6P5D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['fivepname'] = $_POST['fivepname'];
    $_SESSION['sixpname'] = $_POST['sixpname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['fivedname'] = $_POST['fivedname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
} elseif ($_SESSION['opponents'] == "6P6D") {
    $_SESSION['onepname'] = $_POST['onepname'];
    $_SESSION['twopname'] = $_POST['twopname'];
    $_SESSION['threepname'] = $_POST['threepname'];
    $_SESSION['fourpname'] = $_POST['fourpname'];
    $_SESSION['fivepname'] = $_POST['fivepname'];
    $_SESSION['sixpname'] = $_POST['sixpname'];
    $_SESSION['onedname'] = $_POST['onedname'];
    $_SESSION['twodname'] = $_POST['twodname'];
    $_SESSION['threedname'] = $_POST['threedname'];
    $_SESSION['fourdname'] = $_POST['fourdname'];
    $_SESSION['fivedname'] = $_POST['fivedname'];
    $_SESSION['sixdname'] = $_POST['sixdname'];
    $_SESSION['number'] = $_SESSION['number'];
    include '../frontend2/Pages/user/registerpleadings.php';
    readfile("p4.php");
}
