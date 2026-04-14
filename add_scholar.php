<?php
include('includes/connection.php');
if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

// Add Scholar logic
if (isset($_POST['add_scholar'])) {
    // Get the form data
    $name = $_POST['name'];
    $year_of_award = $_POST['year_of_award'];
    $scholarship_program = $_POST['scholarship_program'];
    $school = $_POST['school'];
    $course = $_POST['course'];
    $contact_no = $_POST['contact_no'];
    $municipality = $_POST['municipality'];
    $district = $_POST['district'];
    $summer = $_POST['summer'];
    $delayed_requirements = $_POST['delayed_requirements'];
    $lacking_requirements = $_POST['lacking_requirements'];
    $remarks = $_POST['remarks'];
    $status = $_POST['status'];
    $year_graduated = $_POST['year_graduated'];

    // Establish a connection to the database
    $conn = new mysqli("localhost", "root", "", "scholarship_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $target_dir = "uploads/";
    $current_date = date('Y-m-d H:i:s');

    // Handle multiple file uploads for periodic requirements
    $periodic_requirements = '';
    if (!empty($_FILES["periodic_requirements"]["name"][0])) {
        $uploaded_files = [];
        foreach ($_FILES["periodic_requirements"]["name"] as $key => $filename) {
            if (!empty($filename)) {
                $original_filename = pathinfo($filename, PATHINFO_FILENAME);
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                $new_filename = $original_filename . "." . $extension;
                $target_file = $target_dir . $new_filename;
                if (move_uploaded_file($_FILES["periodic_requirements"]["tmp_name"][$key], $target_file)) {
                    $uploaded_files[] = $new_filename . "|" . $current_date;
                }
            }
        }
        if (!empty($uploaded_files)) {
            $periodic_requirements = implode(',', $uploaded_files);
        }
    }

    // Handle single file upload for updated COG
    $updated_cog_filename = '';
    $updated_cog_upload_date = '';
    if (!empty($_FILES["updated_cog"]["name"])) {
        $original_filename = pathinfo($_FILES["updated_cog"]["name"], PATHINFO_FILENAME);
        $extension = pathinfo($_FILES["updated_cog"]["name"], PATHINFO_EXTENSION);
        $updated_cog_filename = $original_filename . "." . $extension;
        $updated_cog = $target_dir . $updated_cog_filename;
        $updated_cog_upload_date = $current_date;
        move_uploaded_file($_FILES["updated_cog"]["tmp_name"], $updated_cog);
    }


    // This one makes sure that if the user types a year exceeding the limit, or just blank, then the system inserts null instead
    if($year_graduated < 1901 || $year_graduated > 2155){
        $year_graduated = NULL;
    }

    // Insert the new scholar into the database
    $sql = "INSERT INTO scholars (name, year_of_award, scholarship_program, school, course, contact_no, municipality, district, 
            periodic_requirements, summer, updated_cog_filename, updated_cog_upload_date, delayed_requirements, 
            lacking_requirements, remarks, status, year_graduated) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssssssss", $name, $year_of_award, $scholarship_program, $school, $course, 
                                           $contact_no, $municipality, $district, $periodic_requirements,
                                           $summer, $updated_cog_filename, $updated_cog_upload_date, $delayed_requirements,
                                           $lacking_requirements, $remarks, $status, $year_graduated);

    if ($stmt->execute() === TRUE) {
        $_SESSION['message'] = 'New Scholar Added Successfully!';
        $_SESSION['message_type'] = 'success';
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
        $_SESSION['message_type'] = 'danger';
        header("Location: dashboard.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>