<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Select a Pleading</title>
    <link rel="stylesheet" href="../../../app.css" />

<body>
    <div id="test">
        <nav>
            <div class="heading">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linkerb">
                <li><a class="nav-linked" href="../../../Index.html">Home</a></li>
                <li><a class="nav-linked" href="../../newfile.html">New&nbspFile</a></li>
                <li><a class="nav-linked" href="../../correspondence.html">Correspondence</a></li>
                <li><a class="nav-linked active" href="../../pleadings.html">Pleadings</a></li>
                <li><a class="nav-linked " href="../../contactshome.html">Contacts</a></li>
                <li><a class="nav-linked" href="../../dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-linked" href="../../edit.php">Edit</a></li>
            </ul>
        </nav>

        <style>
            .container {
                max-width: 350px;
                margin: 50px auto;
                text-align: center;
            }

            input[type="submit"] {
                margin-bottom: 20px;
                left: 0px;
            }

            .select-block {
                width: 300px;
                margin: 110px auto 30px;

            }

            select {
                width: 100%;
                height: 50px;
                font-size: 100%;
                font-weight: bold;
                cursor: pointer;
                border-radius: 0;
                background-color: black;
                border: none;
                border: 2px solid black;
                border-radius: 4px;
                color: white;
                appearance: none;
                padding: 8px 38px 10px 18px;
                -webkit-appearance: none;
                -moz-appearance: none;
                transition: color 0.3s ease, background-color 0.3s ease, border-bottom-color 0.3s ease;
                left: 0px;
                top: -105px;
            }

            /* For IE <= 11 */
            select::-ms-expand {
                display: none;
            }

            select:hover,
            select:focus {
                color: #000000;
                background-color: white;
                border: 2px solid black;
            }

            .hexagonssend {
                display: block;
                margin-top: -349px;

            }

            .hexagons2send {
                display: block;
                position: absolute;
                left: 956px;
                top: 341px;

            }
        </style>
        <div class="body-text">
            <h1>Select a Pleading:</h1>
        </div>

        <?php
        session_start();

        echo "<form action='pageb.php' method='post' class='mb-3'>
<div class='select-block'>
    <select name='Pleadings'>
        <option value=''> Select an item</option>
        <option value='Notice of Bar'>Notice of Bar</option>
        <option value='notice to defend'>Notice of Intention to Defend</option>
        <option value='rule 23 notice'>Rule 23 Notices</option>
        <option value='rule35'>Rule 35 Notices</option>
        <option value='summons'>Summons - HC</option>
    </select>
</div>
<input type='submit' class='input4' name='submit' value='Next'>
</form>";
        ?>
        <img src="../../../Documents/hex3black.png" class="hexagonssend" alt="Outline of three hexagons">
        <img src="../../../Documents/hex2black.png" class="hexagons2send" alt="Outline of two hexagons">
    </div>
</body>
</head>
<style>

</style>

</html>