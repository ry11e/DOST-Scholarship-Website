<?php
include 'includes/connection.php';
require_once 'includes/SimpleXLSXGen.php';   // php library for generating xlsx files

$rows = [
    ["LIST OF DOST-SEI SCHOLARS IN THE PROVINCE OF AKLAN"],
    ['SY 2024-2025'],
    [], // empty line
    ['ID', 'Year of Award', 'Scholarship Program', 'Name', 'School', 'Course', 'Contact No', 'Municipality', 'District', 'Status']
];

$sql = "SELECT id, year_of_award, scholarship_program, name, school, course, contact_no, municipality, district, status 
        FROM scholars";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    // Keep original types (numbers stay numbers, etc.)
    $rows[] = [
        $row['id'],
        $row['year_of_award'],
        $row['scholarship_program'],
        $row['name'],
        $row['school'],
        $row['course'],
        $row['contact_no'],
        $row['municipality'],
        $row['district'],
        $row['status']
    ];
}

$xlsx = Shuchkin\SimpleXLSXGen::fromArray($rows);

// Optional: make title rows bold/centered
$xlsx->setColWidth(0,  5);   // ID
$xlsx->setColWidth(1,  15);
$xlsx->setColWidth(2,  15);
$xlsx->setColWidth(3,  15);  // Name – wider
$xlsx->setColWidth(4,  40);
$xlsx->setColWidth(5,  30);
$xlsx->setColWidth(6,  35);
$xlsx->setColWidth(7,  20);
$xlsx->setColWidth(8,  20);
$xlsx->setColWidth(9,  15);

// Download
$xlsx->downloadAs('scholars.xlsx');
?>