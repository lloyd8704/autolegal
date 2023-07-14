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
            <progress id="file" value="60" max="90"></progress>

            <body style="background-color: black">


        </div>
        <ul class="nav-linker">

        </ul>
    </navi><br><br>
    </head>

    <body style="background-color: black">

        <body>
            <style type="text/css">
                #fileprogress {
                    position: relative;
                    left: 420px;
                    top: 11px;
                }

                #file {
                    position: relative;
                    left: 750px;
                    top: -13px;
                }

                .d-none {
                    display: none;
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
                    width: 100%;
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
                    margin-top: 0%;
                    left: -30px;
                    padding: 6px 65px;


                }

                .col-opponents {
                    color: white;
                    font-family: "Montserrat", sans-serif;
                    font-weight: bold;
                    position: absolute;
                    margin-top: 40px;
                    margin-left: 300px;
                    padding: 6px 65px;


                }

                textarea {
                    color: black;
                    font-family: "Montserrat", sans-serif;
                    font-weight: bolder;
                }

                .col-85 {
                    margin-left: 530px;
                    resize: vertical;
                    overflow: auto;

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
                    margin-left: 90px;
                    width: 250px;
                    height: 20px;
                    margin-top: -15px;


                }

                .p1 {
                    color: white;
                    font-family: "Montserrat", sans-serif;
                    font-weight: bold;
                    margin-top: 100px;
                    margin-left: 560px;
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

                    position: absolute;
                    margin-left: 14px;
                    margin-top: -200px;
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

                .container {
                    height: 150px;
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
                    margin-top: 0px;
                    margin-top: 38px;
                    margin-left: 630px;
                }

                .input20[type=submit]:hover {
                    background-color: white;
                    color: black;
                    border: solid 2px black;
                    background: #fff;
                    color: #1f1f1f !important;

                }

                .input20[type=reset] {
                    background-color: black;
                    color: white;
                    font-weight: bold;
                    padding: 13px 28px;
                    border: none;
                    border-radius: 4px;
                    border: 2px solid white;
                    cursor: pointer;
                }

                .input20[type=reset]:hover {
                    background-color: white;
                    color: black;
                    border: solid 2px black;
                    background: #fff;
                    color: #1f1f1f !important;
                }

                progress {
                    color: white;
                    background-color: black;
                    margin-left: 95px;
                    border: black;
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
            </style>

            <p class="p3"><br><br>How many opponent attorneys are there?</p><br>
            <br><br>
            <div class="container">
                <form action="../New_file_pleading/new_file_pleadings_database_6.php" method="post">

                    <select id="opponents" class="p1" onchange="enableopponents(this)" name="attorneys">
                        <option value="0O">Please select</option>
                        <option value="1O">1 Opponent</option>
                        <option value="2O">2 Opponents</option>
                        <option value="3O">3 Opponents</option>
                        <option value="4O">4 Opponents</option>
                        <option value="5O">5 Opponents</option>
                        <option value="6O">6 Opponents</option>
                        <option value="7O">7 Opponents</option>
                        <option value="8O">8 Opponents</option>
                        <option value="9O">9 Opponents</option>
                        <option value="10O">10 Opponents</option>
                        <option value="11O">11 Opponents</option>

                    </select>
            </div>
            <div id="oneopponent" class="d-none"><br>
                <div class="col-opponents">
                    <label for="attorneyone">First Attorney:</label>
                </div>
                <textarea id="attorneyone" class="col-85" id="input2" name="attorneyone" rows="8" cols="40" value="" required></textarea>
            </div>
</div>

<div id="twoopponents" class="d-none"><br>
    <div class="col-opponents">
        <label for="attorneytwo">Second Attorney:</label>
    </div>
    <textarea id="attorneyone" class="col-85" id="input2" name="attorneytwo" rows="8" cols="40" value=""></textarea>
</div>
</div>

<div id="threeopponents" class="d-none"><br>
    <div class="col-opponents">
        <label for="attorneythree">Third Attorney:</label>
    </div>
    <textarea id="attorneyone" class="col-85" id="input2" name="attorneythre" rows="8" cols="40" value=""></textarea>
</div>
</div>

<div id="fouropponents" class="d-none"><br>
    <div class="col-opponents">
        <label for="attorneyfour">Fourth Attorney:</label>
    </div>
    <textarea id="attorneyone" class="col-85" id="input2" name="attorneyfour" rows="8" cols="40" value=""></textarea>
</div>
</div>

<div id="fiveopponents" class="d-none"><br>
    <div class="col-opponents">
        <label for="attorneyfive">Fifth Attorney:</label>
    </div>
    <textarea id="attorneyone" class="col-85" id="input2" name="attorneyfive" rows="8" cols="40" value=""></textarea>
</div>
</div>

<div id="sixopponents" class="d-none"><br>
    <div class="col-opponents">
        <label for="attorneysix">Sixth Attorney:</label>
    </div>
    <textarea id="attorneyone" class="col-85" id="input2" name="attorneysix" rows="8" cols="40" value=""></textarea>
</div>
</div>

<div id="sevenopponents" class="d-none"><br>
    <div class="col-opponents">
        <label for="attorneyseven">Seventh Attorney:</label>
    </div>
    <textarea id="attorneyone" class="col-85" id="input2" name="attorneyseven" rows="8" cols="40" value=""></textarea>
</div>
</div>

<div id="eightopponents" class="d-none"><br>
    <div class="col-opponents">
        <label for="attorneyeight">Eighth Attorney:</label>
    </div>
    <textarea id="attorneyone" class="col-85" id="input2" name="attorneyeight" rows="8" cols="40" value=""></textarea>
</div>
</div>

<div id="nineopponents" class="d-none"><br>
    <div class="col-opponents">
        <label for="attorneynine">Ninth Attorney:</label>
    </div>
    <textarea id="attorneyone" class="col-85" id="input2" name="attorneynine" rows="8" cols="40" value=""></textarea>
</div>
</div>

<div id="tenopponents" class="d-none"><br>
    <div class="col-opponents">
        <label for="attorneyten">Tenth Attorney:</label>
    </div>
    <textarea id="attorneyone" class="col-85" id="input2" name="attorneyten" rows="8" cols="40" value=""></textarea>
</div>
</div>

<div id="elevenopponents" class="d-none"><br>
    <div class="col-opponents">
        <label for="attorneyeleven">Eleventh Attorney:</label>
    </div>
    <textarea id="attorneyone" class="col-85" id="input2" name="attorneyeleven" rows="8" cols="40" value=""></textarea>
</div>
</div>

<script type="text/javascript">
    function enableopponents(answer) {
        console.log(answer.value);
        if (answer.value == "0O") {
            document.getElementById("oneopponent").classList.add('d-none');
            document.getElementById("twoopponents").classList.add('d-none');
            document.getElementById("threeopponents").classList.add('d-none');
            document.getElementById("fouropponents").classList.add('d-none');
            document.getElementById("fiveopponents").classList.add('d-none');
            document.getElementById("sixopponents").classList.add('d-none');
            document.getElementById("sevenopponents").classList.add('d-none');
            document.getElementById("eightopponents").classList.add('d-none');
            document.getElementById("nineopponents").classList.add('d-none');
            document.getElementById("tenopponents").classList.add('d-none');
            document.getElementById("elevenopponents").classList.add('d-none');
        }
        if (answer.value == "1O") {
            document.getElementById("oneopponent").classList.remove('d-none');
            document.getElementById("twoopponents").classList.add('d-none');
            document.getElementById("threeopponents").classList.add('d-none');
            document.getElementById("fouropponents").classList.add('d-none');
            document.getElementById("fiveopponents").classList.add('d-none');
            document.getElementById("sixopponents").classList.add('d-none');
            document.getElementById("sevenopponents").classList.add('d-none');
            document.getElementById("eightopponents").classList.add('d-none');
            document.getElementById("nineopponents").classList.add('d-none');
            document.getElementById("tenopponents").classList.add('d-none');
            document.getElementById("elevenopponents").classList.add('d-none');
        }
        if (answer.value == "2O") {
            document.getElementById("oneopponent").classList.remove('d-none');
            document.getElementById("twoopponents").classList.remove('d-none');
            document.getElementById("threeopponents").classList.add('d-none');
            document.getElementById("fouropponents").classList.add('d-none');
            document.getElementById("fiveopponents").classList.add('d-none');
            document.getElementById("sixopponents").classList.add('d-none');
            document.getElementById("sevenopponents").classList.add('d-none');
            document.getElementById("eightopponents").classList.add('d-none');
            document.getElementById("nineopponents").classList.add('d-none');
            document.getElementById("tenopponents").classList.add('d-none');
            document.getElementById("elevenopponents").classList.add('d-none');
        }
        if (answer.value == "3O") {
            document.getElementById("oneopponent").classList.remove('d-none');
            document.getElementById("twoopponents").classList.remove('d-none');
            document.getElementById("threeopponents").classList.remove('d-none');
            document.getElementById("fouropponents").classList.add('d-none');
            document.getElementById("fiveopponents").classList.add('d-none');
            document.getElementById("sixopponents").classList.add('d-none');
            document.getElementById("sevenopponents").classList.add('d-none');
            document.getElementById("eightopponents").classList.add('d-none');
            document.getElementById("nineopponents").classList.add('d-none');
            document.getElementById("tenopponents").classList.add('d-none');
            document.getElementById("elevenopponents").classList.add('d-none');
        }
        if (answer.value == "4O") {
            document.getElementById("oneopponent").classList.remove('d-none');
            document.getElementById("twoopponents").classList.remove('d-none');
            document.getElementById("threeopponents").classList.remove('d-none');
            document.getElementById("fouropponents").classList.remove('d-none');
            document.getElementById("fiveopponents").classList.add('d-none');
            document.getElementById("sixopponents").classList.add('d-none');
            document.getElementById("sevenopponents").classList.add('d-none');
            document.getElementById("eightopponents").classList.add('d-none');
            document.getElementById("nineopponents").classList.add('d-none');
            document.getElementById("tenopponents").classList.add('d-none');
            document.getElementById("elevenopponents").classList.add('d-none');
        }
        if (answer.value == "5O") {
            document.getElementById("oneopponent").classList.remove('d-none');
            document.getElementById("twoopponents").classList.remove('d-none');
            document.getElementById("threeopponents").classList.remove('d-none');
            document.getElementById("fouropponents").classList.remove('d-none');
            document.getElementById("fiveopponents").classList.remove('d-none');
            document.getElementById("sixopponents").classList.add('d-none');
            document.getElementById("sevenopponents").classList.add('d-none');
            document.getElementById("eightopponents").classList.add('d-none');
            document.getElementById("nineopponents").classList.add('d-none');
            document.getElementById("tenopponents").classList.add('d-none');
            document.getElementById("elevenopponents").classList.add('d-none');
        }
        if (answer.value == "6O") {
            document.getElementById("oneopponent").classList.remove('d-none');
            document.getElementById("twoopponents").classList.remove('d-none');
            document.getElementById("threeopponents").classList.remove('d-none');
            document.getElementById("fouropponents").classList.remove('d-none');
            document.getElementById("fiveopponents").classList.remove('d-none');
            document.getElementById("sixopponents").classList.remove('d-none');
            document.getElementById("sevenopponents").classList.add('d-none');
            document.getElementById("eightopponents").classList.add('d-none');
            document.getElementById("nineopponents").classList.add('d-none');
            document.getElementById("tenopponents").classList.add('d-none');
            document.getElementById("elevenopponents").classList.add('d-none');;
        }
        if (answer.value == "7O") {
            document.getElementById("oneopponent").classList.remove('d-none');
            document.getElementById("twoopponents").classList.remove('d-none');
            document.getElementById("threeopponents").classList.remove('d-none');
            document.getElementById("fouropponents").classList.remove('d-none');
            document.getElementById("fiveopponents").classList.remove('d-none');
            document.getElementById("sixopponents").classList.remove('d-none');
            document.getElementById("sevenopponents").classList.remove('d-none');
            document.getElementById("eightopponents").classList.add('d-none');
            document.getElementById("nineopponents").classList.add('d-none');
            document.getElementById("tenopponents").classList.add('d-none');
            document.getElementById("elevenopponents").classList.add('d-none');;
        }
        if (answer.value == "8O") {
            document.getElementById("oneopponent").classList.remove('d-none');
            document.getElementById("twoopponents").classList.remove('d-none');
            document.getElementById("threeopponents").classList.remove('d-none');
            document.getElementById("fouropponents").classList.remove('d-none');
            document.getElementById("fiveopponents").classList.remove('d-none');
            document.getElementById("sixopponents").classList.remove('d-none');
            document.getElementById("sevenopponents").classList.remove('d-none');
            document.getElementById("eightopponents").classList.remove('d-none');
            document.getElementById("nineopponents").classList.add('d-none');
            document.getElementById("tenopponents").classList.add('d-none');
            document.getElementById("elevenopponents").classList.add('d-none');;
        }
        if (answer.value == "9O") {
            document.getElementById("oneopponent").classList.remove('d-none');
            document.getElementById("twoopponents").classList.remove('d-none');
            document.getElementById("threeopponents").classList.remove('d-none');
            document.getElementById("fouropponents").classList.remove('d-none');
            document.getElementById("fiveopponents").classList.remove('d-none');
            document.getElementById("sixopponents").classList.remove('d-none');
            document.getElementById("sevenopponents").classList.remove('d-none');
            document.getElementById("eightopponents").classList.remove('d-none');
            document.getElementById("nineopponents").classList.remove('d-none');
            document.getElementById("tenopponents").classList.add('d-none');
            document.getElementById("elevenopponents").classList.add('d-none');;
        }
        if (answer.value == "10O") {
            document.getElementById("oneopponent").classList.remove('d-none');
            document.getElementById("twoopponents").classList.remove('d-none');
            document.getElementById("threeopponents").classList.remove('d-none');
            document.getElementById("fouropponents").classList.remove('d-none');
            document.getElementById("fiveopponents").classList.remove('d-none');
            document.getElementById("sixopponents").classList.remove('d-none');
            document.getElementById("sevenopponents").classList.remove('d-none');
            document.getElementById("eightopponents").classList.remove('d-none');
            document.getElementById("nineopponents").classList.remove('d-none');
            document.getElementById("tenopponents").classList.remove('d-none');
            document.getElementById("elevenopponents").classList.add('d-none');;
        }
        if (answer.value == "11O") {
            document.getElementById("oneopponent").classList.remove('d-none');
            document.getElementById("twoopponents").classList.remove('d-none');
            document.getElementById("threeopponents").classList.remove('d-none');
            document.getElementById("fouropponents").classList.remove('d-none');
            document.getElementById("fiveopponents").classList.remove('d-none');
            document.getElementById("sixopponents").classList.remove('d-none');
            document.getElementById("sevenopponents").classList.remove('d-none');
            document.getElementById("eightopponents").classList.remove('d-none');
            document.getElementById("nineopponents").classList.remove('d-none');
            document.getElementById("tenopponents").classList.remove('d-none');
            document.getElementById("elevenopponents").classList.remove('d-none');;
        }
    };
</script>
<div class="container test-center register">
    <div class="row">
        <input type="submit" class="input20" value="Submit &nbsp❯" name="register" tabindex="3" />

    </div>
    </form>
</div>





</body>