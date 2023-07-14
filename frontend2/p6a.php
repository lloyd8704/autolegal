<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../frontend2/app.css">
    <title>Add a Party</title>
    <link rel="shortcut icon" type="image/x-icon" href="../frontend2/favicon.ico">
</head>

<body style="background-color: black">
    <div id="test">
        <navi>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../frontend2/Index.html">Home</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/newfile.html">New&nbspFile</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/correspondence.html">Correspondence</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/pleadings.html">Pleadings</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/contactshome.html">Contacts</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-link active" href="../frontend2/Pages/edit.php">Edit</a></li>
            </ul>
        </navi>
</body>

<form action="../frontend2/p7.php" method="post">
    <label for="heading" class="searchheading">Add Parties:</label>
    <div class="searchlable">
        <label for="cname">Reference number:</label>
    </div>
    <div class="col-75">
        <input type="text" class="input4" id="reference" style="text-transform:capitalize" name="reference" value="" autofocus="on" required autocomplete='off'>
    </div>
    <div><br><br><br><br><br><br>
        <input type="submit" tabindex="2" class="inputcreate" value="Next&nbsp ❯">
    </div>
    <div>
        <a class="btnsearch" tabindex="1" href="../frontend2/Pages/edit2.php">❮&nbsp&nbspBack</a>
    </div>
    </div>
    <img src="../frontend2/Documents/hex.png" class="hexagons" alt="Outline of three hexagons">
    <img src="../frontend2/Documents/hex2.png" class="hexagons2" alt="Outline of two hexagons">
    </body>

</html>