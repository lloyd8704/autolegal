        <?php
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "correspdb";
        // Create database connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check if connection was successful
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare SQL query to insert data into the table
        $sql = "INSERT INTO collision_reports (name, email, location, date, details) VALUES (?, ?, ?, ?, ?)";

        // Prepare statement and bind parameters
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $location, $date, $details);

        // Retrieve form data and sanitize
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $details = mysqli_real_escape_string($conn, $_POST['details']);

        // Execute statement and check if successful
        if (mysqli_stmt_execute($stmt)) {
          // If successful, redirect to success page
          header("Location: success.php");
          exit();
        } else {
          // If unsuccessful, display error message
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        ?>
