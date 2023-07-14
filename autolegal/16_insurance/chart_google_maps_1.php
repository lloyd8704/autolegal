<!DOCTYPE html>
<html>

<head>
    <title>Location of Collisions</title>
    <style>

    </style>
</head>

<body>
    <div id="map"></div>
    <input type="text" id="selectedLocation" placeholder="Selected Location">

    <button onclick="saveLocation()">Save Location</button>

    <script>
        function initMap() {
            var mapOptions = {
                center: {
                    lat: -30.5595,
                    lng: 22.9375
                },
                zoom: 5
            };

            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // Create a marker variable
            var marker;

            // Add a click event listener to the map
            map.addListener('click', function(event) {
                // Remove the existing marker if it exists
                if (marker) {
                    marker.setMap(null);
                }

                // Create a new marker at the clicked location
                marker = new google.maps.Marker({
                    position: event.latLng,
                    map: map
                });

                // Update the input fields with the selected location information
                document.getElementById('selectedLocation').value = event.latLng.toString();
            });
        }

        function saveLocation() {
            var selectedLocation = document.getElementById('selectedLocation').value;

            // Extract the latitude and longitude from the selectedLocation string
            var coordinates = selectedLocation.split(',');
            var lat = coordinates[0].trim().substring(1);
            var lng = coordinates[1].trim().slice(0, -1);

            // Perform an AJAX request to send the coordinates to chart_google_maps_2.php
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'chart_google_maps_2.php'); // Replace 'chart_google_maps_2.php' with the URL of your server-side script
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert('Location sent successfully!');
                } else {
                    alert('Error sending location.');
                }
            };
            xhr.send('lat=' + encodeURIComponent(lat) + '&lng=' + encodeURIComponent(lng));
        }
    </script>

    <!-- Load Google Maps API and the map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTdkgo_sN8ILrTBEN0eCjS0ry5ByXKmSs&callback=initMap" async defer></script>
</body>

</html>