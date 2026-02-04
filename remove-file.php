<?php
// remove-file.php

$conn = new mysqli("localhost", "root", "", "scholarship_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$filename = $_POST['filename'];
$field = $_POST['field'] ?? 'periodic_requirements'; // Default to periodic_requirements

if (!in_array($field, ['periodic_requirements', 'updated_cog_filename'])) {
    die("Invalid field specified.");
}

$sql = "SELECT id, $field FROM scholars WHERE $field LIKE '%$filename%'";
$result = $conn->query($sql);
$scholar = $result->fetch_assoc();

if ($scholar) {
    $id = $scholar['id'];
    $fileList = explode(',', $scholar[$field]);

    $updatedList = array_filter($fileList, function ($file) use ($filename) {
        return strpos($file, $filename) === false;
    });

    $updatedString = implode(',', $updatedList);

    $sql = "UPDATE scholars SET $field = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $updatedString, $id);

    if ($stmt->execute()) {
        $filePath = "uploads/$filename";
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        echo "File removed successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "File not found in database";
}

$conn->close();
?>
