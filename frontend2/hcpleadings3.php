<?php

$_SESSION['Pleadings'] = $_POST['pleadings'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../frontend2/app.css" />
    <title>Create a Pleading</title>
</head>

<body>
    <div id="test">

        <body style="background-color: black">
            <navi>
                <div class="heading1">
                    <h4>AutoLegal</h4>
                </div>
                <ul class="nav-linker">
                    <li><a class="nav-link" href="../../../Index.html">Home</a></li>
                    <li><a class="nav-link" href="../../newfile.html">New&nbspFile</a></li>
                    <li><a class="nav-link" href="../../correspondence.html">Correspondence</a></li>
                    <li><a class="nav-link active" href="../../pleadings.html">Pleadings</a></li>
                    <li><a class="nav-link" href="../../contactshome.html">Contacts</a></li>
                    <li><a class="nav-link" href="../../legislation.html">Legislation</a></li>
                    <li><a class="nav-link" href="../../edit.php">Edit</a></li>
                </ul>
            </navi>
        </body>

        <body>
            <form action="../frontend2/Pages/phpoffice/vendor/indexhc.php" method="post">
                <label for="heading" id="searchheading" class="searchheading">Create a Pleading:</label>
                <div class="searchlable">
                    <label for="cname">Reference number:</label>
                </div>
                <div class="col-75">
                    <input type="text" class="input4" id="reference" style="text-transform:capitalize" name="reference" value="" autofocus="on" required autocomplete="off">
                </div>
                <div><br><br><br><br><br><br>
                    <input type="submit" tabindex="2" class="inputsearch" value="Next ❯" name="register">
                </div>
                <div>
                    <a class="btnsearch" tabindex="1" href="../../../messaround4.php">❮&nbsp&nbspBack</a>
                </div>
    </div>
    <img src="../frontend2/Documents/hex.png" class="hexagons" alt="Outline of three hexagons">
    <img src="../frontend2/Documents/hex2.png" class="hexagons2" alt="Outline of two hexagons">
</body>

</html>