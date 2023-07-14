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
        </style>
        <div class="body-text">
            <h1>Select the first letter of the pleading you want to create:</h1>
        </div>

        <form action='messaround3.php' method='post' class='mb-3'>
            <div class='select-block'>
                <select name='Pleadings'>
                    <option value='a'>A</option>
                    <option value='b'>B</option>
                    <option value='c'>C</option>
                    <option value='d'>D</option>
                    <option value='e'>E</option>
                    <option value='f'>F</option>
                    <option value='g'>G</option>
                    <option value='h'>H</option>
                    <option value='i'>I</option>
                    <option value='j'>J</option>
                    <option value='k'>K</option>
                    <option value='l'>L</option>
                    <option value='m'>M</option>
                    <option value='n'>N</option>
                    <option value='o'>O</option>
                    <option value='p'>P</option>
                    <option value='q'>Q</option>
                    <option value='r'>R</option>
                    <option value='s'>S</option>
                    <option value='t'>T</option>
                    <option value='u'>U</option>
                    <option value='v'>V</option>
                    <option value='w'>W</option>
                    <option value='x'>X</option>
                    <option value='y'>Y</option>
                    <option value='z'>Z</option>
                </select>
            </div>
            <input type='submit' class='input4' name='submit' value='Next'>
        </form><br><br><br>
        <img src="../frontend2/Documents/hex3black.png" class="hexagonssend" alt="Outline of three hexagons">
        <img src="../frontend2/Documents/hex2black.png" class="hexagons2send" alt="Outline of two hexagons">
    </div>
</body>
</head>
<style>

</style>

</html>