<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../app.css">
    <title>File Note</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../favicon.ico">

    <style>
        .container {
            background-color: black;
            border: 4px solid white;
            padding: 20px;
            width: 350px;
            height: 505px;
            margin: 0 auto;
            position: relative;
            top: 55px;
            overflow: hidden;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: white;
            font-size: 16px;
            font-weight: bold;
            font-family: "Montserrat", sans-serif;
        }

        input[type="text"],
        textarea {
            background-color: white;
            color: black;
            border: none;
            padding: 10px;
            width: 100%;

            font-weight: bold;
            font-family: "Montserrat", sans-serif;
        }

        textarea {
            height: 310px;
            width: 527px;
            left: 366px;
            top: -245px;
            font-size: 17px;
        }

        body {

            background-color: black;
            overflow: hidden;
        }

        .text-center {
            text-align: center;


        }

        .submit-button {
            background-color: black;
            color: white;
            border: 2px solid white;
            padding: 10px 20px;
            display: block;
            margin: 0 auto;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            font-family: "Montserrat", sans-serif;
            cursor: pointer;
            position: relative;
            top: 20px;
        }

        .submit-button:hover {
            background-color: white;
            color: black;
        }

        #to,
        #from,
        #file {
            left: 0px;
            width: 300px;
        }

        #to:hover,
        #from:hover {
            cursor: pointer;
        }

        #instructionslable {
            position: relative;

            margin-left: 376px;

            top: -254px;
        }

        #leverarch {
            color: white;
            font-size: 33px;
            display: inline-block;
            padding: 5px;
            border: 2px solid black;
            background-color: black;
            position: fixed;
            top: 90px;
            left: 522px;
        }
    </style>
</head>

<body>
    <div id="test">
        <navi>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../../../Index.html">Home</a></li>
                <li><a class="nav-link" href="../../../Pages/newfile.html">New&nbspFile</a></li>
                <li><a class="nav-link" href="../../../Pages/correspondence.html">Correspondence</a></li>
                <li><a class="nav-link" href="../../../Pages/pleadings.html">Pleadings</a></li>
                <li><a class="nav-link" href="../../../Pages/contactshome.html">Contacts</a></li>
                <li><a class="nav-link" href="../../../Pages/dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-link" href="../../../Pages/edit.php">Edit</a></li>
                <li><a class="nav-link active" id="plus" href="../../../Pages/extras.html">+</a></li>
            </ul>
        </navi>
    </div>
    <form action="../vendor/file2.php" method="post">
        <div class="container">
            <div class="form-group">
                <label id="leverarch">Lever Arch</label>
                <br>
                <label for="file">Reference number:</label><br>
                <input style="text-transform: uppercase;" type="text" id="file" name="reference" autocomplete="off" autofocus>
            </div>
            <div class="form-group">
                <label for="file">First Party's name</label><br>
                <input style="text-transform: uppercase;" type="text" id="file" name="partyone" autocomplete="off">
            </div>

            <div class="form-group">
                <label for="file">Second Party's name</label><br>
                <input style="text-transform: uppercase;" type="text" id="file" name="partytwo" autocomplete="off">
            </div>

            <div class="form-group">
                <label for="file">Bottom of the label:</label><br>
                <input style="text-transform: uppercase;" type="text" id="file" name="recipient" placeholder="E.G. OFFICE FILE / COUNSEL'S BRIEF" autocomplete="off">
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="submit-button">Submit</button>
            </div>
        </div>
    </form>
</body>