<?php
// Establish a connection to your database
$conn = new mysqli("localhost", "root", "", "scholarship_db");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Build the query based on search inputs
$sql = "SELECT * FROM scholars WHERE 1";

if (isset($_GET['search_name']) && $_GET['search_name'] != "") {
    $search_name = $conn->real_escape_string($_GET['search_name']);
    $sql .= " AND (name LIKE '%$search_name%' OR scholarship_program LIKE '%$search_name%')";
}

if (isset($_GET['search_year']) && $_GET['search_year'] != "") {
    $search_year = $_GET['search_year'];
    $sql .= " AND YEAR(year_of_award) = '$search_year'";
}

if (isset($_GET['status']) && $_GET['status'] != "") {
    $status = $_GET['status'];
    $sql .= " AND status LIKE '%$status%'";
}

// Execute the query and get the result
$result = $conn->query($sql);

// Display the results in the table
$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

// Close the connection
$conn->close();

echo json_encode($rows);
?>