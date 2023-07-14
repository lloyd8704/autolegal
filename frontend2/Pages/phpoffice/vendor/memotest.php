<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../app.css">
    <title>Correspondence</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../favicon.ico">

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
    <form action="../vendor/memo.php" method="post">
        <div class="container">
            <div class="form-group">
                <label id="memo">Memo</label><br>
                <label for="to">To whom:</label>
                <select name="to" id="to" required autofocus>
                    <option value="">Please select</option>
                    <option value="Denzil">Denzil</option>
                    <option value="Evelyn">Evelyn</option>
                    <option value="Lloyd">Lloyd</option>
                    <option value="Lucas">Lucas</option>
                    <option value="Nontsha">Nontsha</option>
                    <option value="Stefan">Stefan</option>
                    <option value="Zoe">Zoe</option>
                </select>
            </div>
            <div class="form-group">
                <label for="from">From:</label>
                <select name="from" id="from" required>
                    <option value="">Please select</option>
                    <option value="Lloyd">Lloyd</option>
                    <option value="Lucas">Lucas</option>
                    <option value="Nontsha">Nontsha</option>
                    <option value="Stefan">Stefan</option>
                    <option value="Zoe">Zoe</option>
                </select>
            </div>

            <div class="form-group">
                <label for="file">File reference:</label><br>
                <input type="text" id="file" name="file" autocomplete="off">
            </div>
            <br>
            <div class="form-group">
                <label id="instructionslable" for="instructions">Instructions:</label>
                <textarea id="instructions" name="instructions" autocomplete="off"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="submit-button">Submit</button>
            </div>
    </form>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var toSelect = document.getElementById("to");
        var fromSelect = document.getElementById("from");
        var instructionsInput = document.getElementById("instructions");

        toSelect.addEventListener("change", function() {
            var selectedRecipient = toSelect.value;
            var instructions = "Dear " + selectedRecipient;
            instructionsInput.value = instructions;
        });

        fromSelect.addEventListener("change", function() {
            instructions = "Dear " + toSelect.value + ",\n\n";

            instructions += "\n\nThanks,";
            instructions += "\n\n" + fromSelect.value;
            document.getElementById("instructions").value = instructions;
        });
    });
</script>