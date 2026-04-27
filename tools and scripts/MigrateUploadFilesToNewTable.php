<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}



/*
    What this guy does is migrate the filenames of the uploaded files that are stored as fields in the `scholars` table to 
    their own table, `uploaded_files`. Just took this baby for a spin and it worked flawlessly.
*/

include_once "../includes/connection.php";

$scholarsSql = "Select * From scholars where 1";
$scholarsRecords = $conn->query($scholarsSql);

$success = [];
$errors = [];

foreach($scholarsRecords as $row){

    $scholarId = $row['id'];


    $periodicFiles = $row['periodic_requirements'];
    $periodicFilesArray = array_filter(explode(",", $periodicFiles));

    foreach($periodicFilesArray as $periodicFile){

        $uploadType = "periodic_requirements";
        if(strpos($periodicFile, "|")){
            $periodicFileArray = array_filter(explode("|",$periodicFile));
            $filename = $periodicFileArray[0];
            $date = $periodicFileArray[1];
        }
        else{
            $filename = $periodicFile;
            $date = "";
        }
     
        $uploadPeriodicFilesSql = "Insert Into uploaded_files(fld_scholar_ID, fld_upload_type, fld_filename, fld_uploaded_at) Values(?, ?, ?, ?)";
        $uploadPeriodicFiles = $conn->prepare($uploadPeriodicFilesSql);
        $uploadPeriodicFiles->bind_param("isss", $scholarId, $uploadType, $filename, $date);
        
        if($uploadPeriodicFiles->execute() == TRUE){
            $success[] = "Scholar: " . $scholarId . " -> " . $filename . " == " . $date ;
        }
        else{
            $errors[] = "Scholar: " . $scholarId . " -> " . $filename . " == " . $date;
        }

    }

    $updatedCOGFiles = $row['updated_cog_filename'];
    $updatedCOGFilesArray = array_filter(explode(",", $updatedCOGFiles));

    foreach($updatedCOGFilesArray as $updatedCOGFile){

        $uploadType = "updated_cog_filename";
        if(strpos($updatedCOGFile, "|")){
            $updatedCOGFileArray = array_filter(explode("|",$updatedCOGFile));
            $filename = $updatedCOGFileArray[0];
            $date = $updatedCOGFileArray[1];
        }
        else{
            $filename = $updatedCOGFile;
            $date = "";
        }
     
        $uploadPeriodicFilesSql = "Insert Into uploaded_files(fld_scholar_ID, fld_upload_type, fld_filename, fld_uploaded_at) Values(?, ?, ?, ?)";
        $uploadPeriodicFiles = $conn->prepare($uploadPeriodicFilesSql);
        $uploadPeriodicFiles->bind_param("isss", $scholarId, $uploadType, $filename, $date);
        
        if($uploadPeriodicFiles->execute() == TRUE){
            $success[] = "Scholar: " . $scholarId . " -> " . $filename . " == " . $date ;
        }
        else{
            $errors[] = "Scholar: " . $scholarId . " -> " . $filename . " == " . $date;
        }

    }
}

echo "Successes: " . count($success) . "<br>";
foreach($success as $s){
    echo $s . "<br>";
}
echo "<br><br>";
echo "Errors: " . count($errors) . "<br>";
foreach($errors as $e){
    echo $e . "<br>";
}

?>