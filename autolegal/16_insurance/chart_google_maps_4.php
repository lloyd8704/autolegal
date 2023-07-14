<!DOCTYPE html>
<html>

<head>
    <title>Location of Collisions</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            <li><a href="../16_insurance/chart_mva_drop.php">Chart</a></li>
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

    <div id="map" style="height: 600px;"></div>

    <script>
        function initMap() {
            var mapOptions = {
                center: {
                    lat: -30.5595,
                    lng: 22.9375
                },
                zoom: 17,
                mapTypeId: google.maps.MapTypeId.HYBRID // Set the map type to hybrid (satellite with road names)
            };

            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // Function to create a marker at a specific location
            function createMarker(location) {
                new google.maps.Marker({
                    position: location,
                    map: map
                });
            }

            // Fetch coordinates from MySQL using PHP
            // ...



            // Fetch coordinates from MySQL using PHP
            <?php
            // Start the session
            session_start();
            // Include the db_connection.php file to establish a database connection
            include "../16_insurance/db_connection.php";

            // Get the reference value from the POST request
            $reference = $_SESSION['reference'];

            // Prepare the SQL statement to retrieve the coordinates from the claim_form table
            $stmt = $conn->prepare("SELECT collision_coordinates FROM claim_form WHERE reference = ?");
            $stmt->bind_param("s", $reference);
            $stmt->execute();
            $result = $stmt->get_result();

            // Fetch the coordinates from the result
            if ($row = $result->fetch_assoc()) {
                $coordinates = json_decode($row['collision_coordinates']);
                $lat = $coordinates->lat;
                $lng = $coordinates->lng;

                // Create a JavaScript variable with the retrieved coordinates
                echo "var latLng = { lat: $lat, lng: $lng };";

                // Set the center of the map to the retrieved coordinates
                echo "map.setCenter(latLng);";

                // Create a marker at the retrieved coordinates
                echo "createMarker(latLng);";
            } else {
                echo "console.log('There is no file with that reference number');";
            }

            // Close the database connection
            $stmt->close();
            $conn->close();

            ?>
        }
    </script>



    <!-- Load Google Maps API and the map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTdkgo_sN8ILrTBEN0eCjS0ry5ByXKmSs&callback=initMap" async defer></script>
</body>
<style>
    #map {
        height: 600px;
    }
</style>

</html>