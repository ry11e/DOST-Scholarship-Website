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
$sql = "SELECT * FROM uploaded_files WHERE fld_scholar_ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $scholarId);
$stmt->execute();
$result = $stmt->get_result();
$fileRecord = $result->fetch_assoc();

if ($fileRecord) {

    $updateSql = "UPDATE uploaded_files SET fld_record_status = 'inactive' WHERE fld_scholar_ID = ? AND fld_filename = ? AND fld_upload_type = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("iss", $scholarId, $filename, $field);

    if ($updateStmt->execute()) {
        // 5. Delete the physical file from the new scholar-specific folder
        $filePath = "uploads/scholars/$scholarId/$filename";

        if($field == "periodic_requirements" ){
            $filePath = "uploads/scholars/$scholarId/periodic_requirements/$filename";
        }
        else if($field == "updated_cog_filename" ){
            $filePath = "uploads/scholars/$scholarId/updated_cog_filename/$filename";
        }
        else{
            echo "Upload Type Not Found";
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
    echo "File Record not found.";
}

$conn->close();
?>