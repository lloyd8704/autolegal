<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Select a Pleading</title>
    <link rel="stylesheet" href="../frontend2/app.css" />

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
                width: 50%;
                height: 50px;
                font-size: x-large;
                font-weight: bold;
                cursor: pointer;
                border-radius: 0;
                background-color: black;
                border: none;
                border: 2px solid black;
                border-radius: 4px;
                color: white;
                appearance: auto;
                padding: 8px 38px 10px 60px;
                -webkit-appearance: auto;
                -moz-appearance: auto;
                transition: color 0.3s ease, background-color 0.3s ease, border-bottom-color 0.3s ease;
                left: 67px;
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

            .dropdown {
                font-family: "Montserrat", sans-serif;
                font-size: x-large;
                color: blue;
            }

            .datalist {
                color: red
            }
        </style>
    </div><br>

    <form action="../frontend2/messaround3.php" method="post">
        <label for="browser">Choose your browser from the list:</label>
        <input list="browsers" name="browser" id="browser" autocomplete="off" autofocus class=dropdown>
        <datalist id="browsers">
            <option value="Notice of Bar">
            <option value="Notice of Intention to Defend">
            <option value="Summons">
            <option value="Rule 35">
            <option value="Rule 23">
        </datalist>
        <input type="submit">
        <input type="reset">
    </form>