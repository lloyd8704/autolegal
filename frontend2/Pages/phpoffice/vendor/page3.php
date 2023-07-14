<?php
session_start();
$name1 = $_POST["Req"];
echo "Thank you for your request, $name1!";


echo $_SESSION['Name'];
