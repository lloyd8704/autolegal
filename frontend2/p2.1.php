<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="app.css">
  <link rel="shortcut icon" type="image/x-icon" href="../frontend2/favicon.ico">
  <title>Generate Pleading Database</title>

</head>
<div id="test">
  <navi>
    <div class="heading1">
      <h4>AutoLegal</h4>
    </div>
    <div class="heading1">
      <label1 id="fileprogress" for="file">Progress:</label1>
      <progress id="file" value="25" max="90"></progress>

      <body style="background-color: black">


    </div>
    <ul class="nav-linker">
    </ul>
  </navi><br><br>
</div>
</head>

<body>
  <div id="container" class="container">
    <form action="../frontend2/p2.php" method="post">
      <div class="row">
        <div class="col-25">
          <br>
          <label for="saveLocation">&nbspSave location:</label>
        </div>
        <div class="col-75">
          <br>
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
      <br>
  </div>
  <div>
    <label id="folderPath-label" class="folderPath-label">Selected folder Path:</label>
    <a class="btngeneratorc" id="btngeneratorc" tabindex="1" href="../frontend2/Pages/newfile.html">❮&nbsp&nbsp&nbspBack</a>
    <input type="submit" class="generatorc" id="btngeneratorc1" value="Submit &nbsp❯" name="register" tabindex="3" />
  </div>

  </div>
  <div id="tooltip" class="tooltip">?
    <span class="tooltiptext">The first option will save the file in the selected folder everytime.<br><br>
      The second option will prompt you to select a folder to save the file everytime you create a new letter.</span>
  </div>
  <div>
    <input type="hidden" id="folderPath" name="path1" value="" readonly />
    <input type="hidden" id="saveLocation" value="1">
  </div>

  </div>
  </form>
</body>

</html>
<style>
  #fileprogress {
    position: relative;
    left: 385px;
    top: 11px;
  }

  #file {
    position: relative;
    left: 650px;
    top: -13px;
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
    width: 1365px;
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

  .heading2 {
    color: black;
    text-transform: uppercase;
    letter-spacing: 5px;
    font-size: 10px;

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
    margin-top: 20px;
    left: -30px;
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
    margin-left: 124px;
    width: 250px;
    height: 20px;
    position: relative;
    top: 11px
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
    color: white;
    font-family: "Montserrat", sans-serif;
    font-weight: bold;
    margin-top: 100px;
    margin-left: 250px;
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

  progress {
    color: white;
    background-color: black;
    background: purple;
    border: black;
    margin-left: 100px;
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

  #container {

    margin-top: 40px;
  }

  select option {
    padding: 10px;
  }

  #btngeneratorc {
    top: 20px;
  }

  #btngeneratorc1 {

    top: 20px;
    left: 600px;
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
    right: 488px;
    top: 243px
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
    padding-top: 18px;

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
    border-radius: 5px;
    border: 1px solid white;
  }



  #folderPath-label {
    color: white;
    display: none;
    font-weight: bold;
    font-family: "Montserrat", sans-serif;
    position: relative;
    bottom: 46px;
    left: 324px;
  }

  #tooltip {

    top: 155px;

  }

  .tooltip {
    position: absolute;
    display: inline-block;
    color: white;
    cursor: default;
    left: 885px;
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