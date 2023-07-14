<?php
//connection to db
require_once '../frontend2/Pages/connection.php';
// GET CONNECTION ERRORS
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$test = $_SESSION["reference"];
$query = "SELECT * FROM `pleadings` WHERE reference='$test'";

// FETCHING DATA FROM DATABASE
$result = $conn->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $opponents = $row['opponents'];
        $html = "<head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='stylesheet' href=''>
        <title>Add a Party</title>
        </head>
        <navi>
        <div class='heading1'>
            <h4>AutoLegal
                <label1 for='file'>Progress:
                    <progress id='file' value='60' max='90'></progress>
                </label1>
            </h4>
        </div>
        <ul class='nav-linker'>
    
        </ul>
    </navi><br><br>
    </head>
    <body style='background-color: black'>";

        if ($opponents == "1") {
            echo $html;
            echo "<p class='p3'><br><br>How many opponent attorneys are there?</p><br>
        <br><br>
        <div class='container'>
            <form action='p10.php' method='post'>

                <select id='opponents' class='p1' onchange='enableopponents(this)' name='attorneys'>
                <option value='1O'>&nbsp&nbsp&nbsp&nbsp&nbspPlease select</option>
                    
                <option value='1O'>Stays 1 Opponent</option>
                <option value='2O'>&nbsp&nbsp&nbsp&nbsp&nbsp2 Opponents</option>
                <option value='3O'>&nbsp&nbsp&nbsp&nbsp&nbsp3 Opponents</option>
                <option value='4O'>&nbsp&nbsp&nbsp&nbsp&nbsp4 Opponents</option>
                <option value='5O'>&nbsp&nbsp&nbsp&nbsp&nbsp5 Opponents</option>
                <option value='6O'>&nbsp&nbsp&nbsp&nbsp&nbsp6 Opponents</option>
                <option value='7O'>&nbsp&nbsp&nbsp&nbsp&nbsp7 Opponents</option>
                <option value='8O'>&nbsp&nbsp&nbsp&nbsp&nbsp8 Opponents</option>
                <option value='9O'>&nbsp&nbsp&nbsp&nbsp&nbsp9 Opponents</option>
                <option value='10O'>&nbsp&nbsp&nbsp&nbsp&nbsp10 Opponents</option>
                <option value='11O'>&nbsp&nbsp&nbsp&nbsp&nbsp11 Opponents</option>

                </select>
        </div>
        <div id='oneopponent' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyone'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneyone' rows='8' cols='40' value='' ></textarea>
        </div>
        </div>

        <div id='twoopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneytwo'>Second Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneytwo' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='threeopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneythree'>Third Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneythree' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fouropponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfour'>Fourth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfour' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fiveopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfive'>Fifth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfive' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sixopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneysix'>Sixth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneysix' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyseven'>Seventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyseven' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='eightopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeight'>Eighth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeight' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='nineopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneynine'>Ninth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneynine' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='tenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyten'>Tenth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyten' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='elevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeleven'>Eleventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeleven' rows='8' cols='40' value=''></textarea>
            </div>
            </div>";
        }
        if ($opponents == "2") {
            echo $html;
            echo "<p class='p3'><br><br>How many opponent attorneys are there?</p><br>
        <br><br>
        <div class='container'>
            <form action='p10.php' method='post'>

                <select id='opponents' class='p1' onchange='enableopponents(this)' name='attorneys' >
                    <option value='2O'>&nbsp&nbsp&nbsp&nbsp&nbspPlease select</option>
                    
                    <option value='2O'>Stays 2 Opponents</option>
                    <option value='3O'>&nbsp&nbsp&nbsp&nbsp&nbsp3 Opponents</option>
                    <option value='4O'>&nbsp&nbsp&nbsp&nbsp&nbsp4 Opponents</option>
                    <option value='5O'>&nbsp&nbsp&nbsp&nbsp&nbsp5 Opponents</option>
                    <option value='6O'>&nbsp&nbsp&nbsp&nbsp&nbsp6 Opponents</option>
                    <option value='7O'>&nbsp&nbsp&nbsp&nbsp&nbsp7 Opponents</option>
                    <option value='8O'>&nbsp&nbsp&nbsp&nbsp&nbsp8 Opponents</option>
                    <option value='9O'>&nbsp&nbsp&nbsp&nbsp&nbsp9 Opponents</option>
                    <option value='10O'>&nbsp&nbsp&nbsp&nbsp&nbsp10 Opponents</option>
                    <option value='11O'>&nbsp&nbsp&nbsp&nbsp&nbsp11 Opponents</option>

                </select>
                
        </div>
        <div id='oneopponent' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyone'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneyone' rows='8' cols='40' value='' ></textarea>
        </div>
        </div>

        <div id='twoopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneytwo'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneytwo' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='threeopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneythree'>Third Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneythree' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fouropponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfour'>Fourth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfour' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fiveopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfive'>Fifth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfive' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sixopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneysix'>Sixth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneysix' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyseven'>Seventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyseven' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='eightopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeight'>Eighth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeight' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='nineopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneynine'>Ninth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneynine' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='tenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyten'>Tenth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyten' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='elevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeleven'>Eleventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeleven' rows='8' cols='40' value=''></textarea>
            </div>
            </div></option>";
        }
        if ($opponents == "3") {
            echo $html;
            echo "<p class='p3'><br><br>How many opponent attorneys are there?</p><br>
        <br><br>
        <div class='container'>
            <form action='p10.php' method='post'>

                <select id='opponents' class='p1' onchange='enableopponents(this)' name='attorneys' >
                    <option value='3O'>&nbsp&nbsp&nbsp&nbsp&nbspPlease select</option>
                    
                    
                    <option value='3O'>Stays 3 Opponents</option>
                    <option value='4O'>&nbsp&nbsp&nbsp&nbsp&nbsp4 Opponents</option>
                    <option value='5O'>&nbsp&nbsp&nbsp&nbsp&nbsp5 Opponents</option>
                    <option value='6O'>&nbsp&nbsp&nbsp&nbsp&nbsp6 Opponents</option>
                    <option value='7O'>&nbsp&nbsp&nbsp&nbsp&nbsp7 Opponents</option>
                    <option value='8O'>&nbsp&nbsp&nbsp&nbsp&nbsp8 Opponents</option>
                    <option value='9O'>&nbsp&nbsp&nbsp&nbsp&nbsp9 Opponents</option>
                    <option value='10O'>&nbsp&nbsp&nbsp&nbsp&nbsp10 Opponents</option>
                    <option value='11O'>&nbsp&nbsp&nbsp&nbsp&nbsp11 Opponents</option>

                </select>
        </div>
        <div id='oneopponent' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyone'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneyone' rows='8' cols='40' value='' ></textarea>
        </div>
        </div>

        <div id='twoopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneytwo'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneytwo' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='threeopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneythree'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneythree' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fouropponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfour'>Fourth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfour' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fiveopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfive'>Fifth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfive' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sixopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneysix'>Sixth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneysix' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyseven'>Seventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyseven' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='eightopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeight'>Eighth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeight' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='nineopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneynine'>Ninth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneynine' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='tenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyten'>Tenth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyten' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='elevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeleven'>Eleventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeleven' rows='8' cols='40' value=''></textarea>
            </div>
            </div>";
        }
        if ($opponents == "4") {
            echo $html;
            echo "<p class='p3'><br><br>How many opponent attorneys are there?</p><br>
        <br><br>
        <div class='container'>
            <form action='p10.php' method='post'>

                <select id='opponents' class='p1' onchange='enableopponents(this)' name='attorneys' >
                    <option value='4O'>&nbsp&nbsp&nbsp&nbsp&nbspPlease select</option>
                    
                    
                    
                    <option value='4O'>Stays 4 Opponents</option>
                    <option value='5O'>&nbsp&nbsp&nbsp&nbsp&nbsp5 Opponents</option>
                    <option value='6O'>&nbsp&nbsp&nbsp&nbsp&nbsp6 Opponents</option>
                    <option value='7O'>&nbsp&nbsp&nbsp&nbsp&nbsp7 Opponents</option>
                    <option value='8O'>&nbsp&nbsp&nbsp&nbsp&nbsp8 Opponents</option>
                    <option value='9O'>&nbsp&nbsp&nbsp&nbsp&nbsp9 Opponents</option>
                    <option value='10O'>&nbsp&nbsp&nbsp&nbsp&nbsp10 Opponents</option>
                    <option value='11O'>&nbsp&nbsp&nbsp&nbsp&nbsp11 Opponents</option>

                </select>
        </div>
        <div id='oneopponent' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyone'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneyone' rows='8' cols='40' value='' ></textarea>
        </div>
        </div>

        <div id='twoopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneytwo'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneytwo' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='threeopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneythree'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneythree' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fouropponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfour'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfour' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fiveopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfive'>Fifth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfive' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sixopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneysix'>Sixth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneysix' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyseven'>Seventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyseven' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='eightopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeight'>Eighth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeight' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='nineopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneynine'>Ninth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneynine' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='tenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyten'>Tenth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyten' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='elevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeleven'>Eleventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeleven' rows='8' cols='40' value=''></textarea>
            </div>
            </div>";
        }
        if ($opponents == "5") {
            echo $html;
            echo "<p class='p3'><br><br>How many opponent attorneys are there?</p><br>
        <br><br>
        <div class='container'>
            <form action='p10.php' method='post'>

                <select id='opponents' class='p1' onchange='enableopponents(this)' name='attorneys' >
                    <option value='5O'>&nbsp&nbsp&nbsp&nbsp&nbspPlease select</option>
                    
                    
                    
                    
                    <option value='5O'>Stays 5 Opponents</option>
                    <option value='6O'>&nbsp&nbsp&nbsp&nbsp&nbsp6 Opponents</option>
                    <option value='7O'>&nbsp&nbsp&nbsp&nbsp&nbsp7 Opponents</option>
                    <option value='8O'>&nbsp&nbsp&nbsp&nbsp&nbsp8 Opponents</option>
                    <option value='9O'>&nbsp&nbsp&nbsp&nbsp&nbsp9 Opponents</option>
                    <option value='10O'>&nbsp&nbsp&nbsp&nbsp&nbsp10 Opponents</option>
                    <option value='11O'>&nbsp&nbsp&nbsp&nbsp&nbsp11 Opponents</option>

                </select>
        </div>
        <div id='oneopponent' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyone'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneyone' rows='8' cols='40' value='' ></textarea>
        </div>
        </div>

        <div id='twoopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneytwo'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneytwo' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='threeopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneythree'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneythree' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fouropponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfour'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfour' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fiveopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfive'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfive' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sixopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneysix'>Sixth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneysix' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyseven'>Seventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyseven' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='eightopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeight'>Eighth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeight' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='nineopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneynine'>Ninth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneynine' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='tenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyten'>Tenth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyten' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='elevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeleven'>Eleventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeleven' rows='8' cols='40' value=''></textarea>
            </div>
            </div>";
        }
        if ($opponents == "6") {
            echo $html;
            echo "<p class='p3'><br><br>How many opponent attorneys are there?</p><br>
        <br><br>
        <div class='container'>
            <form action='p10.php' method='post'>

                <select id='opponents' class='p1' onchange='enableopponents(this)' name='attorneys' >
                    <option value='6O'>&nbsp&nbsp&nbsp&nbsp&nbspPlease select</option>
                    
                    
                    
                    
                   
                    <option value='6O'>Stays 6 Opponents</option>
                    <option value='7O'>&nbsp&nbsp&nbsp&nbsp&nbsp7 Opponents</option>
                    <option value='8O'>&nbsp&nbsp&nbsp&nbsp&nbsp8 Opponents</option>
                    <option value='9O'>&nbsp&nbsp&nbsp&nbsp&nbsp9 Opponents</option>
                    <option value='10O'>&nbsp&nbsp&nbsp&nbsp&nbsp10 Opponents</option>
                    <option value='11O'>&nbsp&nbsp&nbsp&nbsp&nbsp11 Opponents</option>

                </select>
        </div>
        <div id='oneopponent' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyone'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneyone' rows='8' cols='40' value='' ></textarea>
        </div>
        </div>

        <div id='twoopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneytwo'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneytwo' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='threeopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneythree'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneythree' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fouropponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfour'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfour' rows='8' hidden cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fiveopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfive'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfive' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sixopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneysix'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneysix'  hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyseven'>Seventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyseven' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='eightopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeight'>Eighth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeight' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='nineopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneynine'>Ninth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneynine' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='tenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyten'>Tenth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyten' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='elevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeleven'>Eleventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeleven' rows='8' cols='40' value=''></textarea>
            </div>
            </div>";
        }
        if ($opponents == "7") {
            echo $html;
            echo "<p class='p3'><br><br>How many opponent attorneys are there?</p><br>
        <br><br>
        <div class='container'>
            <form action='p10.php' method='post'>

                <select id='opponents' class='p1' onchange='enableopponents(this)' name='attorneys' >
                    <option value='7O'>&nbsp&nbsp&nbsp&nbsp&nbspPlease select</option>
                    
                    
                    
                    
                   
                   
                    <option value='7O'>Stays 7 Opponents</option>
                    <option value='8O'>&nbsp&nbsp&nbsp&nbsp&nbsp8 Opponents</option>
                    <option value='9O'>&nbsp&nbsp&nbsp&nbsp&nbsp9 Opponents</option>
                    <option value='10O'>&nbsp&nbsp&nbsp&nbsp&nbsp10 Opponents</option>
                    <option value='11O'>&nbsp&nbsp&nbsp&nbsp&nbsp11 Opponents</option>

                </select>
        </div>
        <div id='oneopponent' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyone'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneyone' rows='8' cols='40' value='' ></textarea>
        </div>
        </div>

        <div id='twoopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneytwo'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneytwo' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='threeopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneythree'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneythree' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fouropponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfour'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfour' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fiveopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfive'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfive' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sixopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneysix'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneysix' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyseven'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyseven' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='eightopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeight'>Eighth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeight' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='nineopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneynine'>Ninth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneynine' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='tenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyten'>Tenth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyten' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='elevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeleven'>Eleventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeleven' rows='8' cols='40' value=''></textarea>
            </div>
            </div>";
        }
        if ($opponents == "8") {
            echo $html;
            echo "<p class='p3'><br><br>How many opponent attorneys are there?</p><br>
        <br><br>
        <div class='container'>
            <form action='p10.php' method='post'>

                <select id='opponents' class='p1' onchange='enableopponents(this)' name='attorneys' >
                    <option value='8O'>&nbsp&nbsp&nbsp&nbsp&nbspPlease select</option>
                    
                    
                    
                    
                   
                   
                    
                    <option value='8O'>Stays 8 Opponents</option>
                    <option value='9O'>&nbsp&nbsp&nbsp&nbsp&nbsp9 Opponents</option>
                    <option value='10O'>&nbsp&nbsp&nbsp&nbsp&nbsp10 Opponents</option>
                    <option value='11O'>&nbsp&nbsp&nbsp&nbsp&nbsp11 Opponents</option>

                </select>
        </div>
        <div id='oneopponent' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyone'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneyone' rows='8' cols='40' value='' ></textarea>
        </div>
        </div>

        <div id='twoopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneytwo'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneytwo' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='threeopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneythree'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneythree' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fouropponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfour'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfour' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fiveopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfive'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfive' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sixopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneysix'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneysix' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyseven'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyseven' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='eightopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeight'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeight' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='nineopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneynine'>Ninth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneynine' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='tenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyten'>Tenth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyten' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='elevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeleven'>Eleventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeleven' rows='8' cols='40' value=''></textarea>
            </div>
            </div>";
        }
        if ($opponents == "9") {
            echo $html;
            echo "<p class='p3'><br><br>How many opponent attorneys are there?</p><br>
        <br><br>
        <div class='container'>
            <form action='p10.php' method='post'>

                <select id='opponents' class='p1' onchange='enableopponents(this)' name='attorneys' >
                    <option value='9O'>&nbsp&nbsp&nbsp&nbsp&nbspPlease select</option>
                    
                    
                    
                    
                   
                   
                    
                    
                    <option value='9O'>Stays 9 Opponents</option>
                    <option value='10O'>&nbsp&nbsp&nbsp&nbsp&nbsp10 Opponents</option>
                    <option value='11O'>&nbsp&nbsp&nbsp&nbsp&nbsp11 Opponents</option>

                </select>
        </div>
        <div id='oneopponent' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyone'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneyone' rows='8' cols='40' value='' ></textarea>
        </div>
        </div>

        <div id='twoopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneytwo'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneytwo' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='threeopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneythree'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneythree' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fouropponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfour'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfour' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fiveopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfive'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfive' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sixopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneysix'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneysix' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyseven'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyseven' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='eightopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeight'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeight' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='nineopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneynine'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneynine' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='tenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyten'>Tenth Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyten' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='elevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeleven'>Eleventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeleven' rows='8' cols='40' value=''></textarea>
            </div>
            </div>";
        }
        if ($opponents == "10") {
            echo $html;
            echo "<p class='p3'><br><br>How many opponent attorneys are there?</p><br>
        <br><br>
        <div class='container'>
            <form action='p10.php' method='post'>

                <select id='opponents' class='p1' onchange='enableopponents(this)' name='attorneys' >
                    <option value='10O'>&nbsp&nbsp&nbsp&nbsp&nbspPlease select</option>
                    
                    
                    
                    
                   
                   
                    
                    
                    
                    <option value='10O'>Stays 10 Opponents</option>
                    <option value='11O'>&nbsp&nbsp&nbsp&nbsp&nbsp11 Opponents</option>

                </select>
        </div>
        <div id='oneopponent' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyone'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2'  name='attorneyone' hidden rows='8' cols='40' value='' ></textarea>
        </div>
        </div>

        <div id='twoopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneytwo'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneytwo' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='threeopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneythree'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneythree' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fouropponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfour'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfour' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fiveopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfive'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfive' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sixopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneysix'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneysix' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyseven'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyseven' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='eightopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeight'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeight' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='nineopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneynine'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneynine' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='tenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyten'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyten' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='elevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeleven'>Eleventh Attorney:</label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeleven' rows='8' cols='40' value=''></textarea>
            </div>
            </div>";
        }
        if ($opponents == "11") {
            echo $html;
            echo "<p class='p3'><br><br>How many opponent attorneys are there?</p><br>
        <br><br>
        <div class='container'>
            <form action='p10.php' method='post'>

                <select id='opponents' class='p1' onchange='enableopponents(this)' name='attorneys' >
                    <option value='11O'>&nbsp&nbsp&nbsp&nbsp&nbspPlease select</option>
                    
                    <option value='11O'>Stays 11 Opponents</option>
                   
                </select>
        </div>
        <div id='oneopponent' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyone'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneyone' rows='8' cols='40' value='' ></textarea>
        </div>
        </div>

        <div id='twoopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneytwo'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' hidden name='attorneytwo' rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='threeopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneythree'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneythree' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fouropponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfour'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfour' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='fiveopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyfive'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyfive' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sixopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneysix'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneysix' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='sevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyseven'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyseven' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='eightopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeight'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeight' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='nineopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneynine'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneynine' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='tenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyten'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyten' hidden rows='8' cols='40' value=''></textarea>
        </div>
        </div>

        <div id='elevenopponents' class='d-none'><br>
            <div class='col-opponents'>
                <label for='attorneyeleven'></label>
            </div>
            <textarea id='attorneyone' class='col-85' id='input2' name='attorneyeleven' hidden rows='8' cols='40' value=''></textarea>
            </div>
            </div>";
        }
    }
    echo "<input type='submit' class='input20' value='Submit &nbsp❯' name='register' tabindex='3' /><br><br>";
}





$conn->close();

?>


<style type="text/css">
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
        margin-left: 540px;
        resize: vertical;
        overflow: auto;
        width: 304px;
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
        margin-left: 532px;
        position: absolute;
        padding: 8px 62px;
        font-size: 100%;
        cursor: pointer;
        border-radius: 0;
        background-color: black;
        border: none;
        border: 2px solid white;
        border-radius: 4px;
        width: 295px;
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
        height: 180px;
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

</body>