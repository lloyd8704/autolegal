<?php
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'correspdb';

try {
    //
    $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    //
    echo "Connection failed: ", $e->getMessage();
}
