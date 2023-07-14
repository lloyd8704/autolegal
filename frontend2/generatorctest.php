<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="app.css">
  <title>Correspondence</title>
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
      </ul>
    </navi>
    </style>
    </head>

    <?php
    session_start();
    $ref = $_SESSION['ref'];
    $subject = $_SESSION['subject'];



    echo "
   
       <div class='container'>
        <form action='../frontend2/Pages/user/register1.php' method='post'>
         <div class='row'>
        <div class='col-25'>
            <label for='cname'>&nbspRecipient:</label>
        </div>
          <div class='col-75'>
            <input type='text' class='input1' id='recipient' style='text-transform:capitalize' name='recipient' value='' autofocus='on' autocomplete='off'>
        </div>
        </div>
        <div class='row'>
          <div class='col-25'>
            <label for='remail'>*Their email address:</label>
          </div>
          <div class='col-75'>
            <input type='text' class='input1' id='email' name='email' value='' required autocomplete='off'>
          </div>
        </div>
        <div class='row'>
          <div class='col-25'>
            <label for='rrnumber'>&nbspTheir reference number:</label>
          </div>
          <div class='col-75'>
            <input type='text' class='input1' id='theirref' name='theirref' value='' autocomplete='off'>
          </div>
        </div>
        <div class='row'>
          <div class='col-25'>
            <label for='ornumber'>*Our refence number:</label>
          </div>
          <div class='col-75'>
            <input type='text' class='input1' id='ref' name='ref' value='$ref' required autocomplete='off'>
          </div>
        </div>
       
       <div class='row'>
          <div class='col-25'>
            <label for='cperson'>&nbsp*Contact person:</label>
          </div>
          <div class='col-75'>
            <input type='text' class='input1' id='contact' style='text-transform:capitalize' name='contact' value='' required autocomplete='off'>
          </div>
        </div>
        <div class='row'>
          <div class='col-25'>
            <label for='sline'>&nbspSubject line:</label>
          </div>
          <div class='col-75'>
            <input type='text' class='input1' id='subject' style='text-transform:uppercase' name='subject' value='$subject' autocomplete='off'>
          </div>
          </div>
          <div class='row'>
            <div class='col-25'>
              <label for='saveLocation'>&nbspSave location:</label>
            </div>
            <div class='col-75'>
              <select id='saveLocation' name='saveLocation' required>
                <option value=''>Please select</option>
                <option value='folder'>Save the document in a chosen folder</option>
                <option value='prompt'>Prompt me every time for a save location</option>
              </select>
              <div id='folderOption' style='display:none;'>
                <input type='file' id='fileInput' webkitdirectory directory />
                
                <br>
                <button id='selectFile'>Select File</button>
              </div>
              
              <div id='promptOption'>
                <p id='option'>You have selected the option to be prompted</p>
              </div>
              
            </div>
          </div>
          <div class='row'>
          <div class='row'>

           <div class='col-25'>
            <label for='eparagraph'>&nbspHow to end the letter?</label>
          </div>
          <div class='col-75'>
              <select id='eparagraph' name='eparagraph' class='dropdowngeneratorc'>
              <option value='Yours sincerely' >Yours sincerely</option>
              <option value='Yours faithfully'>Yours faithfully</option>
            </select>
          </div>
        </div>
        <div class='col-25'>
          <label for='author'>&nbspAuthor of the letter:</label>
        </div>
        <div class='col-75'>
          <select id='author' name='author' class='dropdowngeneratorc'>
            <option value='Lloyd'>Lloyd</option>
            <option value='author b'>Attorney B</option>
            <option value='author c'>Attorney C</option>
            <option value='author d'>Attorney D</option>
            <option value='author e'>Attorney E</option>
                      </select>
        </div>
      </div>
      
        <div class='row'>
          <input type='submit' class='generatorc' id='btngeneratorc1' value='Submit &nbsp❯' name='register'  tabindex='3'/>
         
          </div>
        
      </div>
      <div>
        <label class='folderPath-label'>Selected folder Path:</label>
        <a class='btngeneratorc' id='btngeneratorc' tabindex='1' href='../frontend2/Pages/newfile.html'>❮&nbsp&nbsp&nbspBack</a>
      </div> 
    </div>
    <div class='tooltip'>?
      <span class='tooltiptext'>The first option will save the file in the selected folder everytime.<br><br>
      The second option will prompt you to select a folder to save the file everytime you create a new letter.</span>
    <div>
      <input type='hidden' id='folderPath' name='path1' value='' readonly />
      <input type='hidden' id='saveLocation' value='1'>
    </div>
   
    </div>
  </form>"
    ?>
  </body>

