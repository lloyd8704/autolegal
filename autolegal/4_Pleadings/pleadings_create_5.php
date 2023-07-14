<?php


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
    <link rel="stylesheet" href="../9_Style/style.css" />
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
    <title>Create a Pleading</title>
</head>
<style>
    #register {
        left: 620px;
    }
</style>

<body style="background-color: black">
    <nav>
        <div class="heading1">
            <h4>AutoLegal</h4>
        </div>
        <ul class="nav-linker">
            <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
            <li><a class="nav-link" href="../2_New_file/Index.php">New&nbspFile</a></li>
            <li><a class="nav-link" href="../3_Correspondence/Index.php">Correspondence</a></li>
            <li><a class="nav-link active" href="../4_Pleadings/Index.php">Pleadings</a></li>
            <li><a class="nav-link" href="../5_Contacts/Index.php">Contacts</a></li>
            <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
            <li><a class="nav-link" href="../7_Edit/Index.php">Edit</a></li>
            <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
        </ul>
    </nav>
    <?php

    $name1 = $_SESSION['Pleadings'];
    if (str_contains($name1, '- Code P0')) {
        echo "<div class='container'>
    <form action='../4_Pleadings/pleadings_create_5a.php' method='post'>
        <br><br>
        <div class='row'>
            <div class='col-25'>
                <label for='ref'>On whom do you want <br>to serve the document?</label>
            </div>
            <div class='col-75'>
                <input type='text' class='input1' id='ref' name='input1' style='text-transform:capitalize' value='' autofocus='on' required autocomplete='off'>
            </div>
        </div> <div class='row'>
        <input type='submit' class='inputcontacts' value='Submit&nbsp&nbsp❯' name='register' id='register' tabindex='3' />
    </div>
    </form>
</div>

</div>";
    } else if (str_contains($name1, '- Code PA')) {
        echo "<div class='container'>
    <form action='../4_Pleadings/pleadings_create_5b.php' method='post'>
        <br><br>
        <div class='row'>
            <div class='col-25'>
                <label for='ref'>On whom do you want <br>to serve the document?</label>
            </div>
            <div class='col-75'>
                <input type='text' class='input1' id='ref' name='input1' style='text-transform:capitalize' value='' autofocus='on' required autocomplete='off'>
            </div>
        </div>
        <div class='row'>
            <div class='col-25'>
                <label for='name'>The amount you are<br> claiming?</label>
            </div>
            <div class='col-75'>
            <input type='text' class='input1' id='input1' name='input2' style='text-transform:capitalize' value='' min='0' value='0' step='.01' autofocus='on' required autocomplete='off' oninput='numberWithCommas(this)'>
            </div>
        </div>
              <div class='row'>
            <input type='submit' class='inputcontacts' value='Submit&nbsp&nbsp❯' name='register' id='register' tabindex='3' />

        </div>
    </form>
</div>

</div>";
    } else if (str_contains($name1, '- Code PD')) {
        echo "<div class='container'>
<form action='../4_Pleadings/pleadings_create_5f.php' method='post'>
    <br><br>
    <div class='row'>
        <div class='col-25'>
            <label for='ref'>Who do you represent?</label>
        </div>
        <div class='col-75'>
            <input type='text' class='input1' id='ref' name='input1' style='text-transform:capitalize' value='' autofocus='on' required autocomplete='off' placeholder='Respondent/First Respondent'>
        </div>
    </div>
    <div class='row'>
        <div class='col-25'>
            <label for='name'>Who are our opponents?</label>
        </div>
        <div class='col-75'>
        <input type='text' class='input1' id='ref' name='input3' style='text-transform:capitalize' value='' autofocus='on' required autocomplete='off' placeholder='Applicant/First Applicant'>
        </div>
    </div>
    <div class='row'>
    <div class='col-25'>
        <label for='name'>The date of judgment?</label>
    </div>
    <div class='col-75'>
    <input type='text' class='input1' id='ref' name='input2' style='text-transform:capitalize' value='' autofocus='on' required autocomplete='off'>
    </div>
</div>
          <div class='row'>
        <input type='submit' class='inputcontacts' value='Submit&nbsp&nbsp❯' name='register' id='register' tabindex='3' />

    </div>
</form>
</div>

</div>";
    } else if (str_contains($name1, '- Code A')) {
        echo "<div class='container'>
    <form action='../4_Pleadings/pleadings_create_5c.php' method='post'>
        <br><br>
         <div class='row'>
            <div class='col-25'>
                <label for='name'>The amount?</label>
            </div>
            <div class='col-75'>
            <input type='text' class='input1' id='input1' name='input2' style='text-transform:capitalize' value='' min='0' value='0' step='.01' autofocus='on' required autocomplete='off' oninput='numberWithCommas(this)'>
            </div>
        </div>
        
        <div class='row'>
            <input type='submit' class='inputcontacts' value='Submit&nbsp&nbsp❯' name='register' id='register' tabindex='3' />

        </div>
    </form>
</div>

</div>";
    } else if (str_contains($name1, '- Code W0')) {
        echo "
    <form class='container' action='../4_Pleadings/pleadings_create_5d.php' method='post'>
        <br><br>
        <div class='row'>
            <div class='col-25'>
                <label for='ref'>What is the Judgement Debt?&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspR</label>
            </div>
            <div class='col-75'>
                <input type='text' class='input1' id='input1' name='input1' style='text-transform:capitalize' value='' min='0' value='0' step='.01' autofocus='on' required autocomplete='off' oninput='numberWithCommas(this)'>
            </div>
        </div>
        <div class='row'>
            <div class='col-25'>
                <label for='name'>How much has been paid to date?&nbspR</label>
            </div>
            <div class='col-75'>
                <input type='text' class='input1' id='input2' name='input2' style='text-transform:capitalize' value='0' min='0' value='0' step='.01' autocomplete='off' oninput='numberWithCommas(this)'>
            </div>
        </div>
        <div class='row'>
            <div class='col-25'>
                <label for='phonenumber'>Name of the Judgement Debtor</label>
            </div>
            <div class='col-75'>
                <input type='text' class='input1' id='phone' name='input8' value='' autocomplete='off'>
            </div>
        </div>
        <div class='row'>
        <div class='col-25'>
          <label for='author'>Please select address type</label>
        </div>
        <div class='col-75'>
          <select id='author' class='input6' name='input9'>
            <option value='currently residing at'>Residential Address</option>
            <option value='currently employed at'>Employement Address</option>
            <option value='with its principal place of business situated at'>Principal place of business</option>
            <option value='with its registered address situated at'>Registered Address</option>
            <option value='other'>Other</option>
          </select>
        </div>
        </div>
        <div class='row'>
            <div class='col-25'>
                <label for='theirref'>Judgement Debtor's address</label>
            </div>
            <div class='col-75'>
                <input type='text' class='input1' id='theirref' name='input10' value='' autocomplete='off'>
            </div>
        </div>
        <input type='hidden' id='inputField2'>
        
        <div class='row'>
            <input type='submit' class='inputcontacts' value='Submit&nbsp&nbsp❯' name='register' id='register' tabindex='3' onclick='calculateCI()' />

        </div>
    </form>
</div>

</div><style>.col-75 {
    float: left;
    width: 50%;
    margin-top: 10px;
    margin-left: 60px;
}.input6 {left: 194px;
    top: 18px;}</style>";
    } else if (str_contains($name1, '- Code WI')) {
        echo "<div class='container'>
    <form action='../4_Pleadings/pleadings_create_5d.php' method='post'>
        <br><br>
        <div class='row'>
            <div class='col-25'>
            <label for='ref'>What is the Judgement Debt?</label>
            <span style='float: right; margin-right: 51px;'>R</span>
        </div>
            <div class='col-75'>
                <input type='text' class='input1' id='input1' name='input1' style='text-transform:capitalize' value='' min='0' value='0' step='.01' autofocus='on' required autocomplete='off' oninput='numberWithCommas(this)'>
           
                </div>
        </div>
        <div class='row'>
            <div class='col-25'>
                <label for='name'>How much has been paid to date?</label>
                <span style='float: right; margin-right: 51px;'>R</span>
            </div>
            <div class='col-75'>
                <input type='text' class='input1' id='input2' name='input2' style='text-transform:capitalize' value='0' min='0' value='0' step='.01' autocomplete='off' oninput='numberWithCommas(this)'>
            </div>
        </div>
        <div class='row'>
            <div class='col-25'>
                <label for='phonenumber'>Name of the Judgement Debtor</label>
            </div>
            <div class='col-75'>
                <input type='text' class='input1' id='phone' name='input8' value='' autocomplete='off'>
            </div>
        </div>
        
        <div class='row'>
        <div class='col-25'>
            <label for='author'>Please select address type</label>
        </div>
        <div class='col-75'>
            <select id='author' class='input6' name='input9'>
                <option value='currently residing at'>Residential Address</option>
                <option value='currently employed at'>Employement Address</option>
                <option value='with its principal place of business situated at'>Principal place of business</option>
                <option value='with its registered address situated at'>Registered Address</option>
                <option value='other'>Other</option>
            </select>
        </div>
    </div>
        
        <div class='row'>
            <div class='col-25'>
                <label for='theirref'>Judgement Debtor's address</label>
            </div>
            <div class='col-75'>
                <input type='text' class='input1' id='theirref' name='input10' value='' autocomplete='off'>
            </div>
        </div>
        <div class='row'>
            <div class='col-25'>
                <label for='theirref'>Rate</label>
                <span style='float: right; color:white; margin-right: -302px;'>%</span>
            </div>
            <div class='col-75'>
                <input type='text' class='input1' id='rate' value='' name='rate' max='100' autocomplete='off'>
                
            </div>
            
        </div>
        
        <div class='row'>
            <div class='col-25'>
                <label for='theirref'>Time (in years)</label>
            </div>
            <div class='col-75'>
                <input type='text' class='input1' id='time' value='' autocomplete='off'>
            </div>
        </div>
        <input type='hidden' id='inputField2'>
        <input type='hidden' id='interest' name='interest' readonly />
        <div class='row'>
            <input type='submit' class='inputcontacts' value='Submit&nbsp&nbsp❯' name='register' id='register' tabindex='3' onclick='calculateCI()' />

        </div>
    </form>
</div>

</div><style>.col-75 {
    float: left;
    width: 50%;
    margin-top: 10px;
    margin-left: 60px;
}
.input6 {left: 194px;
    top: 18px;}</style>";
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../9_Style/style.css">
        <title>Generate Pleading</title>
    </head>

    <body>
        <script>
            const inputField1 = document.querySelector("#input1");
            const inputField3 = document.querySelector("#input2");
            const inputField2 = document.querySelector("#inputField2");

            inputField1.addEventListener("keyup", formatInputField);
            inputField3.addEventListener("keyup", formatInputField);

            function formatInputField(event) {
                let inputValue = event.target.value;
                inputValue = inputValue.replace(/[^\d.]/g, ""); // remove non-numeric characters
                inputValue = inputValue.replace(/^0+/, ""); // remove leading zeros

                inputValue = inputValue.replace(/^\./, "0."); // add leading zero if necessary

                const parts = inputValue.split(".");
                inputValue = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                if (parts.length > 1) {
                    inputValue += "." + parts[1];
                }

                event.target.value = inputValue;
                inputField2.value = inputValue.replace(/,/g, ""); // store the original value without a comma
            };

            function calculateCI() {
                var principal = document.getElementById("inputField2").value;
                var rate = document.getElementById("rate").value;
                var time = document.getElementById("time").value;

                var interest = principal * (1 + (rate / 100)) ** time - principal;
                document.getElementById("interest").value = interest.toFixed(2);
            }
        </script>
    </body>

    </html>