<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.html');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Compare</title>
    <!-- Load Google Charts API -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../16_insurance/style.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Orbitron" />
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-A8XQHx7vzKgUyV7EMiO6M+jV6w10b6jFDM6UZjxvbez9iDwhNNlJy+BtysVcGj8+t1WZ91AeZqlgSY4zv4B9jA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../16_insurance/script.js"></script>

    <style>
        #chart_div {
            padding: 10px;
            margin-left: 20px;
            margin-top: 10px;
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
            padding: 4px;
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
            width: 27%;
            margin-top: 3px;
            margin-left: 30px;
            margin-bottom: -15px;
        }

        label {
            font-weight: bold;
        }
    </style>
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
    <!-- Display the form -->
    <form method="POST">
        <label for="year">Select Year 1:</label>
        <select name="year1" id="year1" class="search_input" required>
            <option value="" disabled selected>- Select -</option>
            <?php
            $currentYear = date('Y');
            for ($i = 2020; $i <= 2050; $i++) {
                $selected = ($i == $_POST['year1']) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
            ?>
        </select>
        <br>

        <label for="year">Select Year 2:</label>
        <select name="year2" id="year2" class="search_input" required>
            <option value="" disabled selected>- Select -</option>
            <?php
            $currentYear = date('Y');
            for ($i = 2020; $i <= 2050; $i++) {
                $selected = ($i == $_POST['year2']) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
            ?>
        </select>
        <input class="search" type="submit" name="submit" value="Submit">
    </form>

    <!-- Display the chart -->
    <div id="chart_div"></div>

    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            <?php
            if (isset($_POST['submit'])) {
                // Get the years from the form input
                $year1 = $_POST['year1'];
                $year2 = $_POST['year2'];
                // Connect to the database
                include "../16_insurance/db_connection.php";

                //repare the SQL statement to select the count of losses grouped by date for the first year
                $stmt1 = $conn->prepare("
                SELECT date, COUNT(*) as count
                FROM claim_form
                WHERE YEAR(STR_TO_DATE(date, '%d-%m-%Y')) = ?
                GROUP BY date
                ORDER BY STR_TO_DATE(date, '%d-%m-%Y')
                ");
                $stmt1->bind_param("i", $year1);
                $stmt1->execute();
                $result1 = $stmt1->get_result();            // Prepare the SQL statement to select the count of losses grouped by date for the second year
                $stmt2 = $conn->prepare("
                    SELECT date, COUNT(*) as count
                    FROM claim_form
                    WHERE YEAR(STR_TO_DATE(date, '%d-%m-%Y')) = ?
                    GROUP BY date
                    ORDER BY STR_TO_DATE(date, '%d-%m-%Y')
                ");
                $stmt2->bind_param("i", $year2);
                $stmt2->execute();
                $result2 = $stmt2->get_result();

                // Build the combined data table
                $data = "['Date', 'Loss Occurrences - $year1', 'Loss Occurrences - $year2']";
                $rows = array();
                $dates = array();

                // Add dummy entry for 0 day and 0 month
                $rows['00 Jan']['count1'] = 0;
                $rows['00 Jan']['count2'] = 0;
                $dates[] = '00 Jan';

                while ($row = $result1->fetch_assoc()) {
                    $date = date('d M', strtotime($row['date']));
                    $count1 = $row['count'];
                    if (!isset($rows[$date])) {
                        $rows[$date] = array('count1' => 0, 'count2' => 0);
                        $dates[] = $date;
                    }
                    $rows[$date]['count1'] += $count1;
                }

                while ($row = $result2->fetch_assoc()) {
                    $date = date('d M', strtotime($row['date']));
                    $count2 = $row['count'];
                    if (!isset($rows[$date])) {
                        $rows[$date] = array('count1' => 0, 'count2' => 0);
                        $dates[] = $date;
                    }
                    $rows[$date]['count2'] += $count2;
                }

                // Custom sorting function
                function customDateSort($a, $b)
                {
                    $aTimestamp = strtotime($a);
                    $bTimestamp = strtotime($b);

                    return $aTimestamp - $bTimestamp;
                }

                // Sort the dates array using the custom sorting function
                usort($dates, 'customDateSort');

                // Build the combined data table
                foreach ($dates as $date) {
                    $count1 = $rows[$date]['count1'];
                    $count2 = $rows[$date]['count2'];

                    $data .= ", ['$date', $count1, $count2]";
                }


                // Close the database connections
                $stmt1->close();
                $stmt2->close();
                $conn->close();
            }
            ?>

            var data = google.visualization.arrayToDataTable([<?php echo $data; ?>]);

            var options = {
                title: 'Total Claims for Years <?php echo $year1; ?> and <?php echo $year2; ?>',
                titleTextStyle: {
                    fontSize: 18,
                    bold: true,
                    textAlign: 'center'
                },
                width: 1300,
                height: 500,
                legend: {
                    position: 'top'
                },
                hAxis: {
                    title: 'Date',
                    viewWindow: {
                        min: 0
                    }

                },
                vAxis: {
                    title: 'Loss Occurrences',
                    minValue: 0, // Ensure the y-axis starts from 0
                    baseline: 0, // Start the lines from y-axis (0)
                },

                pointSize: 5, // Adjust the size of the data points
                series: {
                    0: {
                        points: {
                            symbol: 'circle'
                        }
                    }, // Set the symbol for Year 1 data points
                    1: {
                        points: {
                            symbol: 'circle'
                        }
                    } // Set the symbol for Year 2 data points
                }
            };


            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>