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

        // Prepare the SQL statement to select the count of losses grouped by age for the specific year
        $stmt = $conn->prepare("
        SELECT age, COUNT(*) as count
        FROM claim_form
        WHERE YEAR(STR_TO_DATE(date, '%d-%m-%Y')) = ?
        GROUP BY age
    ");
        $stmt->bind_param("s", $year);

        $stmt->execute();
        $result = $stmt->get_result();

        // Initialize total count variable
        $totalCount = 0;

        // Build the data table
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $age = $row['age'];
            $count = $row['count'];
            $data[] = "data.addRow(['$age', $count]);";
            // Increment total count
            $totalCount += $count;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <!-- Add the necessary script tag for Google Charts -->

        <script type="text/javascript">
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {
                'packages': ['corechart']
            });

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                // Create the data table.
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Age');
                data.addColumn('number', 'Loss Occurrences');

                <?php
                // Output the data table rows
                if (isset($data)) {
                    foreach ($data as $row) {
                        echo $row;
                    }
                }
                ?>

                // Set chart options
                var options = {
                    title: 'Loss Occurrences by Age for ' + <?php echo $year; ?> + ' - Total Claims ' + <?php echo $totalCount; ?>,
                    titleTextStyle: {
                        fontSize: 18,
                        bold: true,
                        textAlign: 'center'
                    },
                    width: 1300,
                    height: 500,
                    legend: {
                        position: 'none'
                    },
                    hAxis: {
                        title: 'Age'
                    },
                    vAxis: {
                        title: 'Loss Occurrences'
                    }
                };

                // Instantiate and draw the chart.
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>
        <style>
            #chart_div {
                margin: 20px auto;
                padding: 10px;
                margin-left: 20px;
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
                margin-top: 11px;
                margin-left: 30px;
                margin-bottom: -12px;
            }

            label {
                font-weight: bold;
            }
        </style>

    </head>

    <body>
        <!-- Display the form -->
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
        </form>

        <!-- Display the chart -->
        <div id="chart_div"></div>
    </body>

    </html>