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
    <link rel="stylesheet" href="../9_Style/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="../12_Icons/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Edit Correspondence</title>
</head>
<style>
    body {
        background-color: black;
        overflow: hidden;
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
        top: 30%;
        left: 53%;
        transform: translate(-50%, 50%);
    }

    #hexagons {
        margin-top: -111px;
    }

    #searchheading {
        left: 592px;
    }
</style>

<body>
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
    <br>

    <form action="../7_Edit/edit_correspondence_2.php" id="myForm" method="post">
        <label for="heading" id="searchheading" class="searchheading">Edit Correspondence:</label>
        <div class="searchlable">
            <label for="cname">Reference number:</label>
        </div>
        <div class="col-75">
            <input type="text" class="input4" id="reference" style="text-transform:capitalize" name="reference" value="" autofocus="on" required autocomplete='off'>
        </div>
        <div><br><br><br><br><br><br>
            <input type="submit" tabindex="2" class="inputcreate" value="Next&nbsp ❯">
        </div>
        <div>
            <a class="btnsearch" tabindex="1" href="../7_Edit/Index.php">❮&nbsp&nbspBack</a>
        </div>
        <img src="../11_Images/hex.png" class="hexagons" alt="Outline of three hexagons">
        <img src="../11_Images/hex2.png" class="hexagons2" alt="Outline of two hexagons">
    </form>
    <div id="message"></div>
    <script>
        $(document).ready(function() {
            $("#myForm").submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting normally
                var formData = $(this).serialize(); // Serialize the form data
                $.ajax({
                    url: "../7_Edit/edit_correspondence_check.php",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        if (response == "success") {
                            // Redirect to the next php page
                            window.location.href = "../7_Edit/edit_correspondence_2.php";
                        } else {
                            // Display an error message
                            $("#message").html("*There is no file with that reference - Please try again.");
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