<!DOCTYPE html>
<html>

<head>
  <title>Instruction Letter</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-A8XQHx7vzKgUyV7EMiO6M+jV6w10b6jFDM6UZjxvbez9iDwhNNlJy+BtysVcGj8+t1WZ91AeZqlgSY4zv4B9jA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    min-height: 460px;
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


  .home-icon {
    position: absolute;
    top: 0;
    right: 0;
    padding: 10px;

  }

  .home-icon a {
    color: white;
  }

  .home-icon a:hover,
  .home-icon a:active,
  .home-icon a:visited {
    color: white;
  }
</style>

<body>
  <?php
  session_start();

  if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] || !isset($_SESSION["expire_time"]) || time() > $_SESSION["expire_time"]) {
    // Session does not exist or has expired, destroy session and redirect to login page
    session_destroy();
    header("Location: login.html");
    exit;
  }

  // Connect to the database
  include "../16_insurance/db_connection.php";

  $reference = $_SESSION['reference'];
  // Retrieve data from the database
  $sql = "SELECT reference, type_of_claim, policy_number, name, email, contact, identity, address, insured_vehicle,
  insured_registration, location, date, prescription, third_party_name, third_party_contact, third_party_address,
  third_party_identity, third_party_vehicle, third_party_registration, details, second_driver_name,
  second_driver_contact, second_driver_address, second_driver_identity, second_driver_vehicle,
  second_driver_registration FROM claim_form WHERE reference='$reference'";


  $result = mysqli_query($conn, $sql);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  ?>
</body>
<h1>Instruction Letter for <?php echo $row['reference']; ?>
  <div class="home-icon">
    <a href="../16_insurance/index.php">
      <i class="fas fa-home"></i>
    </a>
</h1>
<form action="../16_insurance/create_instruction_letter_3.php" method="post">

  <div class="form-group">
    <textarea id="instructions" name="instructions" autocomplete="off" rows="22" cols="50">
Dear ______,

<?php echo "RE: " . strtoupper($row['name']) . " / " . strtoupper($row['third_party_name']) . "\n"; ?>

The above matter refers.

We set out hereunder the following relevant details in relation to the above-mentioned matter:
  
<?php
echo "Insured: " . $row['name'] . "\n";
echo "Insured's Address: " . $row['address'] . "\n";
echo "Insured's Tel: " . $row['contact'] . "\n";
echo "Insured's Vehicle: " . $row['insured_vehicle'] . " - " . $row['insured_registration'] . "\n\n";
echo "Date of Collision: " . $row['date'] . "\n";
echo "Prescription: " . $row['prescription'] . "\n\n";
echo "Place of Collision: " . $row['location'] . "\n";
echo "Details of the Collision: " .  "\n\n" . $row['details'] . "\n\n";
echo "First Driver: " . $row['third_party_name'] . "\n";
echo "First Driver's Tel: " . $row['third_party_contact'] . "\n";
echo "First Driver's Identity: " . $row['third_party_identity'] . "\n";
echo "First Driver's Vehicle: " . $row['third_party_vehicle'] . " - " . $row['third_party_registration'] . "\n\n";
echo "Second Driver: " . $row['second_driver_name'] . "\n";
echo "Second Driver's Tel: " . $row['second_driver_contact'] . "\n";
echo "Second Driver's Vehicle: " . $row['second_driver_vehicle'] . " - " . $row['second_driver_registration'] . "\n\n";
echo "Quantum: R_________ \n\n"; ?>
Your instructions are as follows:

Regards,
</textarea>
  </div>
  <input type="hidden" name="reference" value="<?php echo $row['reference']; ?>">
  <div class="text-center">
  </div>
  <button type="submit" name="submit" class="button">Create</button>
  </div>
</form>

</html>