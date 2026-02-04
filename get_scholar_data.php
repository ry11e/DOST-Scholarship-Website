<?php
// Include database connection
include_once 'includes/connection.php';

// Check if the ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL query to fetch scholar data by ID
    $sql = "SELECT * FROM scholars WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // 'i' means the parameter is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the scholar is found
    if ($result->num_rows > 0) {
        $scholar = $result->fetch_assoc();
        // Return scholar data as JSON
        echo json_encode($scholar);
    } else {
        // Return an error message if no scholar found
        echo json_encode(["error" => "Scholar not found"]);
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "ID not provided"]);
}
?>
