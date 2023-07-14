<?php
$directory = "Z:\Shared Data - USERS";
$user = "Lloyd";
$filename = "W12345 APPLE.BROWN";
$pathname = "$directory\\$user\\";
$pathname2 = "$pathname\\$filename\\";
if (file_exists($pathname . "$filename")) {
    echo '<script>alert("This file already exists")</script>';
} else {
    (mkdir($pathname . "$filename", 0777));
    (mkdir($pathname2 . "CORRESPONDENCE", 0777));
    (mkdir($pathname2 . "PLEADINGS", 0777));
    (mkdir($pathname2 . "CLIENT'S FILE OF PAPERS", 0777));
    (mkdir($pathname2 . "SCANS", 0777));
    echo '<script>alert("File ' . $filename . ' was successfuly created!")</script>';
}
