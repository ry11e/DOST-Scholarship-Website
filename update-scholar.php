<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Establish a connection to your database
include('includes/connection.php');

// Get the form data
$id = $_POST['id'];
$name = $_POST['name'];
$year_of_award = $_POST['year_of_award'];
$scholarship_program = $_POST['scholarship_program'];
$school = $_POST['school'];
$course = $_POST['course'];
$contact_no = $_POST['contact_no'];
$municipality = $_POST['municipality'];
$district = $_POST['district'];
$status = $_POST['status'];
$year_graduated = $_POST['year_graduated'];
$summer = $_POST['summer'];
$delayed_requirements = $_POST['delayed_requirements'];
$lacking_requirements = $_POST['lacking_requirements'];
$remarks = $_POST['remarks'];


//---------------------------------Uploaded Files-----------------------------------------//


$target_dir = "uploads/scholars/{$id}/";
$current_date = date('Y-m-d H:i:s');
$uploadFileSuccess = [];
$uploadFileError = [];

// ===== Handle MULTIPLE periodic requirements upload =====
if (!empty($_FILES["periodic_requirements"]["name"][0])) {
    $target_dir .= "periodic_requirements/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    foreach ($_FILES["periodic_requirements"]["name"] as $key => $filename) {
        if (!empty($filename)) {
            $tmp_name = $_FILES["periodic_requirements"]["tmp_name"][$key];
            $timestamp = date("Ymd_His");
            $db_timestamp = date("Y-m-d H:i:s");
            $upload_type = "periodic_requirements";

            $file_parts = pathinfo($filename);
            $name_only = $file_parts['filename']; // "document"
            $extension = $file_parts['extension']; // "pdf"

            $new_filename = $name_only . "_" . $timestamp . "." . $extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($tmp_name, $target_file)) {
            }

            $sql = "INSERT iNTO uploaded_files(fld_scholar_ID, fld_upload_type, fld_filename, fld_uploaded_at) VALUES(?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $id, $upload_type, $new_filename, $db_timestamp);

            if ($stmt->execute() === TRUE) {
                $uploadFileSuccess[] = "Uploaded: " . $new_filename;
            } else {
                $uploadFileError[] = "Failed: " . $new_filename;
                die("MySQL Error: " . $stmt->error);
            }
        }
    }
}

$target_dir = "uploads/scholars/{$id}/";
// ===== Handle MULTIPLE updated COG upload =====
if (!empty($_FILES["updated_cog"]["name"][0])) {
    $target_dir .= "updated_cog_filename/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    foreach ($_FILES["updated_cog"]["name"] as $key => $filename) {
        if (!empty($filename)) {
            $tmp_name = $_FILES["updated_cog"]["tmp_name"][$key];
            $timestamp = date("Ymd_His");
            $db_timestamp = date("Y-m-d H:i:s");
            $upload_type = "updated_cog_filename";

            $file_parts = pathinfo($filename);
            $name_only = $file_parts['filename']; // "document"
            $extension = $file_parts['extension']; // "pdf"

            $new_filename = $name_only . "_" . $timestamp . "." . $extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($tmp_name, $target_file)) {
                
            }

            $sql = "INSERT iNTO uploaded_files(fld_scholar_ID, fld_upload_type, fld_filename, fld_uploaded_at) VALUES(?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isss", $id, $upload_type, $new_filename, $db_timestamp);

            if ($stmt->execute() === TRUE) {
                $uploadFileSuccess[] = "Uploaded: " . $new_filename;
            } else {
                $uploadFileError[] = "Failed: " . $new_filename;
                die("MySQL Error: " . $stmt->error);
            }
        }
    }
} 

//------------------------------------------------------------------------------------------//


// If the user erased/left the year_graduated textbox blank, then update the field in the database to be null
if ($year_graduated < 1901 || $year_graduated > 2155) {
    $year_graduated = NULL;
}

// Update scholar's info in the database
$sql = "UPDATE scholars SET 
    name = ?, 
    year_of_award = ?, 
    scholarship_program = ?, 
    school = ?, 
    course = ?, 
    contact_no = ?, 
    municipality = ?, 
    district = ?, 
    status = ?, 
    year_graduated = ?, 
    summer = ?,
    delayed_requirements = ?,
    lacking_requirements = ?,
    remarks = ? 
    WHERE id = ?";


$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssssssssssssi",
    $name,
    $year_of_award,
    $scholarship_program,
    $school,
    $course,
    $contact_no,
    $municipality,
    $district,
    $status,
    $year_graduated,
    $summer,
    $delayed_requirements,
    $lacking_requirements,
    $remarks,
    $id
);


if ($stmt->execute() === TRUE && empty($uploadFileError)) {

    echo json_encode([
        'success' => true,
        'message' => 'Record Updated'
    ]);
    //echo "<script>alert('Scholar data successfully edited'); window.location.href='dashboard.php';</script>";
} 
else {
    echo json_encode([
        'success' => false,
        'message' => 'Edit Failed'
    ]);
    //echo "<script>alert('Error: " . $conn->error . "'); window.location.href='dashboard.php';</script>";
}

$conn->close();
