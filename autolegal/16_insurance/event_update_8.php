<?php
// Assuming you have already established a database connection
include "../16_insurance/db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['newContent']) && isset($_POST['updateId'])) {
        $newContent = $_POST['newContent'];
        $updateId = $_POST['updateId'];

        // Update the diary entry content in the database
        $stmt = $conn->prepare("UPDATE updates SET update_content = ? WHERE id = ?");
        $stmt->bind_param("si", $newContent, $updateId);
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            echo "Diary entry updated successfully.";
        } else {
            echo "Failed to update diary entry.";
        }
    } else {
        echo "Invalid form data.";
    }
} else {
    echo "Invalid request method.";
}
