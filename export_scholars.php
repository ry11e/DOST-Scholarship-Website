<?php
include('includes/connection.php');
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=scholars.xls");

// NOTICE: THE EXPORTED FILE WILL BE AN 'XLS.', TAKE CAUTION

// Add centered title
echo "\t\t\t\t LIST OF DOST-SEI SCHOLARS IN THE PROVINCE OF AKLAN \t\t\t\t\n";
// Add centered title
echo "\t\t\t\t\t\t\t\t SY 2024-2025										
 \t\t\t\t\t\t\n\n";

// Fetch scholars records for export
$sql = "SELECT id, year_of_award, scholarship_program, name, school, course, contact_no, municipality, district, periodic_requirements, remarks, status 
        FROM scholars";
$result = $conn->query($sql);

echo "ID\tYear of Award\tScholarship Program\tName\tSchool\tCourse\tContact No\tMunicipality\tDistrict\tStatus\n";

while ($row = $result->fetch_assoc()) {
    echo "{$row['id']}\t{$row['year_of_award']}\t{$row['scholarship_program']}\t{$row['name']}\t{$row['school']}\t{$row['course']}\t{$row['contact_no']}\t{$row['municipality']}\t{$row['district']}\t{$row['status']}\n";
}
?>