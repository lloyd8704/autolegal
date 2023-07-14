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
    <link rel="stylesheet" href="../../9_Style/style_new_pleading.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../12_Icons/favicon.ico">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Generate Pleading Database</title>
</head>
<style>
    #selectFile {

        position: relative;
        left: 500px;
        cursor: pointer;
        color: white;
        background-color: black;
        border: white solid 2px;
        width: 356px;
        height: 35px;
        font-weight: bold;
        font-size: 16px;
        border-radius: 4px;
        font-family: "Montserrat", sans-serif;

    }

    #selectFile:hover {
        color: black;
        background-color: white;

    }

    .button_container_pleading {
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        top: 40px;
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        margin: 10px;
        text-decoration: none;
        text-align: center;
        color: white;
        background-color: black;
        border: 2px solid white;
        border-radius: 4px;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .button:hover {
        color: black;
        background-color: white;
        cursor: pointer;
    }
</style>

<body>
    <nav>
        <div class="heading1">
            <h4>AutoLegal</h4>
        </div>
        <div class="heading1">
            <label1 id="fileprogress" for="file">Progress:</label1>
            <progress id="file" value="25" max="90"></progress>
        </div>
        <ul class="nav-linker">
        </ul>
    </nav><br><br>
    </div>
    <div id="container" class="container">
        <form action="../New_file_pleading/new_file_pleadings_database_3.php" method="post">
            <br>
            <div class="row">
                <div class="col-25">
                    <label for="saveLocation">&nbspSave location:</label>
                </div>
            </div>
            <div class="col-75">

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

    </div>
    <div>
        <label id="folderPath-label" class="folderPath-label">Selected folder Path:</label><br>
        <div class="button_container_pleading">
            <a class="button" href="../New_file_pleadings.php">❮&nbsp;&nbsp;&nbsp;Back</a>
            <input type="submit" class="button" value="Next&nbsp;&nbsp;❯" name="register" />
        </div>

    </div><br>

    </div>

    <div id="tooltip" class="tooltip">
        <i class="fas fa-info-circle"></i>
        <span class="tooltiptext">The first option will save the file in a selected folder.<br><br>
            The second option will request a new save location everytime a new pleading is created.</span>
    </div>
    <div>
        <input type="hidden" id="folderPath" name="path1" value="" readonly />
        <input type="hidden" id="saveLocation" value="1">
    </div>

    </form>
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
                input.style.display = "none";
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
            const folderName = filePath.substring(0, filePath.indexOf("/"));
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
</body>

</html>