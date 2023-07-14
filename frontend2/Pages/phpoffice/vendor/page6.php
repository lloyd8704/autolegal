<?php


$_SESSION['reference'] = $_POST['reference'];
$name1 = $_SESSION['Pleadings'];
if (str_contains($name1, '- Code P0')) {
    echo "<div class='container'>
    <form action='../vendor/index4.1.php' method='post'>
        <br><br>
        <div class='row'>
            <div class='col-25'>
                <label for='ref'>On whom do you want <br>to serve the document?</label>
            </div>
            <div class='col-75'>
                <input type='text' class='input1' id='ref' name='input1' style='text-transform:capitalize' value='' autofocus='on' required autocomplete='off'>
            </div>
        </div> <div class='row'>
        <input type='submit' class='inputcontacts' value='Submit&nbsp&nbsp❯' name='register' tabindex='3' />
    </div>
</form>
</div>
<div>
<a class='btncontactscreate' tabindex='1' href='../../../messaround4.php'>❮&nbsp&nbsp&nbspBack</a>
</div>
</div>";
} else if (str_contains($name1, '- Code PA')) {
    echo "<div class='container'>
    <form action='../vendor/index4.2.php' method='post'>
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
            <input type='submit' class='inputcontacts' value='Submit&nbsp&nbsp❯' name='register' tabindex='3' />

        </div>
    </form>
</div>
<div>
    <a class='btncontactscreate' tabindex='1' href='../../../messaround4.php'>❮&nbsp&nbsp&nbspBack</a>
</div>
</div>";
} else if (str_contains($name1, '- Code A')) {
    echo "<div class='container'>
    <form action='../vendor/index4.3.php' method='post'>
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
            <input type='submit' class='inputcontacts' value='Submit&nbsp&nbsp❯' name='register' tabindex='3' />

        </div>
    </form>
</div>
<div>
    <a class='btncontactscreate' tabindex='1' href='../../../messaround4.php'>❮&nbsp&nbsp&nbspBack</a>
</div>
</div>";
} else if (str_contains($name1, '- Code W0')) {
    echo "
    <form class='container' action='../vendor/index4.4.php' method='post'>
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
            <option value='with its registered address situated at'>Registered AddressD</option>
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
            <input type='submit' class='inputcontacts' id='warrantsubmit' value='Submit&nbsp&nbsp❯' name='register' tabindex='3' onclick='calculateCI()' />

        </div>
    </form>
</div>
<div>
    <a class='btncontactscreate' id='warrantback' tabindex='1' href='../../../messaround4.php'>❮&nbsp&nbsp&nbspBack</a>
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
    <form action='../vendor/index4.4.php' method='post'>
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
                <input type='text' class='input1' id='input2' name='input2' style='text-transform:capitalize' value='' min='0' value='0' step='.01' autocomplete='off' oninput='numberWithCommas(this)'>
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
            <input type='submit' id='warrantsubmit' class='inputcontacts' value='Submit&nbsp&nbsp❯' name='register' tabindex='3' onclick='calculateCI()' />

        </div>
    </form>
</div>
<div>
    <a class='btncontactscreate' id='warrantback' tabindex='1' href='../../../messaround4.php'>❮&nbsp&nbsp&nbspBack</a>
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
/*   <form>
      <div>
        <label for="principal">Principal:</label>
        <input type="text" id="principal" required />
      </div>
      <div>
        <label for="rate">Rate:</label>
        <input type="text" id="rate" required />
      </div>
      <div>
        <label for="time">Time (in years):</label>
        <input type="text" id="time" required />
      </div>
      <div>
        <input type="button" value="Calculate" onclick="calculateCI()" />
      </div>
      <div>
        <label for="interest">Interest:</label>
        <input type="text" id="interest" readonly />
      </div>
    </form>
  </body>
</html>*/

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../app.css">
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