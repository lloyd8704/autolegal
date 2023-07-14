<?php
session_start();


echo "<form action='test3.html' method='post'>
Please enter your name: <input type='text' name='Name'/>
<input type='submit' value='Submit'/></form>";
$_SESSION['Name'] = $name;
