<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <title>Pleadings</title>
    <link rel="shortcut icon" type="image/x-icon" href="../frontend2/favicon.ico">
</head>
<div id="test">

    <body style="background-color: black">
        <navi>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="Index.html">Home</a></li>
                <li><a class="nav-link active" href="../frontend2/Pages/newfile.html">New&nbspFile</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/correspondence.html">Correspondence</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/pleadings.html">Pleadings</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/contactshome.html">Contacts</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-link" href="../frontend2/Pages/edit.php">Edit</a></li>
                <li><a class="nav-link" id="plus" href="../frontend2/Pages/extras.html">+</a></li>
            </ul>
        </navi>
        </head>

        <body>

            <?php
            if (isset($_GET['error'])) {
                echo '<div id="error">' . $_GET['error'] . '</div>';
            }

            if (isset($_GET['success'])) {
                echo '<div id="success">' . $_GET['success'] . '</div>';
            }
            ?>
            <div class="container">
                <form action="p1.php" method="post">
                    <div class="row">
                        <div class="col-25">
                            <label for="reference">*Reference number:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" class="input1" id="reference" style="text-transform:capitalize" name="reference" value="" autofocus="on" required autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="represent">&nbspWho do we represent:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" class="input1" id="represent" style="text-transform:uppercase" placeholder="e.g. Plaintiff " name="represent" value="" autofocus="on" autocomplete="off">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="casenumber">&nbspCase number:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" class="input1" id="casenumber" name="casenumber" value="" autocomplete="off">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-25">
                            <label for="location">&nbspPlace of signature:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" style="text-transform:uppercase" class="input1" id="input2" name="location" value="" placeholder="e.g. cape town" autocomplete="off">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-25">
                            <label for="author">&nbspWhose file is this:</label>
                        </div>
                        <div class="col-75">
                            <select id="author" name="author">
                                <option value="Lloyd">Lloyd</option>
                                <option value="author b">Attorney B</option>
                                <option value="author c">Attorney C</option>
                                <option value="author d">Attorney D</option>
                                <option value="author e">Attorney E</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="author">&nbspOur details:</label>
                        </div>

                        <div class="col-75">
                            <textarea id="ourdetails" class="col-75" name="ourdetails" rows="7" cols="40"></textarea>
                        </div>
                    </div>

                    <div class="test">

                        <div class="col-55">
                            <label id="whichcourt" for="selection">Which court:</label>
                        </div>
                        <div class="container">
                            <select id="courts" class="p1" onchange="enablecourts(this)" name="courts" required>
                                <option value="">Please select</option>
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
                                    <input type="text" class="col-85" id="input2" name="mc" value="" autocomplete="off" style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>

                        <div class="test">
                            <div id="mcone" class="d-none">
                                <div class="fieldlable">
                                    <label for="mcone">Held At:</label>
                                </div>
                                <div class="field2input">
                                    <input type="text" class="field2input" id="input2" name="mcone" value="" autocomplete="off" style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>


                        <div class="test">
                            <div id="rc" class="d-none">
                                <div class="col-55">
                                    <label for="rc">Regional Division of:</label>
                                </div>
                                <div class="col-85">
                                    <input type="text" class="col-85" id="input2" name="rc" value="" autocomplete="off" style="text-transform:uppercase">
                                </div>
                            </div>
                        </div>

                        <div class="test">
                            <div id="hc" class="d-none">
                                <div class="col-55">
                                    <label for="hc">Which Division:</label>
                                </div>
                                <div class="col-85">
                                    <select id="highcourts" class="dropdownhc" name="highcourts">
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

                    </div>
            </div>
            <script type="text/javascript">
                function enablecourts(answer) {
                    console.log(answer.value);
                    if (answer.value == "") {

                        document.getElementById("selection").classList.remove('d-none');
                        document.getElementById("mc").classList.add('d-none');
                        document.getElementById("rc").classList.add('d-none');
                        document.getElementById("mcone").classList.add('d-none');
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

                document.addEventListener("DOMContentLoaded", function() {
                    var reference = document.getElementById("reference").value;
                    var selectedAuthor = document.getElementById("author").value;
                    var ourDetails = "Ground Floor, Unit 1\n43 Blaauwberg Road\nTABLE VIEW\n(Ref: " + reference + " )\nTel: 021 200 8445\nemail: " + selectedAuthor + "@solicitors.co.za";
                    document.getElementById("ourdetails").value = ourDetails;
                });

                document.getElementById("reference").addEventListener("input", function() {
                    var reference = this.value;
                    var selectedAuthor = document.getElementById("author").value;
                    var ourDetails = "Ground Floor, Unit 1\n43 Blaauwberg Road\nTABLE VIEW\n(Ref: " + reference + " )\nTel: 021 200 8445\nemail: " + selectedAuthor + "@solicitors.co.za";
                    document.getElementById("ourdetails").value = ourDetails;
                });

                document.getElementById("author").addEventListener("change", function() {
                    var reference = document.getElementById("reference").value;
                    var selectedAuthor = this.value;
                    var ourDetails = "Ground Floor, Unit 1\n43 Blaauwberg Road\nTABLE VIEW\n(Ref: " + reference + ")\nTel: 021 200 8445\nemail: " + selectedAuthor + "@solicitors.co.za";
                    document.getElementById("ourdetails").value = ourDetails;
                });
                document.getElementById("reference").addEventListener("input", function() {
                    var reference = this.value.toUpperCase();
                    var selectedAuthor = document.getElementById("author").value;
                    var ourDetails = "Ground Floor, Unit 1\n43 Blaauwberg Road\nTABLE VIEW\n(Ref: " + reference + " )\nTel: 021 200 8445\nemail: " + selectedAuthor + "@solicitors.co.za";
                    document.getElementById("ourdetails").value = ourDetails;
                });
            </script><br>
            <div class="row">
                <input type="submit" class="pleadingspageonenext" value="Next &nbsp&nbsp&nbsp❯" name="register" tabindex="3" />

            </div>
            </form>
</div>

<div>
    <a class="pleadingspageoneback" tabindex="1" href="../frontend2/Pages/newfile.html">❮&nbsp&nbsp&nbspBack</a>
</div>
</div>
<div class="tooltip">?
    <span class="tooltiptext">The firm's name and who we represent will be included automatically.</span>
</div>
<script>
    function myFunction() {
        var x = document.getElementById("court").required;
        document.getElementById("demo").innerHTML = x;
    }
    setTimeout(function() {
        document.querySelector('#error').style.display = 'none';
        document.querySelector('#success').style.display = 'none';
    }, 2000);
</script>
<style>
    #whichcourt {
        position: relative;
        bottom: 30px;
    }

    .pleadingspageonenext {
        background-color: black;
        color: white;
        font-weight: bold;
        padding: 12px 27px;
        border: none;
        border-radius: 4px;
        border: 2px solid white;
        cursor: pointer;
        position: relative;
        left: 702px;
        top: 89px;
    }

    .pleadingspageonenext:hover {
        background-color: white;
        color: black;
    }

    .pleadingspageoneback {
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
        left: 575px;
        top: 55px;
        width: 25mm;
    }

    .pleadingspageoneback:hover {
        background-color: white;
        color: black;
    }

    .test {
        width: 50%;
        float: left;
    }

    .test2 {
        width: 50%;
        float: right;
    }




    .dropdownhc {
        margin-left: 72px;
        width: 327px;
        height: 34px;
        position: absolute;
        top: 260px;
        font-family: "Montserrat", sans-serif;
        font-weight: bold;

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
        margin-top: 48px;
        left: 266px;
        padding: 6px 65px;

    }

    .fieldlable {
        color: white;
        font-family: "Montserrat", sans-serif;
        font-weight: bold;
        position: absolute;
        margin-top: 50px;
        left: 826px;
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
        margin-left: 254px;
        width: 328px;
        height: 32px;
        position: absolute;
        top: 260px;
        font-family: "Montserrat", sans-serif;
        font-weight: bold;
        padding: 11px;
        border-radius: 4px;
    }


    .field2input {
        margin-left: 462px;
        width: 200px;
        height: 33px;
        position: absolute;
        top: 260px;
        border-radius: 4px;
        font-family: "Montserrat", sans-serif;
        font-weight: bold;
        padding: 11px;
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
        /* color: white; */
        font-family: "Montserrat", sans-serif;
        font-weight: bold;
        margin-top: 464px;
        margin-left: 355px;
        width: 326px;
        position: absolute;
        /* padding: 6px 65px; */
        /* font-size: 100%; */
        cursor: pointer;
        border-radius: 0;
        /* background-color: black; */
        border: none;
        /* border: 2px solid white; */
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

    .inputpleadings[type=submit] {
        background-color: black;
        color: white;
        font-weight: bold;
        padding: 12px 27px;
        border: none;
        border-radius: 4px;
        border: 2px solid white;
        cursor: pointer;
        position: relative;
        left: 702px;
        top: 49px
    }


    .inputpleadings[type=submit]:hover {
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

    .tooltip {
        position: relative;
        display: inline-block;
        color: white;
        cursor: default;
        left: 880px;
        top: -214px;
        font-weight: 1000;
        cursor: pointer;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 197px;
        background-color: white;
        color: black;
        text-align: center;
        padding: 10px 12px;
        position: absolute;
        z-index: 1;
        top: 100%;
        left: 50%;
        margin-top: 10px;
        margin-left: -6px;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;

    }

    .tooltip .tooltiptext::before {
        content: "";
        position: absolute;
        bottom: 100%;
        left: 7px;
        margin-left: -7px;
        border-width: 7px;
        border-style: solid;
        border-color: transparent transparent white transparent;
    }

    #error,
    #success {
        position: fixed;
        top: -30px;
        left: 0;
        right: 0;
        padding: 20px;
        height: 20px;
        color: #fff;
        text-align: center;
        z-index: 9999;
    }
</style>
</body>

</html>