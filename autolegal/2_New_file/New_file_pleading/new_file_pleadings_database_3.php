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
    <link rel="stylesheet" href="">
    <title>Generate Pleading Database</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../12_Icons/favicon.ico">
</head>
<div id="test">
    <navi>
        <div class="heading1">
            <h4>AutoLegal</h4>
        </div>
        <div class="heading1">
            <label1 id="fileprogress" for="file">Progress:</label1>
            <progress id="file" value="45" max="90"></progress>

            <body style="background-color: black">


        </div>
        <ul class="nav-linker">
        </ul>
    </navi><br><br>
</div>
</head>

<?php
//print_r($_POST);
require "../../10_Database/database.php";
$savelocation = $_POST['saveLocation'];
$path = $_POST['path1'];

//if the user fails to make a selection.
if ($savelocation == "prompt") {
    $_SESSION['number'] = "";
}
if ($savelocation == "folder") {
    $_SESSION['number'] = $_POST['path1'];
}

?>

<body style="background-color: black">
    <style type="text/css">
        #fileprogress {
            position: relative;
            left: 443px;
            top: 11px;
        }

        #file {
            position: relative;
            left: 760px;
            top: -13px;
        }

        .test {
            width: 50%;
            float: left;
        }

        .test2 {
            width: 50%;
            float: right;
        }

        navi {
            display: flex;
            justify-content: space-around;
            align-items: center;
            min-height: 10vh;
            background-color: white;
            font-family: "Montserrat", sans-serif;

            position: absolute;


            min-height: 10vh;
            background-color: white;
            font-family: "Montserrat", sans-serif;
            margin: -9px;
            width: 1365px;
        }

        /*headings in navigation bar for white/black background*/
        .nav-linker {
            display: flex;
            justify-content: space-around;
            width: 50%;

        }

        .nav-linker li {
            list-style: none;
        }

        /*heading for newfile.html - white/black screen*/
        .heading1 {
            color: black;
            text-transform: uppercase;
            letter-spacing: 5px;
            font-size: 20px;
            margin-left: 50px;
        }

        .heading2 {
            color: black;
            text-transform: uppercase;
            letter-spacing: 5px;
            font-size: 10px;

        }

        .d-none {
            display: none;

        }

        p {
            color: white;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);

        }

        .col-55 {
            color: white;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            position: absolute;
            margin-top: 20px;
            left: -30px;
            padding: 6px 65px;


        }

        .col-5 {
            color: white;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            position: absolute;
            margin-top: -15px;
            left: 570px;
            padding: 6px 65px;


        }

        .col-85 {
            margin-left: 124px;
            width: 250px;
            height: 20px;
            position: relative;
            top: 11px;
            text-transform: uppercase;
        }

        label {
            padding: 0;
            display: inline-block;

        }

        label1 {
            padding: 0;
            display: inline-block;
            margin-left: 245px;
        }

        .col-95 {
            left: 431px;
            width: 250px;
            height: 20px;
            margin-top: 2px;
            position: absolute;
            text-transform: uppercase;

        }

        .p1 {
            color: white;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            margin-top: 100px;
            margin-left: 250px;
            position: absolute;

            padding: 6px 65px;
            font-size: 100%;
            cursor: pointer;
            border-radius: 0;
            background-color: black;
            border: none;
            border: 2px solid white;
            border-radius: 4px;
        }

        .p2 {
            color: white;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            margin: 0;
            margin-top: 100px;
            margin-left: 855px;
            position: absolute;
            padding: 6px 65px;
            font-size: 100%;
            cursor: pointer;
            border-radius: 0;
            background-color: black;
            border: none;
            border: 2px solid white;
            border-radius: 4px;

        }

        .p3 {
            color: white;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            margin: 0;
            position: absolute;
            top: 47%;
            left: 28%;
        }

        .p4 {
            color: white;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            margin: 0;
            position: absolute;
            top: 47%;
            left: 73%;
        }

        .select-block {
            width: 300px;
            margin: 110px auto 30px;

        }


        /* For IE <= 11 */
        select::-ms-expand {
            display: none;
        }

        select:hover,
        select:focus {
            color: black;
            background-color: white;
            border: 2px solid black;
        }

        .nav-link {
            color: black;
            text-decoration: none;
            letter-spacing: 3px;
            font-weight: bold;
            font-size: 14px;
            padding: 14px 16px;

        }

        .nav-linker {
            display: flex;
            justify-content: space-around;
            width: 50%;

        }

        .nav-linker li {
            list-style: none;
        }


        .nav-linker li a.active {
            border: 2px solid black;
            border-radius: 4px;
            padding: 17px 14px;
            padding: 14px 16px;
            color: black;
        }

        progress {
            color: white;
            background-color: black;
            background: purple;
            border: black;
            margin-left: 100px;
        }

        progress::-webkit-progress-bar {
            background: white;
            border: black;
            border: 2px solid black;

        }

        progress::-webkit-progress-value {
            background: black;
            border: black;
            border: 2px solid black;

        }
    </style><br>
    <div class="container">
        <form action="../New_file_pleading/new_file_pleadings_database_4.php" method="post">
            <p class="p3">How many Plaintiffs are there?</p>
            <select id="plaintiffs" class="p1" onchange="enableplaintiffs(this)" name="plaintiffs" required>
                <option value="">Please select</option>
                <option value="1P">1 Plaintiff</option>
                <option value="2P">2 Plaintiffs</option>
                <option value="3P">3 Plaintiffs</option>
                <option value="4P">4 Plaintiffs</option>
                <option value="5P">5 Plaintiffs</option>
                <option value="6P">6 Plaintiffs</option>
            </select>
            <p class="p4">How many Defendants are there?</p>
            <select id="defendants" class="p2" onchange="enabledefendants(this)" name="defendants" required>
                <option value="">Please select</option>
                <option value="1D">1 Defendant</option>
                <option value="2D">2 Defendants</option>
                <option value="3D">3 Defendants</option>
                <option value="4D">4 Defendants</option>
                <option value="5D">5 Defendants</option>
                <option value="6D">6 Defendants</option>
            </select>
    </div>
    </div>
    <div class="test">
        <div id="oneplaintiff" class="d-none">
            <div class="col-55">
                <label for="onepname">Plaintiff's name:</label>
            </div>
            <div class="col-85">
                <input type="text" class="col-85" id="input2" name="onepname" value="" required autocomplete="off">
            </div>
        </div>
    </div><br>
    <div class="test2">
        <div id="onedefendant" class="d-none">
            <div class="col-5">
                <label for="onedname"><br>Defendant's name:</label>
            </div>
            <div class="col-95">
                <input type="text" class="col-95" id="input2" name="onedname" value="" required autocomplete="off">
            </div>
        </div>
    </div><br>
    <div class="test">
        <div id="twoplaintiffs" class="d-none">
            <div class="col-55">
                <label for="twopname">Second Plaintiff's name:</label>
            </div>
            <div class="col-85">
                <input type="text" class="col-85" id="input2" name="twopname" value="" autocomplete="off">
            </div>
        </div>
    </div><br>
    <div class="test2">
        <div id="twodefendants" class="d-none">
            <div class="col-5">
                <label for="twodname"><br>Second Defendant's name:</label>
            </div>
            <div class="col-95">
                <input type="text" class="col-95" id="input2" name="twodname" value="" autocomplete="off">
            </div>
        </div>
    </div><br>
    <div class="test">
        <div id="threeplaintiffs" class="d-none">
            <div class="col-55">
                <label for="threedname">Third Plaintiff's name:</label>
            </div>
            <div class="col-85">
                <input type="text" class="col-85" id="input2" name="threepname" value="" autocomplete="off">
            </div>
        </div>
    </div><br>
    <div class="test2">
        <div id="threedefendants" class="d-none">
            <div class="col-5">
                <label for="threedname"><br>Third Defendant's name:</label>
            </div>
            <div class="col-95">
                <input type="text" class="col-95" id="input2" name="threedname" value="" autocomplete="off">
            </div>
        </div>
    </div><br>
    <div class="test">
        <div id="fourplaintiffs" class="d-none">
            <div class="col-55">
                <label for="fourdname">Fourth Plaintiff's name:</label>
            </div>
            <div class="col-85">
                <input type="text" class="col-85" id="input2" name="fourpname" value="" autocomplete="off">
            </div>
        </div>
    </div><br>
    <div class="test2">
        <div id="fourdefendants" class="d-none">
            <div class="col-5">
                <label for="fourdname"><br>Fourth Defendant's name:</label>
            </div>
            <div class="col-95">
                <input type="text" class="col-95" id="input2" name="fourdname" value="" autocomplete="off">
            </div>
        </div>
    </div><br>
    <div class="test">
        <div id="fiveplaintiffs" class="d-none">
            <div class="col-55">
                <label for="fivedname">Fifth Plaintiff's name:</label>
            </div>
            <div class="col-85">
                <input type="text" class="col-85" id="input2" name="fivepname" value="" autocomplete="off">
            </div>
        </div>
    </div><br>
    <div class="test2">
        <div id="fivedefendants" class="d-none">
            <div class="col-5">
                <label for="fivedname"><br>Fifth Defendant's name:</label>
            </div>
            <div class="col-95">
                <input type="text" class="col-95" id="input2" name="fivedname" value="" autocomplete="off">
            </div>
        </div>
    </div><br>
    <div class="test">
        <div id="sixplaintiffs" class="d-none">
            <div class="col-55">
                <label for="sixdname">Sixth Plaintiff's name:</label>
            </div>
            <div class="col-85">
                <input type="text" class="col-85" id="input2" name="sixpname" value="" autocomplete="off">
            </div>
        </div>
    </div><br>
    <div class="test2">
        <div id="sixdefendants" class="d-none">
            <div class="col-5">
                <label for="sixdname"><br>Sixth Defendant's name:</label>
            </div>
            <div class="col-95">
                <input type="text" class="col-95" id="input2" name="sixdname" value="" autocomplete="off">
            </div>
        </div>
    </div><br>
    <div class="container">
        <div class="center">

            <input type="submit" class="input20" value="Next &nbsp❯" name="register" tabindex="3" />
        </div>
    </div>
    <script type="text/javascript">
        function enableplaintiffs(answer) {
            console.log(answer.value);
            if (answer.value == "") {
                document.getElementById("oneplaintiff").classList.add('d-none');
                document.getElementById("twoplaintiffs").classList.add('d-none');
                document.getElementById("threeplaintiffs").classList.add('d-none');
                document.getElementById("fourplaintiffs").classList.add('d-none');
                document.getElementById("fiveplaintiffs").classList.add('d-none');
                document.getElementById("sixplaintiffs").classList.add('d-none');
            }
            if (answer.value == "1P") {
                document.getElementById("oneplaintiff").classList.remove('d-none');
                document.getElementById("twoplaintiffs").classList.add('d-none');
                document.getElementById("threeplaintiffs").classList.add('d-none');
                document.getElementById("fourplaintiffs").classList.add('d-none');
                document.getElementById("fiveplaintiffs").classList.add('d-none');
                document.getElementById("sixplaintiffs").classList.add('d-none');
            }
            if (answer.value == "2P") {
                document.getElementById("oneplaintiff").classList.remove('d-none');
                document.getElementById("twoplaintiffs").classList.remove('d-none');
                document.getElementById("threeplaintiffs").classList.add('d-none');
                document.getElementById("fourplaintiffs").classList.add('d-none');
                document.getElementById("fiveplaintiffs").classList.add('d-none');
                document.getElementById("sixplaintiffs").classList.add('d-none');
            }
            if (answer.value == "3P") {
                document.getElementById("oneplaintiff").classList.remove('d-none');
                document.getElementById("twoplaintiffs").classList.remove('d-none');
                document.getElementById("threeplaintiffs").classList.remove('d-none');
                document.getElementById("fourplaintiffs").classList.add('d-none');
                document.getElementById("fiveplaintiffs").classList.add('d-none');
                document.getElementById("sixplaintiffs").classList.add('d-none');
            }
            if (answer.value == "4P") {
                document.getElementById("oneplaintiff").classList.remove('d-none');
                document.getElementById("twoplaintiffs").classList.remove('d-none');
                document.getElementById("threeplaintiffs").classList.remove('d-none');
                document.getElementById("fourplaintiffs").classList.remove('d-none');
                document.getElementById("fiveplaintiffs").classList.add('d-none');
                document.getElementById("sixplaintiffs").classList.add('d-none');
            }
            if (answer.value == "5P") {
                document.getElementById("oneplaintiff").classList.remove('d-none');
                document.getElementById("twoplaintiffs").classList.remove('d-none');
                document.getElementById("threeplaintiffs").classList.remove('d-none');
                document.getElementById("fourplaintiffs").classList.remove('d-none');
                document.getElementById("fiveplaintiffs").classList.remove('d-none');
                document.getElementById("sixplaintiffs").classList.add('d-none');
            }
            if (answer.value == "6P") {
                document.getElementById("oneplaintiff").classList.remove('d-none');
                document.getElementById("twoplaintiffs").classList.remove('d-none');
                document.getElementById("threeplaintiffs").classList.remove('d-none');
                document.getElementById("fourplaintiffs").classList.remove('d-none');
                document.getElementById("fiveplaintiffs").classList.remove('d-none');
                document.getElementById("sixplaintiffs").classList.remove('d-none');
            }

        };
    </script>
    <script type="text/javascript">
        function enabledefendants(answer) {
            console.log(answer.value);
            if (answer.value == "") {
                document.getElementById("onedefendant").classList.add('d-none');
                document.getElementById("twodefendants").classList.add('d-none');
                document.getElementById("threedefendants").classList.add('d-none');
                document.getElementById("fourdefendants").classList.add('d-none');
                document.getElementById("fivedefendants").classList.add('d-none');
                document.getElementById("sixdefendants").classList.add('d-none');
            }
            if (answer.value == "1D") {
                document.getElementById("onedefendant").classList.remove('d-none');
                document.getElementById("twodefendants").classList.add('d-none');
                document.getElementById("threedefendants").classList.add('d-none');
                document.getElementById("fourdefendants").classList.add('d-none');
                document.getElementById("fivedefendants").classList.add('d-none');
                document.getElementById("sixdefendants").classList.add('d-none');
            }
            if (answer.value == "2D") {
                document.getElementById("onedefendant").classList.remove('d-none');
                document.getElementById("twodefendants").classList.remove('d-none');
                document.getElementById("threedefendants").classList.add('d-none');
                document.getElementById("fourdefendants").classList.add('d-none');
                document.getElementById("fivedefendants").classList.add('d-none');
                document.getElementById("sixdefendants").classList.add('d-none');
            }
            if (answer.value == "3D") {
                document.getElementById("onedefendant").classList.remove('d-none');
                document.getElementById("twodefendants").classList.remove('d-none');
                document.getElementById("threedefendants").classList.remove('d-none');
                document.getElementById("fourdefendants").classList.add('d-none');
                document.getElementById("fivedefendants").classList.add('d-none');
                document.getElementById("sixdefendants").classList.add('d-none');
            }
            if (answer.value == "4D") {
                document.getElementById("onedefendant").classList.remove('d-none');
                document.getElementById("twodefendants").classList.remove('d-none');
                document.getElementById("threedefendants").classList.remove('d-none');
                document.getElementById("fourdefendants").classList.remove('d-none');
                document.getElementById("fivedefendants").classList.add('d-none');
                document.getElementById("sixdefendants").classList.add('d-none');
            }
            if (answer.value == "5D") {
                document.getElementById("onedefendant").classList.remove('d-none');
                document.getElementById("twodefendants").classList.remove('d-none');
                document.getElementById("threedefendants").classList.remove('d-none');
                document.getElementById("fourdefendants").classList.remove('d-none');
                document.getElementById("fivedefendants").classList.remove('d-none');
                document.getElementById("sixdefendants").classList.add('d-none');
            }
            if (answer.value == "6D") {
                document.getElementById("onedefendant").classList.remove('d-none');
                document.getElementById("twodefendants").classList.remove('d-none');
                document.getElementById("threedefendants").classList.remove('d-none');
                document.getElementById("fourdefendants").classList.remove('d-none');
                document.getElementById("fivedefendants").classList.remove('d-none');
                document.getElementById("sixdefendants").classList.remove('d-none');
            }
        };
    </script>

    <style>
        .container {
            height: 123px;
            position: relative;

        }

        .center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .input20[type=submit] {
            background-color: black;
            color: white;
            font-weight: bold;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            border: 2px solid white;
            cursor: pointer;

        }

        .input20[type=submit]:hover {
            background-color: white;
            color: black;
            border: solid 2px black;
            background: #fff;
            color: #1f1f1f !important;
        }

        .input21[type=reset] {
            background-color: black;
            color: white;
            font-weight: bold;
            padding: 13px 23px;
            border: none;
            border-radius: 4px;
            border: 2px solid white;
            cursor: pointer;

        }

        .input21[type=reset]:hover {
            background-color: white;
            color: black;
            border: solid 2px black;
            background: #fff;
            color: #1f1f1f !important;
        }

        .btn10 {
            background-color: black;
            color: white;
            font-weight: bold;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            border: 2px solid white;
            cursor: pointer;
            position: relative;
            left: 555px;
            bottom: 13px
        }

        /*back button hover*/
        .btn10:hover {
            background-color: white;
            color: black;
            border: solid 2px black;
            background: #fff;
            color: #1f1f1f !important;
        }

        a.btn10:link,
        a.btn10:visited,
        a.btn10:hover,
        a.btn10:active {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: medium;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            border: 2px solid white;
            cursor: pointer;
            position: relative;
            left: 537px;
            top: -5px;
            width: 25mm;
        }
    </style>
    </div>

</body>

</html>
<?php if (isset($error)) {
    echo $error;
} ?>
<?php if (isset($msg)) {
    echo $msg;
} ?>