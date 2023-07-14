<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
    <title>Legislation</title>
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
</head>

<body style="background-color: black">
    <navi>
        <div class="heading1">
            <h4>AutoLegal</h4>
        </div>
        <ul class="nav-linker">
            <li><a class="nav-link" href="../Index.html">Home</a></li>
            <li><a class="nav-link" href="newfile.html">New&nbspFile</a></li>
            <li><a class="nav-link" href="correspondence.html">Correspondence</a></li>
            <li><a class="nav-link" href="pleadings.html">Pleadings</a></li>
            <li><a class="nav-link " href="contactshome.html">Contacts</a></li>
            <li><a class="nav-link active" href="dropdownlegislation.php">Legislation</a></li>
            <li><a class="nav-link" href="edit.php">Edit</a></li>
            <li><a class="nav-link" id="plus" href="extras.html">+</a></li>
        </ul>
    </navi>
    </div>
    <br>
    <label for="heading" class="searchheadings">Select the first letter of the legislation you want to view:</label>

    <div class="button-container">
        <a href="../legislationa-c.html" class="btnnewfiles">A - C</a>
        <a href="../legislationd-f.html" class="btnnewfiles">D - F&nbsp</a>
        <a href="../legislationg-i.html" class="btnnewfiles">G - I&nbsp</a><br><br><br><br><br>
        <a href="../legislationj-l.html" class="btnnewfiles">J - L&nbsp</a>
        <a href="../legislationm-o.html" class="btnnewfiles">M - O</a>
        <a href="../legislationp-r.html" class="btnnewfiles">P - R</a><br><br><br><br><br>
        <a href="../legislations-u.html" class="btnnewfiles">S - U</a>
        <a href="../legislationv-x.html" class="btnnewfiles">V - X&nbsp</a>
        <a href="#" class="btnnewfiles1" disabled>Y - Z&nbsp</a>
    </div>
    <img src="../Documents/hex.png" class="hexagonlegislation" alt="Outline of three hexagons">

    <style>
        .searchheadings {
            color: white;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            font-size: x-large;
            position: relative;
            left: 346px;
            top: 45px
        }


        /*labels for form*/


        .button-container {
            width: 800px;
            height: 400px;
            background: black;
            overflow-y: auto;
            margin-left: 440px;
            margin-top: 10px;
        }

        .button-container>a {
            width: 170px;
            height: 60px;

            background-color: black;
            color: white;
            font-weight: bold;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            border: 2px solid white;
            margin: 15px;
        }


        .btnnewfiles {
            background-color: black;
            color: white;
            font-weight: bold;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            border: 2px solid white;
            cursor: pointer;

        }



        /*back button hover*/
        .btnnewfiles:hover {
            background-color: white;
            color: black;
            border: solid 2px black;
            background: #fff;
            color: #1f1f1f !important;
        }

        a.btnnewfiles:link,
        a.btnnewfiles:visited,
        a.btnnewfiles:hover,
        a.btnnewfiles:active {
            color: white;
            text-decoration: none;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            font-size: large;
            padding: 18px 38px;
            border: none;
            border-radius: 4px;
            border: 2px solid white;
            cursor: pointer;
            position: relative;
            top: 100px
        }

        a.btnnewfiles1:link,
        a.btnnewfiles1:visited,
        a.btnnewfiles1:hover,
        a.btnnewfiles1:active {
            color: gray;
            text-decoration: none;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            font-size: large;
            padding: 18px 38px;
            border: none;
            border-radius: 4px;
            border: 2px solid grey;
            cursor: default;
            position: relative;
            top: 100px
        }
    </style>
</body>

</html>