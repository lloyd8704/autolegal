<?php
session_start();
$_SESSION['test'] = $_POST['opponents'];
$msg = $_SESSION['test'];
echo $msg;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../app.css">
    <title>Correspondence</title>
</head>

<form action="pleadings3.php" method="post">

    <div class="row">
        <div class="col-25">
            <label for="opponents">How many opponents?</label>
        </div>
        <div class="col-75">
            <select id="author" name="letters">
                <option value="a">a</option>
                <option value="b">b</option>
                <option value="c">c</option>

            </select>
        </div>
    </div>

    <div class="row">
        <input type="submit" class="input1" value="Submit &nbsp❯" name="register" tabindex="3" />
        <input type="reset" tabindex="2" value="Reset" name="reset" />
    </div>
</form>
</div>
<div>
    <a class="btn10" tabindex="1" href="../frontend2/Pages/newfile.html">❮&nbsp&nbsp&nbspBack</a>
</div>
</div>
</body>

</html>