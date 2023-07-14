<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.html');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Location of Collisions</title>
    <!-- Load Google Charts API -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../16_insurance/style.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
    <script src="https://kit.fontawesome.com/a076ds05399.js" crossorigin="anonymous"></script>
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
            <li><a class="user" href="../16_insurance/logout_1.php">Welcome <?php echo ucfirst(strtolower($_SESSION['username'])); ?></a></li>
            <li><a class="active" href="../16_insurance/chart_mva_drop.php">Chart</a></li>
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

    <?php
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the year from the form input
        $year = $_POST['year'];

        // Connect to the database
        include "../16_insurance/db_connection.php";

        // Prepare the SQL statement to select the count of losses grouped by location for the specific year
        $stmt = $conn->prepare("
            SELECT province, COUNT(*) as count
            FROM claim_form
            WHERE YEAR(STR_TO_DATE(date, '%d-%m-%Y')) = ?
            GROUP BY province
        ");
        $stmt->bind_param("s", $year);

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $province = $row['province'];
            $count = $row['count'];

            $data[] = "['$province', $count]";
        }

        $stmt->close();
        $conn->close();
    }
    ?>

    <div class="container">
        <form method="POST" action="">
            <label for="year">Select Year:</label>
            <select name="year" id="year" class="search_input" required>
                <option value="" disabled selected>- Select -</option>
                <?php
                $currentYear = date('Y');
                for ($i = 2020; $i <= 2050; $i++) {
                    $selected = ($i == $_POST['year']) ? 'selected' : '';
                    echo "<option value='$i' $selected>$i</option>";
                }
                ?>
            </select>
            <input class="search" type="submit" name="submit" value="View">
        </form><br><br>
        <div id="chart_container">
            <div id="chart_div"></div>
            <div id="legend_div"></div>
        </div>
    </div>

    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: "yy",
                changeYear: true,
                showButtonPanel: true,
                yearRange: "2000:<?php echo date("Y"); ?>",
                onClose: function(dateText, inst) {
                    $(this).attr("disabled", false);
                    $("form").submit();
                }
            });
        });
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['geochart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Province', 'Number of Collisions'],
                <?php
                if (isset($data)) {
                    echo implode(",", $data);
                }
                ?>
            ]);

            var options = {

                region: 'ZA',
                resolution: 'provinces',

                colorAxis: {
                    colors: ['#f0ad4e', '#d9534f']
                },
                backgroundColor: '#f8f8f8',
                datalessRegionColor: '#ffffff',
                defaultColor: '#cccccc',
                tooltip: {
                    textStyle: {
                        color: '#444444',
                        fontSize: 12,
                        fontName: 'Arial',
                        bold: false,
                        italic: false
                    }
                },

            };

            var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>

    <style>
        #chart_container {
            position: relative;
            width: 100%;
            height: 200px;

        }

        #chart_div {
            zoom: 120%;
            cursor: pointer;
        }

        #legend_div {
            position: absolute;
            bottom: 10px;
            /* Adjust the bottom value to position the legend within the image */
            left: 10px;

            /* Adjust the left value to position the legend within the image */
            /* Other legend styles... */
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
            width: 30%;
            margin-left: 10px;
            margin-right: 10px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            cursor: pointer;
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
            width: 110px;
        }

        .search:hover {
            background-color: #0504aa;
        }

        form {
            width: 25%;

            margin-left: 30px;
            margin-bottom: -12px;
        }

        label {
            font-weight: bold;
        }
    </style>



</body>

</html>