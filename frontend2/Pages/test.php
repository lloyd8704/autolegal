<?php
include 'header_correspondence.html';

if (isset($_GET['error'])) {
    echo '<div id="error">' . $_GET['error'] . '</div>';
}

if (isset($_GET['success'])) {
    echo '<div id="success">' . $_GET['success'] . '</div>';
}
?>

<form action="./fetch.php" method="post">
    <label for="heading" class="searchheading">Send a letter:</label>
    <div class="searchlable">
        <label for="cname">Reference number:</label>
    </div>
    <div class="col-75">
        <input type="text" class="input4" id="reference" style="text-transform:capitalize" name="reference" value="" autofocus="on" required autocomplete="off">
    </div>
    <div><br><br><br><br><br><br>
        <input type="submit" tabindex="2" class="inputsearch" value="Send ❯">
    </div>
    <div>
        <a class="btnsearch" tabindex="1" href="../../frontend2/Pages/correspondence.html">❮&nbsp&nbspBack</a>
    </div>
    </div>
    <img src="../Documents/hex.png" class="hexagons" alt="Outline of three hexagons">
    <img src="../Documents/hex2.png" class="hexagons2" alt="Outline of two hexagons">
    </body>

    </html>
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