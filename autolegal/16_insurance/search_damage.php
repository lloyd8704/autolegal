<?php
session_start();

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: login.html');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Search</title>
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
            <li><a class="active" href="../16_insurance/search_select.php">Search</a></li>
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
    <div class="container">
        <form method="POST" action="">
            <input type="text" name="keyword" class="search_input" autocomplete="off" placeholder="Search">
            <button class="search" type="submit" name="submit"><i class="fas fa-search"></i></button>
        </form><br>
    </div>
    <div class="results">
        <?php

        // Check if the user submitted the form
        if (isset($_POST['submit'])) {
            // Get the search keyword and column headings from the form

            // Check if the user submitted the form

            $keyword = "%" . $_POST['keyword'] . "%";
            $headings = array(
                'reference' => 'Reference',
                'company_name' => 'Insured',
                'contact_name' => 'Contact',
                'email' => 'Email',
                'address' => 'Address',
                'contact' => 'Number',
                'date' => 'Date of Incident',
                'prescription' => 'Prescription Date',
                'location' => 'Location',
                'quantum' => 'Quantum',
                'third_party_name' => 'TP Name',
                'third_party_contact' => 'TP Contact',
                'third_party_address' => 'TP Address',
                'third_party_email' => 'TP Email',
                'details' => 'Details',
                'policy_number' => 'Policy No'
            );

            // Connect to the database
            include "../16_insurance/db_connection.php";

            // Prepare the SQL statement to search for the keyword in multiple columns
            $stmt = $conn->prepare("
                SELECT reference, company_name, contact_name, email, address, contact, date, prescription, location, quantum, third_party_name, third_party_contact, third_party_address, third_party_email, details, policy_number
                FROM damage_claim
                WHERE reference LIKE ? OR 
                    company_name LIKE ? OR
                    contact_name LIKE ? OR
                    email LIKE ? OR
                    address LIKE ? OR
                    contact LIKE ? OR
                    date LIKE ? OR
                    prescription LIKE ? OR
                    location LIKE ? OR
                    quantum LIKE ? OR
                    third_party_name LIKE ? OR
                    third_party_contact LIKE ? OR
                    third_party_address LIKE ? OR
                    third_party_email LIKE ? OR
                    details LIKE ? OR
                    policy_number LIKE ?
            ");
            $stmt->bind_param("ssssssssssssssss", $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword);

            $stmt->execute();
            $result = $stmt->get_result();

            // Check if there is a row in the database with the given condition
            if ($result->num_rows >= 1) {
                echo "<div class='header'>Results for the keyword: " . $_POST['keyword'] . "</div>";
                // Output the column headers
                echo "<table><tr>";
                foreach ($headings as $heading) {
                    echo "<th>{$heading}</th>";
                }
                echo "</tr>";

                // Output each result on a new row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        // Highlight the keyword in the value
                        $highlighted_value = str_ireplace($keyword, "<span class='highlighted'>$keyword</span>", $value);
                        echo "<td>{$highlighted_value}</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                // Return an error message
                echo "<div class='header_error'>No results found for the keyword: " . $_POST['keyword'] . "</div>";
            }

            // Close the database connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>

<style>
    form {
        background-color: #f9f9f9;
        border: 3px solid #ccc;
        border-radius: 10px;
        height: auto;
        padding: 20px;
        padding-left: 80px;
        padding-right: 80px;
        position: relative;
    }

    body {
        overflow-y: visible;
        overflow-x: hidden;
    }

    .search_input {
        width: 240px;
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
        padding: 10px 20px;


    }

    .search:hover {
        background-color: #0012a8;
    }

    .container {
        position: relative;

    }

    .results {
        position: absolute;
        top: 27%;

    }

    .header {
        font-family: sans-serif;
        font-size: 20px;
        font-weight: bold;
        margin: auto;
        position: relative;
        top: 6px;
        left: 39%;

    }

    .header_error {
        font-family: sans-serif;
        font-size: 20px;
        font-weight: bold;
        margin: auto;
        position: relative;
        top: 6px;
        left: 150%;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    th,
    td {
        text-align: left;
        padding: 4px;
        border-bottom: 2px solid #ccc;
        border-top: 2px solid #ccc;
        text-align: center;
        font-family: sans-serif;
        font-size: 16px;
    }

    th {
        background-color: #007bff;
        color: white;
        border-bottom: 2px solid black;
        border-top: 2px solid black;
    }
</style>

</html>