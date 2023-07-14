<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>Correspondence</title>
</head>
<div id="test">
    <navi>
        <div class="heading1">
            <h4>AutoLegal
                <label1 for="file">Progress:
                    <progress id="file" value="45" max="90"></progress>
                </label1>
            </h4>
        </div>
        <ul class="nav-linker">
        </ul>
    </navi><br><br>
</div>
</head>

<body style="background-color: black">
    <style type="text/css">
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

        .dropdownhc {
            margin-left: 124px;
            width: 298px;
            height: 26px;
            position: absolute;
            top: 104px;
            font-family: "Montserrat", sans-serif;
            font-weight: bolder;

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
            position: absolute;

        }

        .d-none1 {
            display: block;

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

        .fieldlable {
            color: white;
            font-family: "Montserrat", sans-serif;
            font-weight: bold;
            position: absolute;
            margin-top: 20px;
            left: 500px;
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
            width: 291px;
            height: 22px;
            position: absolute;
            top: 104px
        }

        .field2input {
            margin-left: 330px;
            width: 250px;
            height: 20px;
            position: absolute;
            top: 104px
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
        <form action="../frontend2/messaround5.php" method="post">
            <p class="p3">How many Plaintiffs are there?</p>
            <select id="courts" class="p1" onchange="enablecourts(this)" name="courts">
                <option value="0">Please select</option>
                <option value="1">Magistrate's Court</option>
                <option value="2">Regional Court</option>
                <option value="3">High Court</option>
            </select>

    </div>
    <div class="test">

    </div>

    <div class="test">
        <div id="selection" class="d-none1">
            <div class="col-55">
                <label class="d-none1" for="selection">Awaiting Selection:</label>
            </div>
            <div class="col-85">
                <input type="text" class="col-85" id="input2" name="selection" disabled>
            </div>
        </div>
    </div>

    <div class="test">
        <div id="mc" class="d-none">
            <div class="col-55">
                <label for="mc">For the District of:</label>
            </div>
            <div class="col-85">
                <input type="text" class="col-85" id="input2" name="mc" value="" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="test">
        <div id="mcone" class="d-none">
            <div class="fieldlable">
                <label for="mcone">Held At:</label>
            </div>
            <div class="field2input">
                <input type="text" class="field2input" id="input2" name="mcone" value="" autocomplete="off">
            </div>
        </div>
    </div>


    <div class="test">
        <div id="rc" class="d-none">
            <div class="col-55">
                <label for="rc">For the Regional Division of:</label>
            </div>
            <div class="col-85">
                <input type="text" class="col-85" id="input2" name="rc" value="" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="test">
        <div id="hc" class="d-none">
            <div class="col-55">
                <label for="hc">Which Division:</label>
            </div>
            <div class="col-85">
                <select id="highcourts" class="dropdownhc">
                    <option value="(WESTERN CAPE DIVISION, CAPE TOWN)">WESTERN CAPE DIVISION, CAPE TOWN</option>
                    <option value="(EASTERN CAPE DIVISION, GRAHAMSTOWN)">EASTERN CAPE DIVISION, GRAHAMSTOWN</option>
                    <option value="(EASTERN CAPE LOCAL DIVISION, BHISHO)">EASTERN CAPE LOCAL DIVISION, BHISHO</option>
                    <option value="(EASTERN CAPE LOCAL DIVISION, MTHATHA)">EASTERN CAPE LOCAL DIVISION, MTHATHA</option>
                    <option value="(EASTERN CAPE LOCAL DIVISION, PORT ELIZABETH)">EASTERN CAPE LOCAL DIVISION, PORT ELIZABETH</option>
                    <option value="(FREE STATE DIVISION, BLOEMFONTEIN)">FREE STATE DIVISION, BLOEMFONTEIN</option>
                    <option value="(GAUTENG DIVISION, PRETORIA)">GAUTENG DIVISION, PRETORIA</option>
                    <option value="(GAUTENG LOCAL DIVISION, JOHANNESBURG)">GAUTENG LOCAL DIVISION, JOHANNESBURG</option>
                    <option value="(KWAZULU-NATAL DIVISION, PIETERMARITZBURG)">KWAZULU-NATAL DIVISION, PIETERMARITZBURG</option>
                    <option value="(KWAZULU-NATAL LOCAL DIVISION, DURBAN)">KWAZULU-NATAL LOCAL DIVISION, DURBAN</option>
                    <option value="(NORTHERN CAPE DIVISION, KIMBERLEY)">NORTHERN CAPE DIVISION, KIMBERLEY</option>
                    <option value="(NORTH WEST DIVISION, MAHIKENG)">NORTH WEST DIVISION, MAHIKENG</option>
                </select>
            </div>
        </div>
    </div>
    <input type="submit">
    </form>
    </div>
    <script type="text/javascript">
        function enablecourts(answer) {
            console.log(answer.value);
            if (answer.value == "0") {

                document.getElementById("selection").classList.add('d-none');
                document.getElementById("mc").classList.add('d-none');
                document.getElementById("rc").classList.add('d-none');
                document.getElementById("hc").classList.add('d-none');
                document.getElementById("highcourts").classList.add('d-none');

            }
            if (answer.value == "1") {
                document.getElementById("selection").classList.remove('d-none1');
                document.getElementById("selection").classList.add('d-none');
                document.getElementById("mc").classList.remove('d-none');
                document.getElementById("mcone").classList.remove('d-none');
                document.getElementById("rc").classList.add('d-none');
                document.getElementById("hc").classList.add('d-none');
                document.getElementById("highcourts").classList.add('d-none');
            }
            if (answer.value == "2") {
                document.getElementById("selection").classList.remove('d-none1');
                document.getElementById("selection").classList.add('d-none');
                document.getElementById("mc").classList.add('d-none');
                document.getElementById("rc").classList.remove('d-none');
                document.getElementById("mcone").classList.remove('d-none');
                document.getElementById("hc").classList.add('d-none');
                document.getElementById("highcourts").classList.add('d-none');

            }
            if (answer.value == "3") {
                document.getElementById("selection").classList.remove('d-none1');
                document.getElementById("selection").classList.add('d-none');
                document.getElementById("mc").classList.add('d-none');
                document.getElementById("mcone").classList.add('d-none');
                document.getElementById("rc").classList.add('d-none');
                document.getElementById("hc").classList.remove('d-none');
                document.getElementById("highcourts").classList.remove('d-none');

            }

        };
    </script>


    <style>
        .container {
            height: 128px;
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