</html>

<style>
  #btngeneratorc {
    top: -16px;
  }

  #btngeneratorc1 {
    top: 38px;
  }

  #folderPath {
    background-color: white;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    display: none;
    height: 33px;
    width: 327px;
    padding: 0px 13px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    color: black;
    font-family: 'Montserrat', sans-serif;
    font-weight: bold;
    font-size: small;
    position: absolute;
    right: -340px;
    bottom: -12px;
  }

  #promptOption {
    background-color: green;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid black;
    display: none;
    width: 50%;
    height: 38px;
    padding: 0px 13px;

    border-radius: 4px;
    resize: vertical;
    color: black;
    font-family: "Montserrat", sans-serif;
    font-weight: bold;
    font-size: small;
    position: relative;
    left: 194px;
    top: 22px;
    margin-bottom: 5px;
    margin-top: 5px;
  }

  .dropdowngeneratorc {
    width: 50%;
    padding-top: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: none;
    color: black;
    font-family: "Montserrat", sans-serif;
    font-weight: bold;
    position: relative;
    left: 194px;
    top: 18px;
  }

  #saveLocation {
    top: 16px;
    cursor: pointer;
  }

  #saveLocation:hover {
    background: black;
    color: white;
  }

  .folderPath-label {
    position: absolute;
    right: 300px;
    bottom: 233px;
    color: white;
    display: none;
    font-weight: bold;
    font-family: "Montserrat", sans-serif;
  }


  .tooltip {
    position: relative;
    display: inline-block;
    color: white;
    cursor: default;
    left: 880px;
    top: -198px;
    font-weight: 1000;
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

  body {
    overflow: hidden;
  }
</style>



<script>
  const saveLocation = document.getElementById("saveLocation");
  const folderOption = document.getElementById("folderOption");
  const promptOption = document.getElementById("promptOption");
  const input = document.getElementById("fileInput");
  const selectFileButton = document.getElementById("selectFile");
  const folderPath = document.getElementById("folderPath");
  const folderPathLabel = document.querySelector(".folderPath-label");

  saveLocation.addEventListener("change", function() {
    if (this.value === "folder") {
      folderOption.style.display = "block";
      promptOption.style.display = "none";
      folderPath.value = "";
    } else if (this.value === "prompt") {
      folderOption.style.display = "none";
      promptOption.style.display = "block";
      folderPath.value = "";

    } else if (this.value === "1") {
      folderOption.style.display = "none";
      promptOption.style.display = "none";
      folderPath.value = "";
    }

    // Reset file input and related elements
    input.value = null;
    selectFileButton.style.backgroundColor = "";
    selectFileButton.innerHTML = "Select File";
    selectFileButton.style.color = "";
    selectFileButton.style.border = "";
    folderPath.classList.add("success");
    folderPath.type = "hidden";
    folderPath.style.display = "none";
    folderPathLabel.style.display = "none";
  });

  selectFileButton.addEventListener("click", function(event) {
    input.click();
    event.preventDefault();
  });

  input.addEventListener("change", function() {
    const filePath = input.files[0].webkitRelativePath;
    const pathElements = filePath.split("/");
    const folderName = pathElements[0];
    folderPath.value = folderName;
    selectFileButton.style.backgroundColor = "green";
    selectFileButton.style.color = "black";
    selectFileButton.innerHTML = "Successfully Uploaded";
    selectFileButton.style.border = "1px solid black";
    folderPath.classList.remove("success");
    folderPath.type = "text";
    folderPath.style.display = "block";
    folderPathLabel.style.display = "block";

    selectFileButton.addEventListener("mouseover", function() {
      selectFileButton.style.color = "white";
      selectFileButton.style.border = "1px solid white";
    });

    selectFileButton.addEventListener("mouseout", function() {
      selectFileButton.style.color = "";
      selectFileButton.style.border = "";
    });
  });


  const selectElement = document.getElementById("saveLocation");
  selectElement.addEventListener("change", function() {
    const folderOption = document.getElementById("folderOption");
    const promptOption = document.getElementById("promptOption");
    const path1Input = document.querySelector('input[name="path1"]');

    if (this.value === "prompt") {
      folderOption.style.display = "none";
      promptOption.style.display = "block";
      path1Input.value = "";
    } else if (this.value === "folder") {
      folderOption.style.display = "block";
      promptOption.style.display = "none";
    } else if (this.value === "") {
      folderOption.style.display = "none";
      promptOption.style.display = "none";
      path1Input.value = "";
    }
  });
</script>