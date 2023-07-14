<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, redirect to login page
    header("Location: ../1_Home/login_auto.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../9_Style/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
    <title>File Note</title>
    <style>
        .container {
            background-color: black;
            border: 4px solid white;
            padding: 20px;
            width: 990px;
            height: 505px;
            margin: 0 auto;
            position: relative;
            top: 64px;
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
            bottom: 230px;
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

        #memo {
            color: white;
            font-size: 37px;
            display: inline-block;
            padding: 5px;
            border: 2px solid black;
            background-color: black;
            position: fixed;
            top: 97px;
            left: 200px;
        }
    </style>
</head>

<body>
    <div id="test">
        <nav>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
                <li><a class="nav-link" href="../2_New_file/Index.php">New&nbspFile</a></li>
                <li><a class="nav-link" href="../3_Correspondence/Index.php">Correspondence</a></li>
                <li><a class="nav-link" href="../4_Pleadings/Index.php">Pleadings</a></li>
                <li><a class="nav-link" href="../5_Contacts/Index.php">Contacts</a></li>
                <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
                <li><a class="nav-link" href="../7_Edit/Index.php">Edit</a></li>
                <li><a class="nav-link active" id="plus" href="../8_Extras/Index.php">+</a></li>
            </ul>
        </nav>
    </div>
    <form action="../8_Extras/extras_file_note_2.php" method="post">
        <div class="container">
            <div class="form-group">
                <label id="memo">File Note</label><br>
                <label for="to">Author:</label>
                <select name="to" id="to" required autofocus>
                    <option value="">Please select</option>
                    <option value="Evelyn">Evelyn</option>
                    <option value="Lloyd">Lloyd</option>
                    <option value="Lynette">Lynette</option>
                    <option value="Lucas">Lucas</option>
                    <option value="Nontsha">Nontsha</option>
                    <option value="Sharon">Sharon</option>
                    <option value="Stefan">Stefan</option>
                    <option value="Susan">Susan</option>
                    <option value="Zoe">Zoe</option>
                </select>
            </div>
            <div class="form-group">
                <label for="file">Reference number:</label><br>
                <input type="text" id="file" name="reference" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="file">Parties:</label><br>
                <input type="text" id="file" name="file" autocomplete="off">
            </div>

            <div class="form-group">
                <label id="instructionslable" for="instructions">Note:</label>
                <textarea id="instructions" name="instructions" autocomplete="off"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="submit-button">Submit</button>
            </div>
        </div>
    </form>
</body>