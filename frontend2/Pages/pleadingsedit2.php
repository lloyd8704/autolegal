<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../app.css">
    <title>Pleadings Edit</title>
</head>

<body>


    </ul>
    </nav>



    <body style="background-color: black">

        <navi>
            <div class="heading1">
                <h4>AutoLegal</h4>
            </div>
            <ul class="nav-linker">
                <li><a class="nav-link" href="../Index.html">Home </a></li>
                <li><a class="nav-link" href="newfile.html">New&nbspFile </a></li>
                <li><a class="nav-link" href="correspondence.html">Correspondence</a></li>
                <li><a class="nav-link" href="pleadings.html">Pleadings </a></li>
                <li><a class="nav-link" href="contactshome.html">Contacts</a></li>
                <li><a class="nav-link" href="dropdownlegislation.php">Legislation</a></li>
                <li><a class="nav-link active" href="edit.php">Edit</a></li>
            </ul>
        </navi>
        </style>
        </head>
        <style>
            .heading4 {
                color: white;
                background-color: black;
                font-family: "Montserrat", sans-serif;
                letter-spacing: 0px;
                font-size: 23px;
                text-align: center;
                margin: 0px;
            }
        </style>
        <?php
        require_once '../Pages/connection.php';



        //$_POST["reference"];
        $test = $_POST['reference'];
        $query = "SELECT * FROM `pleadings` WHERE reference='$test'";

        session_start();
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reference = $row['reference'];
                $_SESSION['reference'] = $reference;
                $court = $row['court'];
                $represent = $row['represent'];
                $casenumber = $row['casenumber'];
                $location = $row['location'];
                $ourdetails = $row['ourdetails'];
                $author = $row['author'];
                $id = $row['id'];

                echo "<br>
                <div class='container'>
                        
                        <form action='../../frontend2/Pages/pleadingsupdate1.php' method='post'>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>*Reference number:</label>
                        </div>
                        <div class='col-75'>
                        <input name='reference' type='text' class='input1' id='reference' value='$reference' autofocus='on' required autocomplete='off'/> 
                        </div>
                        </div>
                                            
                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>&nbspWho do we represent?</label>
                        </div>
                        <div class='col-75'>
                        <input name='represent' type='text' class='input1' id='court' value='$represent' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>&nbspCase number:</label>
                        </div>
                        <div class='col-75'>
                        <input name='casenumber' type='text' class='input1' id='casenumber' value='$casenumber' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>&nbspPlace of signature:</label>
                        </div>
                        <div class='col-75'>
                        <input name='location' type='text' class='input1' id='location' value='$location' autocomplete='off'/>
                        </div>
                        </div>

                        <div class='row'>
                        <div class='col-25'>
                        <label for='ref'>&nbspOur details:</label>
                        </div>
                        <div class='col-75'>
                        <textarea id='input2' class='col-75' name='ourdetails' rows='8' cols='40' value=''>$ourdetails
                        </textarea>
                        </div>
                        </div>
                        
                        <div class='row'>
                        <div class='col-25'>
                        <label for='author'>&nbspWhose file is this?</label>
                        </div>
                        <div class='col-75'>
                        <select id='author' name='author'>
                        <option value='$author'>Currently saved as ''$author''</option>
                        <option value='Lloyd'>Lloyd</option>
                        <option value='author b'>Attorney B</option>
                        <option value='author c'>Attorney C</option>
                        <option value='author d'>Attorney D</option>
                        <option value='author e'>Attorney E</option>
                        </select>
                        </div>
                        </div>
                              
                    
                        <div class='container'>
                        <select id='courts' class='p1' onchange='enablecourts(this)' name='courts'>
                        <option value='0'>Please select (only if you want to edit)</option>
                        <option value='1'>Magistrate's Court</option>
                        <option value='2'>Regional Court</option>
                        <option value='3'>High Court</option>
                        </select>

                        </div>
                        <div class='test'>
                        </div>

                        <div class='test'>
                        <div id='selection' class='d-none1'>
                        <div class='col-55'>
                        <label class='d-none1' for='selection'>Awaiting Selection:</label>
                        </div>
                        <div class='col-85'>
                        <input type='text' class='col-85' id='input2' name='selection' disabled>
                        </div>
                        </div>
                        </div>

                        <div class='test'>
                        <div id='mc' class='d-none'>
                        <div class='col-55'>
                        <label for='mc'>For the District of:</label>
                        </div>
                        <div class='col-85'>
                        <input type='text' class='col-85' id='input2' name='mc' value='' autocomplete='off' style='text-transform:uppercase'>
                        </div>
                        </div>
                        </div>

                        <div class='test'>
                        <div id='mcone' class='d-none'>
                        <div class='fieldlable'>
                        <label for='mcone'>Held At:</label>
                        </div>
                        <div class='field2input'>
                        <input type='text' class='field2input' id='input2' name='mcone' value='' autocomplete='off' style='text-transform:uppercase'>
                        </div>
                        </div>
                        </div>

                        <div class='test'>
                        <div id='rc' class='d-none'>
                        <div class='col-55'>
                        <label for='rc'>Regional Division of:</label>
                        </div>
                        <div class='col-85'>
                        <input type='text' class='col-85' id='input2' name='rc' value='' autocomplete='off' style='text-transform:uppercase'>
                        </div>
                        </div>
                        </div>

                        <div class='test'>
                        <div id='hc' class='d-none'>
                        <div class='col-55'>
                        <label for='hc'>Which Division:</label>
                        </div>
                        <div class='col-85'>
                        <select id='highcourts' class='dropdownhc' name='highcourts'>
                        <option value='(WESTERN CAPE DIVISION, CAPE TOWN)'>WESTERN CAPE DIVISION, CAPE TOWN</option>
                        <option value='(EASTERN CAPE DIVISION, GRAHAMSTOWN)'>EASTERN CAPE DIVISION, GRAHAMSTOWN</option>
                        <option value='(EASTERN CAPE LOCAL DIVISION, BHISHO)'>EASTERN CAPE LOCAL DIVISION, BHISHO</option>
                        <option value='(EASTERN CAPE LOCAL DIVISION, MTHATHA)'>EASTERN CAPE LOCAL DIVISION, MTHATHA</option>
                        <option value='(EASTERN CAPE LOCAL DIVISION, PORT ELIZABETH)'>EASTERN CAPE LOCAL DIVISION, PORT ELIZABETH</option>
                        <option value='(FREE STATE DIVISION, BLOEMFONTEIN)'>FREE STATE DIVISION, BLOEMFONTEIN</option>
                        <option value='(GAUTENG DIVISION, PRETORIA)'>GAUTENG DIVISION, PRETORIA</option>
                        <option value='(GAUTENG LOCAL DIVISION, JOHANNESBURG)'>GAUTENG LOCAL DIVISION, JOHANNESBURG</option>
                        <option value='(KWAZULU-NATAL DIVISION, PIETERMARITZBURG)'>KWAZULU-NATAL DIVISION, PIETERMARITZBURG</option>
                        <option value='(KWAZULU-NATAL LOCAL DIVISION, DURBAN)'>KWAZULU-NATAL LOCAL DIVISION, DURBAN</option>
                        <option value='(NORTHERN CAPE DIVISION, KIMBERLEY)'>NORTHERN CAPE DIVISION, KIMBERLEY</option>
                        <option value='(NORTH WEST DIVISION, MAHIKENG)'>NORTH WEST DIVISION, MAHIKENG</option>
                        </select>
                        </div>
                        </div>
                        </div>

                        <input name='id' type='hidden' class='input1' id='id' value='$id'/>
                        </div>
                        </div>

                        <input name='court' type='hidden' class='input1' id='id' value='$court'/>
                        </div>
                        </div>

                        <input type='submit' class='buttonedit' name='register' value='Submit'></div>
                        </form>
                        </div>";
            }
        } else echo "<span class='error'><br>There is no file with that reference number - Please try a different reference number</span>";
        ?>
        <script type="text/javascript">
            function enablecourts(answer) {
                console.log(answer.value);
                if (answer.value == "0") {

                    document.getElementById("selection").classList.add('d-none');
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
        </script>

        <script>
            function myFunction() {
                var x = document.getElementById("court").required;
                document.getElementById("demo").innerHTML = x;
            }
        </script>
        <style>
            .container {
                margin-top: -35px;
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

            .test {
                width: 50%;
                float: left;
            }

            .test2 {
                width: 50%;
                float: right;
            }




            .dropdownhc {
                margin-left: 71px;
                width: 330px;
                height: 34px;
                position: absolute;
                top: 273px;
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
                margin-top: 75px;
                left: 266px;
                padding: 6px 65px;

            }

            .fieldlable {
                color: white;
                font-family: "Montserrat", sans-serif;
                font-weight: bold;
                position: absolute;
                margin-top: 75px;
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
                margin-left: 255px;
                width: 328px;
                height: 32px;
                position: absolute;
                top: 273px;
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
                top: 273px;
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
                margin-top: 490px;
                margin-left: 355px;
                width: 328px;
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

            .buttonedit {
                background-color: black;
                color: white;
                font-weight: bold;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                border: 2px solid white;
                cursor: pointer;
                position: absolute;
                top: 596px;
                left: 650px;
            }

            .buttonedit:hover {
                background-color: white;
                color: black;
                font-weight: bold;
            }
        </style>
    </body>

</html>