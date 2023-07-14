<?php
session_start();

if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
  // Session does not exist or has expired, destroy session and redirect to login page
  session_destroy();
  header("Location: login.html");
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Create Letter</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="../16_insurance/style.css">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
  <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Aclonica' type='text/css' />
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-A8XQHx7vzKgUyV7EMiO6M+jV6w10b6jFDM6UZjxvbez9iDwhNNlJy+BtysVcGj8+t1WZ91AeZqlgSY4zv4B9jA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="../16_insurance/script.js"></script>
</head>

<body>
  <ul>
    <li><a href="../16_insurance/index.php">Home</a></li>
    <li><a href="view_claim_select.php">View</a></li>
    <li><a href="update_select.php">Update</a></li>
    <li><a href="send_email_select.php">Send</a></li>
    <li><a class="active" href="choice_of_letters.php">Draft</a></li>
    <li><a class="user" href="../16_insurance/logout_1.php">Welcome <?php echo ucfirst(strtolower($_SESSION['username'])); ?></a></li>
    <li>
      <a class="sign_out" href="../16_insurance/logout_2.php"><i class="fas fa-sign-out-alt"></i></a>
      <div class="tooltip">
        <p>Sign Out</p>
      </div>
    </li>
  </ul>
  <div class="container_reference">
    <div class="logo">SI</div><br>
    <form action="../16_insurance/create_letter_of_demand_2.php" method="post">

      <div class="checkbox-dropdown">
        - Please Select -
        <ul class="checkbox-dropdown-list">
          <li>
            <label>
              <input type="checkbox" value="attempted to cross a public intersection when it was unsafe, alternatively, inopportune to do so" name="option[]" /> Crossing intersection when usafe</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="attempted to exit a traffic circle from the incorrect lane of travel" name="option[]" /> Entered circle from incorrect lane</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="drove at a speed which was excessive in the prevailing circumstances" name="option[]" /> Excessive speed</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="entered a traffic circle when it was unsafe, alternatively, inopportune to do so" name="option[]" /> Entered circle when unsafe to do so</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="entered into a public road when it was unsafe, alternatively, inopportune to do so" name="option[]" /> Entered a public road when unsafe</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="entered into our client’s lane of travel" name="option[]" /> Entered client’s lane of travel</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="failed to apply your brakes timeously or at all" name="option[]" /> Failed to apply brakes timeously</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="failed to stop at a stop sign" name="option[]" /> Failed to stop at a stop sign</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="failed to stop at a traffic-controlled intersection" name="option[]" /> Failed to stop at intersection</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="failed to yield to our client’s right of way" name="option[]" /> Failed to yield</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="rear ended our client’s vehicle, which was stationary at the time" name="option[]" /> Rear ended stationery vehicle</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="rear ended our client’s vehicle" name="option[]" /> Rear ended</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="attempted to overtake our client’s vehicle when it was unsafe, alternatively, inopportune to do so" name="option[]" /> Overtook when unsafe</label>
          </li>
          <li>
            <label>
              <input type="checkbox" value="attempted to carry out a U-turn when it was unsafe, alternatively, inopportune to do so" name="option[]" /> Illegal U-turn</label>
          </li>
        </ul>
      </div>
      <br>
      <div class="form-group">
        <label id="instructionslable" for="instructions">Form of Negligence:</label>
        <textarea id="instructions" name="instructions" autocomplete="off"></textarea>
      </div>
      <div class="text-center">
      </div>
      <button type="submit" name="submit" class="button">Next</button>
    </form>
  </div>
  <script>
    $(document).on("click", function(event) {
      // Check if the clicked element is not part of the dropdown
      if (!$(event.target).closest(".checkbox-dropdown").length) {
        // If not, remove the "is-active" class from the dropdown
        $(".checkbox-dropdown").removeClass("is-active");
      }
    });

    $(document).on("click", function(event) {
      // Check if the clicked element is not part of the dropdown
      if (!$(event.target).closest(".checkbox-dropdown").length) {
        // If not, remove the "is-active" class from the dropdown
        $(".checkbox-dropdown").removeClass("is-active");
      }
    });

    $(".checkbox-dropdown").click(function() {
      $(this).toggleClass("is-active");
    });

    $(".checkbox-dropdown ul").click(function(e) {
      e.stopPropagation();
    });

    document.addEventListener("DOMContentLoaded", function() {
      var checkboxes = document.querySelectorAll("input[name='option[]']");
      var instructionsInput = document.getElementById("instructions");

      var instructions = "Our client is of the opinion that the collision was caused solely by your negligence in that you ...";
      instructionsInput.value = instructions;

      checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener("change", function() {
          var selectedRecipients = "";
          checkboxes.forEach(function(cb) {
            if (cb.checked) {
              selectedRecipients += cb.value + ", ";
            }
          });
          selectedRecipients = selectedRecipients.replace(/,\s*$/, ""); // remove trailing comma and space
          if (selectedRecipients) {
            selectedRecipients += ".";
          }
          var instructions = "Our client is of the opinion that the collision was caused solely by your negligence in that you " + selectedRecipients;
          instructionsInput.value = instructions;
        });
      });
    });
  </script>
  <style>
    .container_reference {
      margin-top: 10px;

    }

    form {
      width: 900px;
    }

    .checkbox-dropdown {
      width: 300px;
      border: 1px solid black;
      background-color: #f1f1f1;

      padding: 10px;
      position: relative;
      margin-top: 30px;

      user-select: none;
      cursor: pointer;
      font-family: "Montserrat", sans-serif;
    }

    /* Display CSS arrow to the right of the dropdown text */
    .checkbox-dropdown:after {
      content: '';
      height: 0;
      position: absolute;
      width: 0;
      border: 6px solid transparent;
      border-top-color: #000;
      top: 50%;
      right: 10px;
      margin-top: -3px;
    }

    /* Reverse the CSS arrow when the dropdown is active */
    .checkbox-dropdown.is-active:after {
      border-bottom-color: #000;
      border-top-color: #fff;
      margin-top: -9px;
    }

    .checkbox-dropdown-list {
      list-style: none;
      margin: 0;
      padding: 0;
      position: absolute;
      top: 100%;
      /* align the dropdown right below the dropdown text */
      border: inherit;
      border-top: none;
      left: -1px;
      /* align the dropdown to the left */
      right: -1px;
      /* align the dropdown to the right */
      opacity: 0;
      /* hide the dropdown */

      transition: opacity 0.4s ease-in-out;
      height: 280px;
      overflow: scroll;
      overflow-x: hidden;
      pointer-events: none;
      /* avoid mouse click events inside the dropdown */
    }

    .is-active .checkbox-dropdown-list {
      opacity: 1;
      /* display the dropdown */
      pointer-events: auto;
      /* make sure that the user still can select checkboxes */

      width: 320px;
      margin-top: 2px;
    }

    .checkbox-dropdown-list li label {
      display: block;
      border-bottom: 1px solid silver;
      padding: 10px;
      background-color: #f1f1f1;
      transition: all 0.2s ease-out;
    }

    .checkbox-dropdown-list li label:hover {
      background-color: #007bff;
      color: white;
      cursor: pointer;
    }

    textarea {
      height: 170px;
      width: 500px;
      left: 173px;
      top: -61px;
      padding: 15px;
      font-size: 17px;
      font-family: "Montserrat", sans-serif;
      position: relative;
      background-color: #f1f1f1;
    }

    #instructionslable {
      left: 11px;
      top: -275px;
      position: relative;
      font-size: 20px;
      /* font-weight: bold; */
      font-family: "Montserrat", sans-serif;
    }

    .button {
      width: 50%;
      padding: 11px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 2px;
      font-size: 18px;
      text-decoration: none;
      cursor: pointer;
      text-align: center;
      font-weight: bold;
      display: block;
      margin: 0 auto;
      line-height: 0px;
    }

    .button:hover {
      background-color: #0062cc;
    }

    body {
      background-color: #f1f1f1;
    }

    img {
      display: block;
      margin: 0 auto;
    }
  </style>

</html>