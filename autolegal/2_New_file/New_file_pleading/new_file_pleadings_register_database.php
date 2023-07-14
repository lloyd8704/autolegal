<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../9_Style/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
    <title>Delete Correspondence</title>
</head>


<?php


require_once "../../10_Database/database.php";

$_SESSION['reference'];
$_SESSION['onepname'];
$_SESSION['onedname'];
$_SESSION['reference'];
$_SESSION['court'];
$_SESSION['casenumber'];
$_SESSION['location'];
$_SESSION['ourdetails'];
$_SESSION['author'];
$_SESSION['number'];

if ($_SESSION['author'] == "lloyd") {
    $authorwithcaps = "LLOYD ANTHONY MANNING";
} else if ($_SESSION['author'] == "lucas") {
    $authorwithcaps = "LUCAS CORNNELIUS DE SWARDT";
} else if ($_SESSION['author'] == "nontsha") {
    $authorwithcaps = "NONTSHA MDWAYI";
} else if ($_SESSION['author'] == "stefan") {
    $authorwithcaps = "STEFAN JACOBUS DE SWARDT";
}


$_SESSION['opponents'];
$_SESSION['represent'];

$test = $_SESSION['reference'];
$query = $pdo->prepare("SELECT * FROM pleadings WHERE reference = ?");
$query->execute([$test]);
$result = $query->rowCount();
if ($result > 0) {
    $error =  "<span class='error'><br>This file already exists - Please try again</span>";
}
if ($_SESSION['opponents'] == "1P1D") {
    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court, :casenumber, :location, :ourdetails
    , :author, :number, :represent, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
    }
}
if ($_SESSION['opponents'] == "1P2D") {
    $_SESSION['twodname'];
    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twodname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court, :casenumber, :location, :ourdetails
    , :author, :number, :represent, :twodname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twodname' => $_SESSION['twodname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],

        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "1P3D") {
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twodname, threedname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court, :casenumber, :location, :ourdetails
    , :author, :number, :represent, :twodname, :threedname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "1P4D") {
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];
    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twodname, threedname, fourdname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twodname, :threedname, :fourdname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],

        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "1P5D") {
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];
    $_SESSION['fivedname'];
    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twodname, threedname, fourdname, fivedname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twodname, :threedname, :fourdname, :fivedname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'fivedname' => $_SESSION['fivedname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "1P6D") {
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];
    $_SESSION['fivedname'];
    $_SESSION['sixdname'];
    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twodname, threedname, fourdname, fivedname, sixdname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twodname, :threedname, :fourdname, :fivedname, :sixdname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'fivedname' => $_SESSION['fivedname'],
            'sixdname' => $_SESSION['sixdname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "2P1D") {
    $_SESSION['twopname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "2P2D") {
    $_SESSION['twopname'];
    $_SESSION['twodname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, twodname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :twodname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'twodname' => $_SESSION['twodname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "2P3D") {
    $_SESSION['twopname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, twodname, threedname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :twodname, :threedname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "2P4D") {
    $_SESSION['twopname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, twodname, threedname, fourdname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :twodname, :threedname, :fourdname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "2P5D") {
    $_SESSION['twopname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];
    $_SESSION['fivedname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, twodname, threedname, fourdname, fivedname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :twodname, :threedname, :fourdname, :fivedname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'fivedname' => $_SESSION['fivedname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "2P6D") {
    $_SESSION['twopname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];
    $_SESSION['fivedname'];
    $_SESSION['sixdname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, twodname, threedname, fourdname, fivedname, sixdname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :twodname, :threedname, :fourdname, :fivedname, :sixdname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'fivedname' => $_SESSION['fivedname'],
            'sixdname' => $_SESSION['sixdname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "2P6D") {
    $_SESSION['twopname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];
    $_SESSION['fivedname'];
    $_SESSION['sixdname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, twodname, threedname, fourdname, fivedname, sixdname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :twodname, :threedname, :fourdname, :fivedname, :sixdname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'fivedname' => $_SESSION['fivedname'],
            'sixdname' => $_SESSION['sixdname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "3P1D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];


    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "3P2D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['twodname'];


    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, twodname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :twodname, :authorwithcaps, :save)");


        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'twodname' => $_SESSION['twodname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "3P3D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, twodname, threedname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :twodname, :threedname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],

        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "3P4D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, twodname, threedname, fourdname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :twodname, :threedname, :fourdname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "3P5D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];
    $_SESSION['fivedname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, twodname, threedname, fourdname, fivedname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :twodname, :threedname, :fourdname, :fivedname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'fivedname' => $_SESSION['fivedname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "3P6D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];
    $_SESSION['fivedname'];
    $_SESSION['sixdname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, twodname, threedname, fourdname, fivedname, sixdname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :twodname, :threedname, :fourdname, :fivedname, :sixdname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'fivedname' => $_SESSION['fivedname'],
            'sixdname' => $_SESSION['sixdname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "4P1D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];


    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "4P2D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['twodname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, twodname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :twodname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'twodname' => $_SESSION['twodname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "4P3D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, twodname, threedname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :twodname, :threedname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "4P4D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, twodname, threedname, fourdname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :twodname, :twodname, :threedname, :fourdname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "4P5D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];
    $_SESSION['fivedname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, twodname, threedname, fourdname, fivedname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :twodname, :threedname, :fourdname, :fivedname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'fivedname' => $_SESSION['fivedname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "4P6D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];
    $_SESSION['fivedname'];
    $_SESSION['sixdname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, twodname, threedname, fourdname, fivedname, sixdname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :twodname, :threedname, :fourdname, :fivedname, :sixdname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'fivedname' => $_SESSION['fivedname'],
            'sixdname' => $_SESSION['sixdname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "5P1D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['fivepname'];


    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, fivepname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :fivepname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'fivepname' => $_SESSION['fivepname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "5P2D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['fivepname'];
    $_SESSION['twodname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, fivepname, twodname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :fivepname, :twodname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'fivepname' => $_SESSION['fivepname'],
            'twodname' => $_SESSION['twodname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "5P3D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['fivepname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, fivepname, twodname, threedname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :fivepname, :twodname, :threedname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'fivepname' => $_SESSION['fivepname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "5P4D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['fivepname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, fivepname, twodname, threedname, fourdname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :fivepname, :twodname, :threedname, :fourdname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'fivepname' => $_SESSION['fivepname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "5P5D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['fivepname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];
    $_SESSION['fivedname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, fivepname, twodname, threedname, fourdname, fivedname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :fivepname, :twodname, :threedname, :fourdname, :fivedname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'fivepname' => $_SESSION['fivepname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'fivedname' => $_SESSION['fivedname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "5P6D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['fivepname'];
    $_SESSION['twodname'];
    $_SESSION['threedname'];
    $_SESSION['fourdname'];
    $_SESSION['fivedname'];
    $_SESSION['sixdname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, fivepname, twodname, threedname, fourdname, fivedname, sixdname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :fivepname, :twodname, :threedname, :fourdname, :fivedname, :sixdname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'fivepname' => $_SESSION['fivepname'],
            'twodname' => $_SESSION['twodname'],
            'threedname' => $_SESSION['threedname'],
            'fourdname' => $_SESSION['fourdname'],
            'fivedname' => $_SESSION['fivedname'],
            'sixdname' => $_SESSION['sixdname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "6P1D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['fivepname'];
    $_SESSION['sixpname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, fivepname, sixpname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :fivepname, :sixpname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'fivepname' => $_SESSION['fivepname'],
            'sixpname' => $_SESSION['sixpname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
    }
}
if ($_SESSION['opponents'] == "6P2D") {
    $_SESSION['twopname'];
    $_SESSION['threepname'];
    $_SESSION['fourpname'];
    $_SESSION['fivepname'];
    $_SESSION['sixpname'];
    $_SESSION['twodname'];

    if (empty($error)) {
        $query = $pdo->prepare("INSERT INTO pleadings (reference, onepname, onedname, court, casenumber, location,
    ourdetails, author, number, represent, twopname, threepname, fourpname, fivepname, sixpname, twodname, authorwithcaps, save) VALUES(:reference, :onepname, :onedname, :court,
     :casenumber, :location, :ourdetails, :author, :number, :represent, :twopname, :threepname, :fourpname, :fivepname, :sixpname, :twodname, :authorwithcaps, :save)");
        $query->execute([

            'reference' => $_SESSION['reference'],
            'onepname' => $_SESSION['onepname'],
            'onedname' => $_SESSION['onedname'],
            'court' => $_SESSION['court'],
            'casenumber' => $_SESSION['casenumber'],
            'location' => $_SESSION['location'],
            'ourdetails' => $_SESSION['ourdetails'],
            'author' => $_SESSION['author'],
            'number' => $_SESSION['opponents'],
            'twopname' => $_SESSION['twopname'],
            'threepname' => $_SESSION['threepname'],
            'fourpname' => $_SESSION['fourpname'],
            'fivepname' => $_SESSION['fivepname'],
            'sixpname' => $_SESSION['sixpname'],
            'twodname' => $_SESSION['twodname'],
            'represent' => $_SESSION['represent'],
            'authorwithcaps' => $authorwithcaps,
            'save' => $_SESSION['number'],
        ]);
        $msg = "<span class='success'><br>Your file has been successfully created!</span>";
        // Unset the sessions
        unset($_SESSION['reference']);
        unset($_SESSION['onepname']);
        unset($_SESSION['onedname']);
        unset($_SESSION['court']);
        unset($_SESSION['casenumber']);
        unset($_SESSION['location']);
        unset($_SESSION['ourdetails']);
        unset($_SESSION['author']);
        unset($_SESSION['number']);
        unset($_SESSION['opponents']);
        unset($_SESSION['represent']);
        unset($_SESSION['onepname']);
        unset($_SESSION['twopname']);
        unset($_SESSION['threepname']);
        unset($_SESSION['fourpname']);
        unset($_SESSION['fivepname']);
        unset($_SESSION['sixpname']);
        unset($_SESSION['onedname']);
        unset($_SESSION['twodname']);
        unset($_SESSION['threedname']);
        unset($_SESSION['fourdname']);
        unset($_SESSION['fivedname']);
        unset($_SESSION['sixdname']);
    }
}
