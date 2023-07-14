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
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Correspondence</title>
</head>

<body style="background-color: black">
  <nav>
    <div class="heading1">
      <h4>AutoLegal</h4>
    </div>
    <ul class="nav-linker">
      <li><a class="nav-link" href="../1_Home/Index.php">Home</a></li>
      <li><a class="nav-link active" href="../2_New_file/Index.php">New&nbspFile</a></li>
      <li><a class="nav-link" href="../3_Correspondence/Index.php">Correspondence</a></li>
      <li><a class="nav-link" href="../4_Pleadings/Index.php">Pleadings</a></li>
      <li><a class="nav-link" href="../5_Contacts/Index.php">Contacts</a></li>
      <li><a class="nav-link" href="../6_Legislation/Index.php">Legislation</a></li>
      <li><a class="nav-link" href="../7_Edit/Index.php">Edit</a></li>
      <li><a class="nav-link" id="plus" href="../8_Extras/Index.php">+</a></li>
    </ul>
  </nav>
  <div class="container">
    <form action="../2_New_file/New_file_correspondence/new_file_correspondence_database.php" id="myForm" method="post">
      <div class="row">
        <div class="formlabel">
          <label for="cname">&nbspRecipient:</label>
        </div>
        <div class="forminput">
          <input type="text" class="input1" id="recipient" style="text-transform:capitalize" name="recipient" value="" autofocus="on" autocomplete="off">
        </div>
      </div>
      <div class="row">
        <div class="formlabel">
          <label for="remail">*Their email address:</label>
        </div>
        <div class="forminput">
          <input type="text" class="input1" id="email" name="email" value="" required autocomplete="off">
        </div>
      </div>
      <div class="row">
        <div class="formlabel">
          <label for="rrnumber">&nbspTheir reference number:</label>
        </div>
        <div class="forminput">
          <input type="text" class="input1" id="theirref" name="theirref" value="" autocomplete="off">
        </div>
      </div>
      <div class="row">
        <div class="formlabel">
          <label for="ornumber">*Our reference number:</label>
        </div>
        <div class="forminput">
          <input type="text" class="input1" id="ref" style="text-transform:capitalize" name="ref" value="" required autocomplete="off">
        </div>
      </div>
      <div class="row">
        <div class="formlabel">
          <label for="cperson">&nbsp*Contact person:</label>
        </div>
        <div class="forminput">
          <input type="text" class="input1" id="contact" style="text-transform:capitalize" name="contact" value="" required autocomplete="off">
        </div>
      </div>
      <div class="row">
        <div class="formlabel">
          <label for="sline">&nbspSubject line:</label>
        </div>
        <div class="forminput">
          <input type="text" class="input1" id="subject" style="text-transform:uppercase" name="subject" value="" autocomplete="off">
        </div>
      </div>
      <div class="row">
        <div class="formlabel">
          <label for="saveLocation">&nbspSave location:</label>
        </div>
        <div class="forminput">
          <select id="saveLocation" name="saveLocation" required>
            <option value="">Please select</option>
            <option value="folder">Document to be saved in a chosen folder</option>
            <option value="prompt">Prompt me for a save location</option>
          </select>
          <div id="folderOption" style="display:none;">
            <input type="file" id="fileInput" webkitdirectory directory />
            <br>
            <button id="selectFile">Select File</button>
          </div>
          <div id="promptOption">
            <p id="option">You have selected the option to be prompted</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="row">
          <div class="formlabel">
            <label for="eparagraph">&nbspHow to end the letter?</label>
          </div>
          <div class="forminput">
            <select id="eparagraph" name="eparagraph" class="dropdowngeneratorc">
              <option value="Yours sincerely">Yours sincerely</option>
              <option value="Yours faithfully">Yours faithfully</option>
            </select>
          </div>
        </div>
        <div class="formlabel">
          <label for="author">&nbspAuthor of the letter:</label>
        </div>
        <div class="forminput">
          <select id="author" name="author" class="dropdowngeneratorc">
            <option value="">Please Select</option>
            <option value="Lloyd">Lloyd</option>
            <option value="Lynettel">Lucas</option>
            <option value="Nontsha">Nontsha</option>
            <option value="Stefan">Stefan</option>
          </select>
        </div>
      </div>
      <div class="row">
        <input type="submit" class="generatorc" id="btngeneratorc1" value="Submit &nbsp❯" name="register" tabindex="3" />
      </div>
  </div>
  <div>
    <label class="folderPath-label" id="folderPath-label">Selected folder Path:</label>
    <a class="btngeneratorc" id="btngeneratorc" tabindex="1" href="../2_New_file/Index.php">❮&nbsp&nbsp&nbspBack</a>
  </div>
  </div>
  <div class="tooltip">
    <i class="fas fa-info-circle"></i>
    <span class="tooltiptext">The first option will save the file in the selected folder everytime.<br><br>
      The second option will prompt you to select a folder to save the file everytime you create a new letter.</span>
  </div>
  <input type="hidden" id="folderPath" name="path1" value="" readonly />
  <input type="hidden" id="saveLocation" value="1">
  </div>
  </div>
  </form>
  <div id="message"></div>
</body>

</html>
<style>
  body {
    overflow: hidden;
  }

  .tooltip {
    top: -195px;
  }

  .message {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 999;
  }

  body {
    background-color: black;
    overflow: hidden;
  }

  #message {
    color: white;
    font-weight: bold;
    text-align: center;
    position: absolute;
    left: 50%;
    transform: translate(-50%, 50%);
    width: 98%;
    top: -54px;
  }

  .info,
  .success,
  .warning,
  .error,
  .validation {
    display: flex;
    border: 1px solid;
    margin: 18px 0px;
    padding: 3px 20px 15px 55px;
    background-repeat: no-repeat;
    background-position: 10px 12px;
    top: -8%;
  }

  #folderPath-label {
    position: absolute;
    right: 876px;
    bottom: 199px;
    color: white;
    display: none;
    font-weight: bold;
    font-family: "Montserrat", sans-serif;
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

  $(document).ready(function() {
    $("#myForm").submit(function(event) {
      event.preventDefault(); // Prevent the form from submitting normally
      var formData = $(this).serialize(); // Serialize the form data
      $.ajax({
        url: "../2_New_file/New_file_correspondence/new_file_correspondence_check.php",
        type: "POST",
        data: formData,
        success: function(response) {
          if (response == "success") {
            // Redirect to the next php page
            window.location.href = "../2_New_file/New_file_correspondence/new_file_correspondence_database.php";
          } else {
            // Display an error message
            $("#message").html("  <span class='error'><br>This file already exists - Please try again.</span>");
            // Hide the message after 2 seconds
            setTimeout(function() {
              $("#message").html("");
            }, 4000);
          }
        }
      });
    });
  });
</script>
</body>

</html>