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
  <title>Pleadings</title>
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
  </head>

  <body>
    <div class="container">
      <form action="../2_New_file/New_file_pleading/new_file_pleading_database_2.php" id="myForm" method="post">
        <div class="row">
          <div class="formlabel">
            <label for="reference">*Reference number:</label>
          </div>
          <div class="forminput">
            <input type="text" class="input1" id="reference" style="text-transform:capitalize" name="reference" value="" autofocus="on" required autocomplete="off">
          </div>
        </div>
        <div class="row">
          <div class="formlabel">
            <label for="represent">&nbspWho do we represent:</label>
          </div>
          <div class="forminput">
            <input type="text" class="input1" id="represent" style="text-transform:capitalize" placeholder="e.g. Plaintiff " name="represent" value="" autofocus="on" autocomplete="off">
          </div>
        </div>
        <div class="row">
          <div class="formlabel">
            <label for="casenumber">&nbspCase number:</label>
          </div>
          <div class="forminput">
            <input type="text" class="input1" id="casenumber" name="casenumber" value="" autocomplete="off">
          </div>
        </div>
        <div class="row">
          <div class="formlabel">
            <label for="location">&nbspPlace of signature:</label>
          </div>
          <div class="forminput">
            <input type="text" style="text-transform:uppercase" class="input1" id="input2" name="location" value="" placeholder="e.g. cape town" autocomplete="off">
          </div>
        </div>
        <div class="row">
          <div class="formlabel">
            <label for="author">&nbspWhose file is this:</label>
          </div>
          <div class="forminput">
            <select id="author" name="author">
              <option value="">Please Select</option>
              <option value="lloyd">Lloyd</option>
              <option value="lynettel">Lucas</option>
              <option value="nontsha">Nontsha</option>
              <option value="stefan">Stefan</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="formlabel">
            <label for="author">&nbspOur details:</label>
          </div>
          <div class="forminput">
            <textarea id="ourdetails" class="forminput" name="ourdetails" rows="7" cols="40"></textarea>
          </div>
        </div>
        <div class="test">
          <div class="col-55">
            <label id="whichcourt" for="selection">Which court:</label>
          </div>
          <div class="container">
            <select id="courts" class="p1" onchange="enablecourts(this)" name="courts" required>
              <option value="">Please select</option>
              <option value="1">Magistrate's Court</option>
              <option value="2">Regional Court</option>
              <option value="3">High Court</option>
              <option value="4">Other High Court</option>
              <option value="5">Other Court</option>
            </select>
          </div>
          <div class="test">
          </div>
          <div class="test">
            <div id="selection" class="d-none1">
              <div class="col-55">
                <label class="d-none1" for="selection">Awaiting Selection:</label>
              </div>
              <div class="col-85">
                <input type="text" class="col-85" id="input2" name="selection" disabled>
              </div>
            </div>
          </div>
          <div class="test">
            <div id="mc" class="d-none">
              <div class="col-55">
                <label for="mc">For the District of:</label>
              </div>
              <div class="col-85">
                <input type="text" class="col-85" id="input2" name="mc" value="" autocomplete="off" style="text-transform:uppercase">
              </div>
            </div>
          </div>
          <div class="test">
            <div id="mcone" class="d-none">
              <div class="fieldlable">
                <label for="mcone">Held At:</label>
              </div>
              <div class="field2input">
                <input type="text" class="field2input" id="input2" name="mcone" value="" autocomplete="off" style="text-transform:uppercase">
              </div>
            </div>
          </div>
          <div class="test">
            <div id="rc" class="d-none">
              <div class="col-55">
                <label for="rc">Regional Division of:</label>
              </div>
              <div class="col-85">
                <input type="text" class="col-85" id="input2" name="rc" value="" autocomplete="off" style="text-transform:uppercase">
              </div>
            </div>
          </div>
          <div class="test">
            <div id="otherhc" class="d-none">
              <div class="col-55">
                <label for="otherhc">Name of other Court:</label>
              </div>
              <div class="col-85">
                <input type="text" class="col-85" id="input2" name="otherhc" value="" autocomplete="off" style="text-transform:uppercase">
              </div>
            </div>
          </div>
          <div class="test">
            <div id="other" class="d-none">
              <div class="col-55">
                <label for="other">Name of other Court:</label>
              </div>
              <div class="col-85">
                <input type="text" class="col-85" id="input2" name="other" value="" autocomplete="off" style="text-transform:uppercase">
              </div>
            </div>
          </div>
          <div class="test">
            <div id="hc" class="d-none">
              <div class="col-55">
                <label for="hc">Which Division:</label>
              </div>
              <div class="col-85">
                <select id="highcourts" class="dropdownhc" name="highcourts">
                  <option value="(WESTERN CAPE DIVISION, CAPE TOWN)">WESTERN CAPE DIVISION, CAPE TOWN</option>
                  <option value="(EASTERN CAPE DIVISION, GRAHAMSTOWN)">EASTERN CAPE DIVISION, GRAHAMSTOWN</option>
                  <option value="(EASTERN CAPE DIVISION, MAKHANDA)">EASTERN CAPE DIVISION, MAKHANDA</option>
                  <option value="(EASTERN CAPE LOCAL DIVISION, BHISHO)">EASTERN CAPE LOCAL DIVISION, BHISHO</option>
                  <option value="(EASTERN CAPE LOCAL DIVISION, MTHATHA)">EASTERN CAPE LOCAL DIVISION, MTHATHA</option>
                  <option value="(EASTERN CAPE LOCAL DIVISION, PORT ELIZABETH)">EASTERN CAPE LOCAL DIVISION, PORT ELIZABETH</option>
                  <option value="(FREE STATE DIVISION, BLOEMFONTEIN)">FREE STATE DIVISION, BLOEMFONTEIN</option>
                  <option value="(GAUTENG DIVISION, PRETORIA)">GAUTENG DIVISION, PRETORIA</option>
                  <option value="(GAUTENG LOCAL DIVISION, JOHANNESBURG)">GAUTENG LOCAL DIVISION, JOHANNESBURG</option>
                  <option value="(KWAZULU-NATAL DIVISION, PIETERMARITZBURG)">KWAZULU-NATAL DIVISION, PIETERMARITZBURG</option>
                  <option value="(KWAZULU-NATAL LOCAL DIVISION, DURBAN)">KWAZULU-NATAL LOCAL DIVISION, DURBAN</option>
                  <option value="(LIMPOPO DIVISION, POLOKWANE)">LIMPOPO DIVISION, POLOKWANE</option>
                  <option value="(NORTHERN CAPE DIVISION, KIMBERLEY)">NORTHERN CAPE DIVISION, KIMBERLEY</option>
                  <option value="(NORTH WEST DIVISION, MAHIKENG)">NORTH WEST DIVISION, MAHIKENG</option>
                </select>
              </div>
            </div>
          </div>
        </div>
    </div>
    <script type="text/javascript">
      function enablecourts(answer) {
        console.log(answer.value);
        if (answer.value == "") {

          document.getElementById("selection").classList.remove('d-none');
          document.getElementById("mc").classList.add('d-none');
          document.getElementById("rc").classList.add('d-none');
          document.getElementById("mcone").classList.add('d-none');
          document.getElementById("hc").classList.add('d-none');
          document.getElementById("other").classList.add('d-none');
          document.getElementById("otherhc").classList.add('d-none');
          document.getElementById("highcourts").classList.add('d-none');

        }
        if (answer.value == "1") {
          document.getElementById("selection").classList.remove('d-none1');
          document.getElementById("selection").classList.add('d-none');
          document.getElementById("mc").classList.remove('d-none');
          document.getElementById("mcone").classList.remove('d-none');
          document.getElementById("rc").classList.add('d-none');
          document.getElementById("hc").classList.add('d-none');
          document.getElementById("other").classList.add('d-none');
          document.getElementById("otherhc").classList.add('d-none');
          document.getElementById("highcourts").classList.add('d-none');
        }
        if (answer.value == "2") {
          document.getElementById("selection").classList.remove('d-none1');
          document.getElementById("selection").classList.add('d-none');
          document.getElementById("mc").classList.add('d-none');
          document.getElementById("rc").classList.remove('d-none');
          document.getElementById("mcone").classList.remove('d-none');
          document.getElementById("hc").classList.add('d-none');
          document.getElementById("other").classList.add('d-none');
          document.getElementById("otherhc").classList.add('d-none');
          document.getElementById("highcourts").classList.add('d-none');

        }
        if (answer.value == "3") {
          document.getElementById("selection").classList.remove('d-none1');
          document.getElementById("selection").classList.add('d-none');
          document.getElementById("mc").classList.add('d-none');
          document.getElementById("mcone").classList.add('d-none');
          document.getElementById("rc").classList.add('d-none');
          document.getElementById("hc").classList.remove('d-none');
          document.getElementById("other").classList.add('d-none');
          document.getElementById("otherhc").classList.add('d-none');
          document.getElementById("highcourts").classList.remove('d-none');

        }

        if (answer.value == "4") {
          document.getElementById("selection").classList.remove('d-none1');
          document.getElementById("selection").classList.add('d-none');
          document.getElementById("mc").classList.add('d-none');
          document.getElementById("mcone").classList.add('d-none');
          document.getElementById("rc").classList.add('d-none');
          document.getElementById("hc").classList.add('d-none');
          document.getElementById("other").classList.add('d-none');
          document.getElementById("otherhc").classList.remove('d-none');
          document.getElementById("highcourts").classList.add('d-none');

        }

        if (answer.value == "5") {
          document.getElementById("selection").classList.remove('d-none1');
          document.getElementById("selection").classList.add('d-none');
          document.getElementById("mc").classList.add('d-none');
          document.getElementById("mcone").classList.add('d-none');
          document.getElementById("rc").classList.add('d-none');
          document.getElementById("hc").classList.add('d-none');
          document.getElementById("other").classList.remove('d-none');
          document.getElementById("otherhc").classList.add('d-none');
          document.getElementById("highcourts").classList.add('d-none');

        }

      };

      document.addEventListener("DOMContentLoaded", function() {
        var reference = document.getElementById("reference").value;
        var selectedAuthor = document.getElementById("author").value;
        var ourDetails = "43 Blaauwberg Road\nTABLE VIEW\n(Ref: " + reference + ")\nTel: 021 200 8445\nemail: " + selectedAuthor + "@solicitors.co.za";
        document.getElementById("ourdetails").value = ourDetails;
      });

      document.getElementById("reference").addEventListener("input", function() {
        var reference = this.value;
        var selectedAuthor = document.getElementById("author").value;
        var ourDetails = "43 Blaauwberg Road\nTABLE VIEW\n(Ref: " + reference + ")\nTel: 021 200 8445\nemail: " + selectedAuthor + "@solicitors.co.za";
        document.getElementById("ourdetails").value = ourDetails;
      });

      document.getElementById("author").addEventListener("change", function() {
        var reference = document.getElementById("reference").value;
        var selectedAuthor = this.value;
        var ourDetails = "43 Blaauwberg Road\nTABLE VIEW\n(Ref: " + reference + ")\nTel: 021 200 8445\nemail: " + selectedAuthor + "@solicitors.co.za";
        document.getElementById("ourdetails").value = ourDetails;
      });
      document.getElementById("reference").addEventListener("input", function() {
        var reference = this.value.toUpperCase();
        var selectedAuthor = document.getElementById("author").value;
        var ourDetails = "43 Blaauwberg Road\nTABLE VIEW\n(Ref: " + reference + ")\nTel: 021 200 8445\nemail: " + selectedAuthor + "@solicitors.co.za";
        document.getElementById("ourdetails").value = ourDetails;
      });
    </script><br>
    <div class="row">
      <input type="submit" class="pleadingspageonenext" value="Next &nbsp&nbsp&nbsp❯" name="register" tabindex="3" />

    </div>
    </form>
    </div>
    <div>
      <a class="pleadingspageoneback" tabindex="1" href="../2_New_file/Index.php">❮&nbsp&nbsp&nbspBack</a>
    </div>
    </div>
    <div class="tooltip">
      <i class="fas fa-info-circle"></i>
      <span class="tooltiptext">Once submitted, your firm's name and the party you represent will be automatically included.</span>
    </div>
    <script>
      function myFunction() {
        var x = document.getElementById("court").required;
        document.getElementById("demo").innerHTML = x;
      }

      function myFunction() {
        var x = document.getElementById("court").required;
        document.getElementById("demo").innerHTML = x;
      }
      setTimeout(function() {
        document.querySelector('#error').style.display = 'none';
        document.querySelector('#success').style.display = 'none';
      }, 2000);
    </script>
    <style>
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
    </style>

    <div id="message"></div>
  </body>
  <script>
    $(document).ready(function() {
      $("#myForm").submit(function(event) {
        event.preventDefault(); // Prevent the form from submitting normally
        var formData = $(this).serialize(); // Serialize the form data
        $.ajax({
          url: "../2_New_file/New_file_pleading/new_file_pleadings_create_check.php",
          type: "POST",
          data: formData,
          success: function(response) {
            if (response == "success") {
              // Redirect to the next php page
              window.location.href = "../2_New_file/New_file_pleading/new_file_pleading_database_2.php";
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

</html>