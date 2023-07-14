<?php
session_start();
echo $_SESSION['Pleadings'];
$_SESSION['reference'] = $_POST['reference'];
echo $_SESSION['reference'];
