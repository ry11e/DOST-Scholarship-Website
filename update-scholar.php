<?php

header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


// Establish a connection to your database
$conn = new mysqli("localhost", "root", "", "scholarship_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

// Fetch existing file information
$sql = "SELECT periodic_requirements, updated_cog_filename, updated_cog_upload_date FROM scholars WHERE id = '$id'";

$result = $conn->query($sql);
$existing_files = $result->fetch_assoc();

$periodic_requirements = $existing_files['periodic_requirements'];
$updated_cog_filename = $existing_files['updated_cog_filename'];

$target_dir = "uploads/";
$current_date = date('Y-m-d H:i:s');

// ===== Handle MULTIPLE periodic requirements upload =====
if (!empty($_FILES["periodic_requirements"]["name"][0])) {
    $uploaded_files = [];
    foreach ($_FILES["periodic_requirements"]["name"] as $key => $filename) {
        if (!empty($filename)) {
            $filename = str_replace(',', '', $filename); // sanitize
            $tmp_name = $_FILES["periodic_requirements"]["tmp_name"][$key];
            $new_filename = basename($filename);
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($tmp_name, $target_file)) {
                $uploaded_files[] = $new_filename . "|" . $current_date;
            }
        }
    }

    if (!empty($uploaded_files)) {
        $periodic_requirements_array = !empty($periodic_requirements) ? explode(',', $periodic_requirements) : [];
        $periodic_requirements = implode(',', array_merge($periodic_requirements_array, $uploaded_files));
    }
}

// ===== Handle MULTIPLE updated COG upload =====
if (!empty($_FILES["updated_cog"]["name"][0])) {
    $new_cog_files = [];
    foreach ($_FILES["updated_cog"]["name"] as $key => $filename) {
        if (!empty($filename)) {
            $filename = str_replace(',', '', $filename); // sanitize
            $tmp_name = $_FILES["updated_cog"]["tmp_name"][$key];
            $new_filename = basename($filename);
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($tmp_name, $target_file)) {
                $new_cog_files[] = $new_filename . "|" . $current_date;
            }
        }
    }

    if (!empty($new_cog_files)) {
        $existing_cog_files = !empty($updated_cog_filename) ? explode(',', $updated_cog_filename) : [];
        $updated_cog_filename = implode(',', array_merge($existing_cog_files, $new_cog_files));
        $updated_cog_upload_date = $current_date;
    } else {
        $updated_cog_upload_date = $existing_files['updated_cog_upload_date'];
    }
} else {
    $updated_cog_upload_date = $existing_files['updated_cog_upload_date'];
}

// Update scholar's info in the database
$sql = "UPDATE scholars SET 
    name = '$name', 
    year_of_award = '$year_of_award', 
    scholarship_program = '$scholarship_program', 
    school = '$school', 
    course = '$course', 
    contact_no = '$contact_no', 
    municipality = '$municipality', 
    district = '$district', 
    status = '$status', 
    year_graduated = '$year_graduated', 
    summer = '$summer',
    periodic_requirements = '$periodic_requirements',
    updated_cog_filename = '$updated_cog_filename',
    updated_cog_upload_date = '$updated_cog_upload_date',
    delayed_requirements = '$delayed_requirements',
    lacking_requirements = '$lacking_requirements',
    remarks = '$remarks' 
    WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {

    echo json_encode([
        'success' => true,
        'message' => 'Record Updated'
    ]);
    //echo "<script>alert('Scholar data successfully edited'); window.location.href='dashboard.php';</script>";
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Edit Failed'
    ]);
    //echo "<script>alert('Error: " . $conn->error . "'); window.location.href='dashboard.php';</script>";
}

$conn->close();
?>
