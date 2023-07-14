<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.html');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Chart</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../16_insurance/style.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-A8XQHx7vzKgUyV7EMiO6M+jV6w10b6jFDM6UZjxvbez9iDwhNNlJy+BtysVcGj8+t1WZ91AeZqlgSY4zv4B9jA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../16_insurance/script.js"></script>
</head>

<body>
    <nav>
        <ul>
            <li><a href="../16_insurance/index.php">Home</a></li>
            <li><a href="view_claim_select.php">View</a></li>
            <li><a href="update_select.php">Update</a></li>
            <li><a href="send_email_select.php">Send</a></li>
            <li><a href="choice_of_letters.php">Draft</a></li>
            <li><a class="active" href="#">Chart</a></li>
            <li><a class="user" href="../16_insurance/logout_1.php">Welcome <?php echo ucfirst(strtolower($_SESSION['username'])); ?></a></li>
            <li>
                <a class="sign_out" href="../16_insurance/logout_2.php">
                    <i class="fas fa-sign-out-alt" alt="Sign Out"></i>
                </a>
                <div class="tooltip">
                    <p>Sign Out</p>
                </div>
            </li>
        </ul>
    </nav>


    <style>
        form {
            padding-top: 45px;
            padding-bottom: 45px;
            padding-left: 40px;
            padding-right: 40px;
        }

        h1 {

            margin-bottom: 20px;
            text-align: center;
            font-family: Orbitron;
            font-weight: bolder;
            font-size: 30px;
            margin-bottom: 20px;
            text-align: center;
            font-family: Orbitron;
            font-weight: bolder;
            font-weight: bold;
            color: #151A7B;
        }

        /* CSS styles for the dropdown menu */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            min-width: 160px;
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            background-color: #f9f9f9;
            border: black 1px solid;
            width: 200px;
            font-size: 18px;
            font-family: 'Open Sans', sans-serif;
        }

        .dropdown-content a:hover {
            background-color: navy;
            color: white;
        }

        .dropbtn {
            background-color: #223BC9;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            font-family: 'Open Sans', sans-serif;
            font-size: 19px;
            font-weight: bold;
            padding: 11px;
            text-align: center;
            text-decoration: none;
            width: 235px;
            height: 50px;
        }

        .dropbtn:hover {
            background-color: #0504aa;
            border: black 2px solid;
        }
    </style>
    <script>
        // JavaScript to handle dropdown functionality
        document.addEventListener("click", function(event) {
            var dropdown = document.getElementById("myDropdown");
            var dropbtn = document.getElementById("myDropbtn");

            if (event.target !== dropdown && event.target !== dropbtn) {
                dropdown.style.display = "none";
            }
        });

        function toggleDropdown() {
            var dropdown = document.getElementById("myDropdown");
            dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
        }
    </script>
    </head>

    <body>
        <div class="container">
            <div class="logo">SI</div>
            <h1>Smart Insure</h1>
            <div class="dropdown">
                <button class="dropbtn" id="myDropbtn" onclick="toggleDropdown()">Select a Chart</button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="../16_insurance/chart_1.php">1. Number of Collisions</a>
                    <a href="../16_insurance/chart_2.php">2. Location of Collisions</a>
                    <a href="../16_insurance/chart_2_pie.php">3. Pie Chart</a>
                    <a href="../16_insurance/chart_3.php">4. Comparison</a>
                    <a href="../16_insurance/chart_test.php">5. GeoChart</a>
                    <a href="../16_insurance/chart_google_maps_3.php">6. View Maps</a>
                </div>
            </div>
    </body>

</html>