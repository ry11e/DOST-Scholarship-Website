<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('includes/connection.php');

$filename  = $_POST['filename'] ?? '';
$scholarId = $_POST['scholar_id'] ?? '';
$field     = $_POST['field'] ?? 'periodic_requirements';

// 1. Validation
if (empty($scholarId)) {
    die("Missing ID.");
}
if (empty($filename) ) {
    die("Missing Filename.");
}

if (!in_array($field, ['periodic_requirements', 'updated_cog_filename'])) {
    die("Invalid field specified.");
}

// 2. Get the current file list for THIS specific scholar
$sql = "SELECT $field FROM scholars WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $scholarId);
$stmt->execute();
$result = $stmt->get_result();
$scholar = $result->fetch_assoc();

if ($scholar) {
    $fileList = explode(',', $scholar[$field]);

    // 3. Filter out the file to be deleted
    // Works with 'filename|date' format too
    $updatedList = array_filter($fileList, function ($fileEntry) use ($filename) {
        $parts = explode('|', trim($fileEntry));
        return $parts[0] !== $filename;
    });

    $updatedString = implode(',', $updatedList);

    // 4. Update the Database
    $updateSql = "UPDATE scholars SET $field = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("si", $updatedString, $scholarId);

    if ($updateStmt->execute()) {
        // 5. Delete the physical file from the new scholar-specific folder
        $filePath = "uploads/scholars/$scholarId/$filename";

        if($field == "periodic_requirements" ){
            $filePath = "uploads/scholars/$scholarId/periodic_requirements/$filename";
        }
        else{
            $filePath = "uploads/scholars/$scholarId/updated_cog_filename/$filename";
        }
        
        if (file_exists($filePath)) {
            unlink($filePath);
            echo "File removed successfully";
        } else {
            echo "Database updated, but physical file was not found in folder.";
        }
    } else {
        echo "Error updating database.";
    }
    $updateStmt->close();
} else {
    echo "Scholar not found.";
}

$conn->close();
?>