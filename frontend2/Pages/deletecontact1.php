<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
    <title>Delete a Contact</title>
</head>

<body style="background-color: black">
    <div id="test">
        <navi>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../Index.html">Home</a></li>
                <li><a class="nav-link" href="../Pages/newfile.html">New&nbspFile</a></li>
                <li><a class="nav-link" href="../Pages/correspondence.html">Correspondence</a></li>
                <li><a class="nav-link" href="../Pages/pleadings.html">Pleadings</a></li>
                <li><a class="nav-link" href="../Pages/contactshome.html">Contacts</a></li>
                <li><a class="nav-link" href="../Pages/dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-link active" href="edit.php">Edit</a></li>
            </ul>
        </navi>
</body>

<form action="../Pages/deletecontact2.php" method="post">
    <label for="heading" class="searchheading">Delete a Contact:</label>
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
        <a class="btnsearch" tabindex="1" href="../../frontend2/Pages/delete.php">❮&nbsp&nbspBack</a>
    </div>

    </div>
    <img src="../Documents/hex.png" class="hexagons" alt="Outline of three hexagons">
    <img src="../Documents/hex2.png" class="hexagons2" alt="Outline of two hexagons">
    </body>

</html>