<?php
session_start();
$reference = $_SESSION['reference'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create AOL</title>
  <link rel="stylesheet" href="#">
  <link rel="icon" type="image/x-icon" href="../12_Icons/favicon.ico">
  <script src="https://kit.fontawesome.com/ee76321fd5.js"></script>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
  <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Aclonica' type='text/css' />
</head>

<body>
  <div class="container">
    <!--<img src="../11_Images/AI-LOGO.png" alt="Logo"> -->
    <div class="logo">SI</div><br>
    <h2>Add the number of inputs you require:</h2>
    <div class="tooltip">
      <i class="fas fa-info-circle"></i>
      <span class="tooltiptext">Click on the + icon to add as many rows as required.<br><br>
        Type '-' to make the amount a negative amount</span>
    </div>
    <form id="myForm" action="../16_insurance/create_aol_3.php" method="post">
      <div class="input-container">
        <div class="input-field-container">
          <label>Row 1:&nbsp;</label>
          <input class="inputField" type="text" name="input1" id="input1" placeholder="Description" autocomplete="off" style="text-transform: capitalize;" required>
          <label>R</label>
          <input class="inputField" type="text" name="amount1" id="amount1" placeholder="Amount" autocomplete="off" required><span class="add-icon" onclick="addInputField()"></span>
        </div>
        <div class="button-container">
          <input type="hidden" id="reference" name="reference" value="<?php echo $reference; ?>">
          <button type="submit">Create</button>
        </div>
      </div>
      <input type="hidden" name="numInputs" id="numInputs" value="1">
    </form>
  </div>
  <script>
    var form = document.querySelector('#myForm');
    var inputCount = 1;
    // function to add a new input field
    function addInputField() {
      inputCount++;
      var newInputContainer = document.createElement('div');
      newInputContainer.className = 'input-field-container';
      var newLabel = document.createElement('label1');
      if (inputCount < 10) {
        newLabel.textContent = 'Row ' + inputCount + '    :';
      } else {
        newLabel.textContent = 'Row ' + inputCount + ':';
      }
      var newInput = document.createElement('input');
      newInput.type = 'text';
      newInput.className = 'inputField1';
      newInput.name = 'input' + inputCount;
      newInput.id = 'input' + inputCount;
      newInput.style.textTransform = 'capitalize';
      newInput.setAttribute('autocomplete', 'off');
      var newAmount = document.createElement('input');
      newAmount.type = 'text';
      newAmount.className = 'inputField1';
      newAmount.name = 'amount' + inputCount;
      newAmount.id = 'amount' + inputCount;
      newAmount.setAttribute('autocomplete', 'off');
      var newRLabel = document.createElement('label1');
      newRLabel.textContent = 'R';
      newInputContainer.appendChild(newLabel);
      newInputContainer.appendChild(newInput);
      newInputContainer.appendChild(newRLabel);
      newInputContainer.appendChild(newAmount);
      newInputContainer.appendChild(document.createElement('br'));
      var container = document.querySelector('.input-container');
      container.insertBefore(newInputContainer, container.lastChild.previousSibling);
      document.querySelector('#numInputs').value = inputCount;

      addFormatEventListeners(); // call the function to add the format and border event listeners
    }

    function addFormatEventListeners() {
      // add the format event listener to all the amount input fields
      for (let i = 1; i <= inputCount; i++) {
        const inputField = document.querySelector("#amount" + i);
        inputField.addEventListener("keyup", formatInputField);
        inputField.addEventListener("keyup", function() {
          if (this.value.includes("-")) {
            this.style.borderColor = "red";
          } else {
            this.style.borderColor = "";
          }
        });
      }
    }

    addFormatEventListeners(); // call the function once to add the event listeners for the first input field

    function formatInputField(event) {
      let inputValue = event.target.value;
      inputValue = inputValue.replace(/[^\d.-]/g, ""); // remove non-numeric characters except '-' sign
      inputValue = inputValue.replace(/^0+/, ""); // remove leading zeros

      if (inputValue.indexOf(".") === 0) {
        inputValue = "0" + inputValue;
      }

      const parts = inputValue.split(".");
      inputValue = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      if (parts.length > 1) {
        inputValue += "." + parts[1]; // add decimal portion if it exists
      }

      event.target.value = inputValue;
      inputField2.value = inputValue.replace(/,/g, ""); // store the original value without a comma

    }
  </script>
  <style>
    .logo {
      background-color: #151A7B;
      border: 3px solid #C0C0C0;
      border-radius: 20px;
      color: white;
      cursor: default;
      cursor: pointer;
      font-family: Orbitron;
      font-size: 87px;
      font-weight: bold;
      height: 102px;
      padding: 10px;
      padding-top: 5px;
      text-align: center;
      text-decoration: wavy;
      width: 111px;
    }

    body {
      display: flex;
      justify-content: center;
      background-color: #f1f1f1;
      overflow: hidden;
    }

    .input-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      max-height: calc(100vh - 280px);
      overflow-y: auto;
      width: 110%;
      margin-left: -40px;

    }

    .input-field-container {
      display: flex;
      flex-direction: row;
      align-items: center;
      margin-bottom: 5px;
    }

    label {
      margin-right: 10px;
      font-family: Arial, sans-serif;

    }

    .add-icon {
      display: inline-block;
      width: 20px;
      height: 20px;
      margin-left: 10px;
      cursor: pointer;
      background-image: url(https://cdn4.iconfinder.com/data/icons/feather/24/plus-circle-512.png);
      background-size: cover;
    }

    button[type="submit"] {
      margin-left: 8px;
      width: 100%;
      max-width: 100px;
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #0062cc;
    }

    .button-container {
      display: inline-block;
      margin-left: 95px;
      margin-top: 20px;
      width: 200px;
      margin-bottom: 30px;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      width: 100%;
      height: 100vh;
      overflow: hidden;
      margin-top: 30px;
    }


    .heading {
      margin-top: 20px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;

    }

    .inputField {
      width: 200px;
      height: 30px;
      margin-left: -5px;
      margin-right: 13px;
      border-radius: 4px;
      padding-left: 10px;
    }

    .inputField1 {
      width: 200px;
      height: 30px;
      margin-left: -20px;
      margin-right: 29px;
      border-radius: 4px;
      padding-left: 10px;
    }

    label1 {
      margin-left: -15px;
      margin-right: 26px;
      font-family: Arial, sans-serif;
    }

    .tooltip {
      position: relative;
      display: inline-block;
      cursor: default;
      left: 290px;
      top: 30px;
      font-weight: 1000;
      cursor: pointer;
      font-size: 20px;
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
      margin-top: 16px;
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
  </style>
</body>

</html>