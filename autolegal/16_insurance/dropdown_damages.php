<?php
// At the beginning of each page, start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
  // If they're not logged in, redirect them to the login page
  header('Location: login.html');
  exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Create Letter of Demand</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
  .checkbox-dropdown {
    width: 300px;
    border: 1px solid black;
    background-color: white;
    /* border: 1px solid #aaa; */
    padding: 10px;
    position: relative;
    margin-top: 30px;
    /* margin: 0 auto; */
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
    height: 346px;
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
    background-color: white;
    transition: all 0.2s ease-out;
  }

  .checkbox-dropdown-list li label:hover {
    background-color: #007bff;
    color: white;
    cursor: pointer;
  }

  .container {
    background-color: #f1f1f1;
    border: 4px solid black;
    border-radius: 6px;
    padding: 20px;
    width: 990px;
    height: 444px;
    margin: 0 auto;
    position: relative;
    top: 16px;

  }

  textarea {
    resize: vertical;
    width: 700px;
    min-height: 300px;
    margin: 0 auto;
    display: block;
    padding: 15px;
    font-size: 17px;
    font-family: "Montserrat", sans-serif;
    position: relative;

  }

  #instructionslable {
    left: 11px;
    top: -331px;
    position: relative;
    font-size: 20px;
    /* font-weight: bold; */
    font-family: "Montserrat", sans-serif;
  }

  .button {
    width: 110px;
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
    position: relative;
    top: 20px;
  }

  .button:hover {
    background-color: #0062cc;
  }

  body {
    background-color: #f1f1f1;
  }

  h1 {
    text-align: center;
    background-color: #009bff;
    margin-top: 0px;
    padding-top: 8px;
    padding-bottom: 9px;
    color: white;
    border-radius: 5px;
    position: relative;

  }
</style>

<h1>Letter of Demand</h1>
<div class="form-group">

  <form action="../16_insurance/create_letter_of_demand_2a.php" method="post">
    <textarea id="instructions" name="instructions" autocomplete="off" rows="6" cols="50">Our client is of the opinion that the incident was caused solely by your negligence and/or the negligence of your servants/agents/employees, who were negligent in one, more or all of the following respects:
    </textarea>
</div>
<input type="hidden" name="reference" value="<?php echo $row['reference']; ?>">
<div class="text-center">
</div>
<button type="submit" name="submit" class="button">Next</button>
</div>
</form>

</html>