<?php
// Include database connection
include_once 'includes/connection.php';

// Check if the 'id' is set in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL Injection
    $scholar_id = $conn->real_escape_string($_GET['id']);

    // Prepare the SQL query to update the scholar's status to 'inactive' instead of deleting the record
    $sql = "UPDATE scholars SET record_status = 'inactive' WHERE id = '$scholar_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // If the update is successful, redirect to the dashboard or scholar list page
        header('Location: dashboard.php?message=deleted');
        exit();  // Ensure the script stops executing here
    } else {
        // If there is an error, show an error message
        echo "Error: " . $conn->error;
    }
} else {
    // If no id is passed in the URL, redirect back to the dashboard with an error message
    header('Location: dashboard.php?message=error');
    exit();
}

// Close the database connection
$conn->close();
?>
