<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
    <title>Contacts</title>
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
</head>

<body>
    <div id="test">
        <navi>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>

            <body style="background-color: black">
                <ul class="nav-linker">
                    <li><a class="nav-link" href="../Index.html">Home</a></li>
                    <li><a class="nav-link" href="newfile.html">New&nbspFile</a></li>
                    <li><a class="nav-link" href="correspondence.html">Correspondence</a></li>
                    <li><a class="nav-link" href="pleadings.html">Pleadings</a></li>
                    <li><a class="nav-link active" href="contactshome.html">Contacts</a></li>
                    <li><a class="nav-link" href="dropdownlegislation.php">Legislation</a></li>
                    <li><a class="nav-link" href="edit.php">Edit</a></li>
                    <li><a class="nav-link" id="plus" href="extras.html">+</a></li>
                </ul>
        </navi>

        <?php
        if (isset($_GET['error'])) {
            echo '<div id="error">' . $_GET['error'] . '</div>';
        }

        if (isset($_GET['success'])) {
            echo '<div id="success">' . $_GET['success'] . '</div>';
        }
        ?>

        <body>
            <form action="./fetch2.php" method="post">
                <label for="heading" class="searchheading">View contacts:</label>
                <div class="searchlable">
                    <label for="cname">Reference number:</label>
                </div>
                <div class="col-75">
                    <input type="text" class="input4" id="reference" style="text-transform:capitalize" name="reference" value="" autofocus="on" required autocomplete="off">
                </div>
                <div>
                    <div><br><br><br><br><br><br>
                        <input type="submit" tabindex="2" class="inputsearch" value="View ❯">
                    </div>
                    <div>
                        <a class="btnsearch" tabindex="1" href="../../frontend2/Pages/contactshome.html">❮&nbsp&nbspBack</a>
                    </div>
                </div>
                <img src="../Documents/hex.png" class="hexagons" alt="Outline of three hexagons">
                <img src="../Documents/hex2.png" class="hexagons2" alt="Outline of two hexagons">
        </body>

</html>
<script>
    setTimeout(function() {
        document.querySelector('#error').style.display = 'none';
        document.querySelector('#success').style.display = 'none';
    }, 2000);
</script>
<style>
    #error,
    #success {
        position: fixed;
        top: -30px;
        left: 0;
        right: 0;
        padding: 20px;
        height: 20px;
        color: #fff;
        text-align: center;
        z-index: 9999;
    }
</style>