<?php
session_start();
$reference = $_POST['reference'];
$numInputs = $_POST['numInputs'];
$input1 = $_POST['input1'];
$amount1 = $_POST['amount1'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Letter</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <style>
        form {
            width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
            position: relative;
            top: -18px;
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 20px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 95%;
            padding: 10px;
            margin-bottom: -1px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .logo {
            display: block;
            margin: 0 auto;
        }

        body {
            margin-top: 40px;
            padding: 0;
            background-color: #f1f1f1;
            overflow: hidden;
        }

        input[type="submit"]:hover {
            background-color: #0062cc;
        }

        .back-button {
            width: 100%;
            padding: 10px;
            background-color: #ccc;
            color: black;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .back-button:hover {
            background-color: #ddd;
        }
    </style>

</head>

<body>
    <div>
        <img src="../11_Images/ACE - LOGO.png" class="logo" alt="Letter and email"><br>
    </div>
    <h1>Create letter for: <?php echo $reference; ?></h1><br>
    <br>
    <form action="../16_insurance/create_tables2.php" method="post">
        <input type="hidden" id="reference" name="reference" value="<?php echo $reference; ?>"><br>
        <input type="hidden" id="numInputs" name="numInputs" value="<?php echo $numInputs; ?>"><br>
        <input type="hidden" id="input1" name="input1" value="<?php echo $input1; ?>"><br>
        <input type="hidden" id="amount1" name="amount1" value="<?php echo $amount1; ?>"><br>
        <input type="submit" value="Download">
        <button type="button" class="back-button" onclick="window.location.href='../16_insurance/choice_of_letters.html'">Back</button>
    </form>
</body>

</html>