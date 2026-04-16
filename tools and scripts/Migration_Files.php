<?php
/* Before, all the scholar's uploaded files were stores in ONE folder
WHat this guy does is create a folder for each scholar, and moves their files (based on the database) into that folder.

*/


include_once '../includes/connection.php';

$sourceDir = "../uploads/";                    // Where all files are currently sitting
$baseTargetDir = "../uploads/scholars/";       // The new organized parent folder

// 1. Create the new parent folder if it doesn't exist
if (!file_exists($baseTargetDir)) {
    mkdir($baseTargetDir, 0777, true);
}


//-----------
$fieldToChange = "updated_cog_filename";    // <------- This is the field you want to migrate

// 2. Fetch all scholars who have files
$sql = "SELECT id, {$fieldToChange} FROM scholars WHERE {$fieldToChange} != ''";
$result = $conn->query($sql);

$movedCount = 0;
$errorCount = 0;
$errorFiles = [];
$movedFiles = [];

echo "<h2>Starting Migration...</h2><hr>";

while ($row = $result->fetch_assoc()) {
    $scholarId = $row['id'];
    $scholarFolder = $baseTargetDir . $scholarId . "/";

    // Create a folder for this specific scholar
    if (!file_exists($scholarFolder)) {
        mkdir($scholarFolder, 0777, true);
    }

    // 3. Clean and Split the comma-separated filenames
    // We trim to handle spaces like "file1.pdf, file2.pdf"
    // Drops the output in an array called $files
    $files = array_map('trim', explode(',', $row[$fieldToChangex]));

    foreach ($files as $fileEntry) {
        // Handle your 'filename|date' format if applicable
        $parts = explode('|', $fileEntry);
        $filename = $parts[0];

        $oldPath = $sourceDir . $filename;
        $newPath = $scholarFolder . $filename;

        // 4. Move the file if it exists in the source
        if (file_exists($oldPath)) {
            if (rename($oldPath, $newPath)) {
                echo "Successfully moved: <b>$filename</b> to folder /$scholarId/<br>";
                $movedCount++;
                $movedFiles[] = "Moved: " . $filename;
            } else {
                echo "<span style='color:red;'>Failed to move: $filename</span><br>";
                $errorCount++;
                $errorFiles[] = "Failed to Move: " . $filename;
            }
        } else {
            echo "Skipped: $filename (File not found in source folder)<br>";
            $errorFiles[] = "Not Found In Folder: " . $filename;
        }
    }
}

echo "<hr><h3>Migration Finished!</h3>";
echo "Files Moved: $movedCount <br>";
foreach($movedFiles as $files){
    echo $files . " <br>";
}

echo "<br>";

echo "Errors: $errorCount";
echo "Errors: <br>";
foreach($errorFiles as $errors){
    echo $errors . " <br>";
}
?>