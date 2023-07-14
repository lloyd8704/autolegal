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
  <link rel="stylesheet" href="../9_Style/style.css">
  <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
  <title>Edit Correspondence</title>
</head>

<body style="background-color: black">
  <nav>
    <div class="heading1">
      <h4>AutoLegal</h4>
    </div>
    <ul class="nav-linker">
      <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
      <li><a class="nav-link" href="../2_New_file/Index.php">New&nbspFile</a></li>
      <li><a class="nav-link" href="../3_Correspondence/Index.php">Correspondence</a></li>
      <li><a class="nav-link" href="../4_Pleadings/Index.php">Pleadings</a></li>
      <li><a class="nav-link" href="../5_Contacts/Index.php">Contacts</a></li>
      <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
      <li><a class="nav-link active" href="../7_Edit/Index.php">Edit</a></li>
      <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
    </ul>
  </nav>
  </style>
  </head>
  <style>
    .heading4 {
      color: white;

      font-family: "Montserrat", sans-serif;
      letter-spacing: 0px;
      font-size: 23px;
      text-align: center;
      margin: 0px;
    }
  </style>
  <?php
  //connect to db
  require_once '../10_Database/connection.php';

  //$_POST["reference"];
  $test = $_POST['reference'];
  $query = "SELECT * FROM `correspondence` WHERE test='$test'";


  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

      $ref = $row['ref'];
      $email = $row["email"];
      $subject = $row["subject"];
      $contact = $row["contact"];
      $theirref = $row["theirref"];
      $recipient = $row["recipient"];
      $author = $row['author'];
      $path = $row['number'];
      $eparagraph = $row['eparagraph'];
      $reference = $row['test'];

      echo "<div class='container'>
      <form action='../7_Edit/edit_correspondence_4.php' method='post'>
      <div class='row'>
        <div class='col-25'>
            <label for='cname'>&nbspRecipient:</label>
        </div>
          <div class='col-75'>
            <input type='text' class='input1' id='recipient' style='text-transform:capitalize' name='recipient' value='$recipient' 
            autofocus='on' autocomplete='off'>
        </div>
        </div>
        <div class='row'>
          <div class='col-25'>
            <label for='remail'>*Their email address:</label>
          </div>
          <div class='col-75'>
            <input type='text' class='input1' id='email' name='email' value='$email' required autocomplete='off'>
          </div>
        </div>
        <div class='row'>
          <div class='col-25'>
            <label for='rrnumber'>&nbspTheir reference number:</label>
          </div>
          <div class='col-75'>
            <input type='text' class='input1' id='theirref' name='theirref' value='$theirref' autocomplete='off'>
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
            <input type='text' class='input1' id='contact' style='text-transform:capitalize' name='contact' value='$contact' 
            required autocomplete='off'>
          </div>
        </div>

        <div class='row'>
          <div class='col-25'>
            <label for='sline'>&nbspSubject line:</label>
          </div>
          <div class='col-75'>
            <input type='text' class='input1' id='subject' style='text-transform:uppercase' name='subject' value='$subject' 
            autocomplete='off'>
          </div>
          </div>
          <div class='row'>
            <div class='col-25'>
              <label for='saveLocation'>&nbspSave location:</label>
            </div>
            <div class='col-75'>
              <select id='saveLocation' name='saveLocation'>
                <option value=''>Only select if you want to edit save location</option>
                <option value='folder'>Document to be saved in a chosen folder</option>
                <option value='prompt'>Prompt me for a save location</option>
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
              <option value='$eparagraph'>Saved as: '$eparagraph'</option>
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
          <option value='$author'>Saved as: '$author'</option>
          <option value='Lloyd'>Lloyd</option>
            <option value='author b'>Attorney B</option>
            <option value='author c'>Attorney C</option>
            <option value='author d'>Attorney D</option>
            <option value='author e'>Attorney E</option>
                      </select>
        </div>
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
<div class='col-75'>
<input name='reference' type='hidden' id='reference' value='$reference'/>
</div>
</div>
<input type='submit' class='btncorrespondenceedit3' name='register' value='Submit'></div>
</form>
</div>
</form>";
    }
  }
  ?>
  <style>
    .btncorrespondenceedit3 {
      background-color: black;
      color: white;
      font-weight: bold;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      border: 2px solid white;
      cursor: pointer;
      position: relative;
      top: 20px;
      left: -40px;
    }

    .btncorrespondenceedit3:hover {
      background-color: white;
      color: black;
      border: 2px solid black;

    }

    .dropdowncorrespondenceedit3 {
      width: 50%;
      padding-top: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      resize: none;
      color: black;
      font-family: 'Montserrat', sans-serif;
      font-weight: bold;
      position: relative;
      left: 194px;
      top: 19px;
    }

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
      font-family: "Montserrat", sans-serif;
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