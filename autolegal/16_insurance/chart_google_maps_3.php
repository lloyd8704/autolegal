<!DOCTYPE html>
<html>

<head>
    <title>Location of Collisions</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery library -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
            <li><a class="user" href="../16_insurance/logout_1.php">Welcome </a></li>
            <li><a class="active" href="#">Map</a></li>
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
    </head>

    <body>
        <div class="logo">SI</div>
        <h2>View where the collision occurred</h2>
        <form id="login-form1" method="post">
            <input class="search_input " type="text" name="reference" placeholder="Reference" required autocomplete="off">
            <button class="search" type="submit">View Location</button>
        </form>
        <div id="message"></div>
        <script>
            $(document).ready(function() {
                $("#login-form1").submit(function(event) {
                    event.preventDefault(); // Prevent the form from submitting normally
                    var formData = $(this).serialize(); // Serialize the form data
                    $.ajax({
                        url: "charts_google_maps_4_reference_check.php",
                        type: "POST",
                        data: formData,
                        success: function(response) {
                            if (response == "success") {
                                // Redirect to the home page
                                var redirect_url = "../16_insurance/chart_google_maps_4.php";
                                window.location.href = redirect_url;

                            } else {
                                // Display an error message
                                $("#message").html("*There is no file with that reference number*");
                                // Hide the message after 2 seconds
                                setTimeout(function() {
                                    $("#message").html("");
                                }, 2000);
                            }
                        }
                    });
                });
            });
        </script>
        <style>
            .logo {
                margin: auto;
                margin-top: 2%;
            }

            #message {
                color: #ff3300;
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                position: absolute;
                transform: translate(-50%, 50%);
                width: 98%;
                top: 41%;
            }

            .data-label {
                position: absolute;
                top: -15px;
                left: 50%;
                transform: translateX(-50%);
                font-size: 12px;
                font-weight: bold;
                color: #fff;
                background-color: #333;
                padding: 4px 8px;
                border-radius: 4px;
            }

            .search_input {
                width: 50%;
                margin-left: 10px;
                margin-right: 10px;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                font-size: 14px;

            }

            .search {
                background-color: #223BC9;
                border: none;
                border-radius: 4px;
                color: white;
                cursor: pointer;
                font-family: 'Open Sans', sans-serif;
                font-size: 16px;
                font-weight: bold;
                padding: 11px;
                text-align: center;
                text-decoration: none;
                width: 140px;
                height: 50px;
            }

            .search:hover {
                background-color: #0504aa;
            }


            #login-form1 {
                margin: auto;
                width: 30%;
                margin-top: 3%;
            }

            label {
                font-weight: bold;
            }
        </style>
    </body>

</html>