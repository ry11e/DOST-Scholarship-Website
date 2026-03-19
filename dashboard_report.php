<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'includes/head.php';
include_once 'includes/sidebar.php';

include 'includes/connection.php';





// Scholarship Programs
$scholProgData = [];
$scholProgLabels = [];


$scholProgUndergradData = [];
$scholProgUndergradLabel = [];

$scholProgJLSSData = [];
$scholProgJLSSLabel = [];



$sqlScholarshipPrograms = "
        SELECT `scholarship_program`, COUNT(`scholarship_program`) AS total FROM `scholars` GROUP BY `scholarship_program` ORDER BY `scholarship_program` ASC
    ";
$resultBar = $conn->query($sqlScholarshipPrograms);

while ($row = $resultBar->fetch_assoc()) {

    if (stripos($row["scholarship_program"], "JLSS") !== false) {
        $scholProgJLSSLabel[] = $row['scholarship_program'];
        $scholProgJLSSData[]   = (int)$row['total'];

        $finalLabel = substr($row["scholarship_program"], 0, -5);

        $scholProgLabels[] = $finalLabel;
        $scholProgData[]   = (int)$row['total'];
    } else {
        $scholProgUndergradLabel[] = $row['scholarship_program'];
        $scholProgUndergradData[]   = (int)$row['total'];

        $scholProgLabels[] = $row['scholarship_program'];
        $scholProgData[]   = (int)$row['total'];
    }
}

$mergedScholars = [];

foreach ($scholProgLabels as $i => $label) {
    if (!isset($merged[$label])) {
        $merged[$label] = 0;
    }
    $merged[$label] += $scholProgData[$i];
}

$finalScholProgLabels = array_keys($merged);
$finalScholProgData = array_values($merged);




























// Scholarship Program 
/*  The scholarship chart is a stacked chart. The main bars are the scholarship programs,
    and each bar is divided into stacks representing statuses
*/
$ScholProgStatuses = []; // Active, Graduated, etc.
$ScholProgPrograms = []; // Various scholarship programs
$ScholProgTempData = []; // Temporary storage


$scholTableSql = "SELECT * FROM `tbl_scholarship_programs`";
$scholTableResult = $conn->query($scholTableSql);

$ScholProgSql = "SELECT scholarship_program, status, count(scholarship_program) as total FROM `scholars` WHERE 1 group BY scholarship_program, STATUS order by scholarship_program ASC";;
$ScholProgResult = $conn->query($ScholProgSql);

while ($row = $ScholProgResult->fetch_assoc()) {
    $prog = $row["scholarship_program"];
    $stat = $row["status"];
    $total = (int)$row["total"];

    if (!in_array($prog, $ScholProgPrograms)) {
        $ScholProgPrograms[] = $prog;
    }
    if (!in_array($stat, $ScholProgStatuses)) {
        $ScholProgStatuses[] = $stat;
    }

    // Store data in a way we can easily access by [Status][Program]
    $ScholProgTempData[$stat][$prog] = $total;
}

$ScholProgFinalSeries = [];
foreach ($ScholProgStatuses as $stat) {
    $dataPoints = [];
    foreach ($ScholProgPrograms as $prog) {
        // If a program has no scholars for this status, use 0
        $dataPoints[] = isset($ScholProgTempData[$stat][$prog]) ? $ScholProgTempData[$stat][$prog] : 0;
    }
    $ScholProgFinalSeries[] = [
        'name' => $stat,
        'data' => $dataPoints
    ];
}











// Total Sum of scholarship programs
// This is different from the overall summary, as this sums up all the sub-programs below the main programs, e.g. Merit = {Merit, JLSS-Merit}.

// Retrieves the scholarship table and quickly convert them into a 1D array
$scholTableSql = "SELECT DISTINCT fld_scholarshipCode FROM `tbl_scholarship_programs` Order by fld_scholarshipCode ASC";
$scholTableResult = $conn->query($scholTableSql);
$scholTable = array_column($scholTableResult->fetch_all(MYSQLI_ASSOC), "fld_scholarshipCode");

$ScholProgSql = "SELECT scholarship_program, status, count(scholarship_program) as total FROM `scholars` WHERE 1 group BY scholarship_program, STATUS order by scholarship_program ASC";;
$ScholProgResult = $conn->query($ScholProgSql);

$tempScholData = [];

// These guys are outside the scope of the loop below
$scholTotal = [];
$scholTotalLabel = [];
$scCounter = -1;


// Since the retreived records are ordered/sorted, there's no need to brute force or use complex spaghetti code(LMAOOOO look who's talking)
// Super INefficient but it's the best I got HAHAAHaaaaaaaaaa..........
while ($row = $ScholProgResult->fetch_assoc()) {
    $prog = $row["scholarship_program"];
    $stat = $row["status"];
    $total = (int)$row["total"];

    for ($i = 0; $i < count($scholTable); $i++) {

        if (str_contains($prog, $scholTable[$i])) {
            // this only inserts the scholarshipCode into the labels once,
            if (!in_array($scholTable[$i], $scholTotalLabel)) {
                $scholTotalLabel[] = $scholTable[$i];
                $scCounter++;
            }
            // These guys on the other hand sum up all the number of scholars below their repsective main program.
            if (isset($scholTotal[$scCounter])) {
                $scholTotal[$scCounter] += $total;
            } else {
                $scholTotal[$scCounter] = $total;
            }
        } else {
            //echo "not: " .$prog . " - " . $scholTable[$i] . " - "  . $stat . " - " . $total . " - " . "<br>";
        }
    }
}




//Year of award 

$yearOfAwardStatuses = [];
$yearOfAwardYears = [];
$yearOfAwardTempData = [];

$sql = "SELECT status, year_of_award, count(*) as total FROM `scholars` WHERE 1 group by status, year_of_award ";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $stat = $row["status"];
    $year = $row["year_of_award"];
    $total = (int)$row["total"];

    if (!in_array($stat, $yearOfAwardStatuses)) {
        $yearOfAwardStatuses[] = $stat;
    }
    if (!in_array($year, $yearOfAwardYears)) {
        $yearOfAwardYears[] = $year;
    }

    $yearOfAwardTempData[$stat][$year] = $total;
}

$yearOfAwardFinalSeries = [];
foreach ($yearOfAwardStatuses as $stat) {
    $dataPoints = [];
    foreach ($yearOfAwardYears as $year) {
        $dataPoints[] = isset($yearOfAwardTempData[$stat][$year]) ? $yearOfAwardTempData[$stat][$year] : 0;
    }
    $yearOfAwardFinalSeries[] = [
        'name' => $stat,
        'data' => $dataPoints
    ];
}





// Year Of Award
$awardYearData = [];
$awardYearLabels = [];

$sqlAwardYear = "
        SELECT `year_of_award`, COUNT(`year_of_award`) As total FROM `scholars` GROUP By `year_of_award`
    ";
$resultAwardYear = $conn->query($sqlAwardYear);

while ($row = $resultAwardYear->fetch_assoc()) {
    $awardYearLabels[] = $row['year_of_award'];
    $awardYearData[]   = (int)$row['total'];
}


// Scholarship Programs
$schoolData = [];
$schoolLabels = [];

$sqlSchool = "
        SELECT `school`, COUNT(`school`) AS total FROM `scholars` GROUP BY `school`
    ";
$resultBar = $conn->query($sqlSchool);

while ($row = $resultBar->fetch_assoc()) {
    $schoolLabels[] = $row['school'];
    $schoolData[]   = (int)$row['total'];
}




$statusLabels = [];
$statusData = [];

$statusSql = "Select `status` , Count(`status`) as total from `scholars` group by `status`";

$statusResult = $conn->query($statusSql);
while ($row = $statusResult->fetch_assoc()) {

    $status = "AAA";
    if (empty($row['status']) || $row['status'] == " ") {
        $status = "<blank>";
    } else {
        $status = $row['status'];
    }

    $statusLabels[] = $status;
    $statusData[] = (int)$row['total'];
}


/*

    $municipalityData = [];
    $muncipalityLabel = [];
    
    $municipalitySql = "Select `municipality`, COUNT(municipality) as total from `scholars` Group By `municipality`";

    $resultMunicipality = $conn->query($municipalitySql);

    while($row = $resultMunicipality->fetch_assoc()){
        $municipalityData[] = $row['total'];
        $municipalityLabel[] =  $row['municipality'];
    }

*/


$outAklanMunData = [];
$outAklanMunLabel = [];



$inAklanData1st = [];
$inAklanLabel1st = [];

$inAklanData2nd = [];
$inAklanLabel2nd = [];

$outAklanDataTotal = 0;
$inAklanData1stTotal = 0;
$inAklanData2ndTotal = 0;



$municipalityTableSql = "select fld_municipality, fld_district from tbl_municipalities";
$munTableResult = $conn->query($municipalityTableSql);

$aklanMunicipalities = array_column($munTableResult->fetch_all(MYSQLI_ASSOC), "fld_municipality");
$aklanMunicipalitiesDistrict = array_column($munTableResult->fetch_all(MYSQLI_ASSOC), "fld_district");


$municipalitySql = "Select `district`,`municipality`, COUNT(municipality) as total from `scholars` Group By `municipality`";
$resultMunicipality = $conn->query($municipalitySql);




while ($row = $resultMunicipality->fetch_assoc()) {

    // echo $row["municipality"] . " - " . $row["district"] . " - " . $row["total"];
    // echo "<br>";


    if (isInAklan($row["municipality"])) {

        if (stripos($row["district"], "1st") !== false) {
            $inAklanData1st[] = $row["total"];
            $inAklanLabel1st[] = $row["municipality"];

            $inAklanData1stTotal += $row["total"];
        } else if (stripos($row["district"], "2nd") !== false) {
            $inAklanData2nd[] = $row["total"];
            $inAklanLabel2nd[] = $row["municipality"];

            $inAklanData2ndTotal += $row["total"];
        } else {
            echo "Error: Municipality " . $row["municipality"] . " has an invalid district value of '" . $row["district"] . "'.";
        }

        //echo "Municipality: " . $row["municipality"] . " | District: " . $row["district"] . " | Total Scholars: " . $row["total"] . "<br>";
    } else {
        $outAklanMunData[] = $row["total"];
        $outAklanMunLabel[] = $row["municipality"];

        $outAklanDataTotal += $row["total"];
    }
}











/*


    // Debug
    echo count($inAklanMunData);
    
    for($i = 0; $i < count($outAklanMunData); $i++){
        echo $outAklanMunData[$i];
        echo $outAklanMunLabel[$i];
        echo "<br>";
    }
    echo "<br>" . count($aklanMunicipalities);
    for($i = 0; $i < count($aklanMunicipalities); $i++){
        echo $aklanMunicipalities[$i];
    }


    $totalScholars = 0;
    $totalSql = "select * from `scholars`";
    $totalResult = $conn->query($totalSql);
    $totalScholars = mysqli_num_rows($totalResult);

    //echo $totalScholars;

*/



$conn->close();





// THis function checks whether the argument sent can be found in the municipalities list/table as well.
function isInAklan($municipality)
{
    global $aklanMunicipalities;


    if (in_array($municipality, $aklanMunicipalities)) {
        return true;
    } else {
        return false;
    }
}

?>

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box pd-30">



            <div class="container-fluid mt-4 mb-4">
                <div class="row mb-4">
                    <div class="col-6">
                        <div class="d-flex justify-content-between align-items-center  pl-3">
                            <h1 class="h1">Reports Dashboard</h1>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <button onclick="generateFullReport()" class="btn btn-success">
                            <i class="bi bi-printer"></i> Print Scholar Report
                        </button>
                        <button onclick="downloadPDFReport()" class="btn btn-light border text-success">
                            <i class="bi bi-printer"></i> Download Scholar Report
                        </button>

                    </div>
                </div>

            </div>


            <!-- Hidden Chart. Wasn't needed, but will probably be deleted in the future -->
            <div class="container-fluid mt-4 mb-4" style="display: none;">
                <div class="row g-4">
                    <div class="col-12 col-lg-12">
                        <div class="reports-chart-container border p-4 shadow-sm bg-white rounded h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="h3">Overall Scholarship Summary</h3>
                                <span class="badge bg-secondary fs-6">Combined Data</span>
                            </div>
                            <div id="scholarshipOverallChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <br>


            <div class="container-fluid mt-4 mb-4">
                <div class="row g-4">
                    <div class="col-12 col-lg-7">
                        <div class="reports-chart-container border p-4 shadow-sm bg-white rounded h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="h3">Total Scholars Per Scholarship Program</h3>
                            </div>
                            <div id="scholarshipTotalChart"></div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-5">
                        <div class="row g-4 pb-2">
                            <div class="reports-chart-container border p-4 shadow-sm bg-white rounded h-100">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="h4">Standard Scholarships</h4>
                                </div>
                                <div id="scholarshipStandardChart"></div>
                            </div>
                        </div>
                        <div class="row g-4 pt-2">
                            <div class="reports-chart-container border p-4 shadow-sm bg-white rounded h-100">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="h4">JLSS Scholarships</h4>
                                </div>
                                <div id="scholarshipJLSSChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <br>

            <div class="container-fluid mt-4 mb-4">
                <div class="row g-4">
                    <div class="col-12 col-lg-12">
                        <div class="reports-chart-container border p-4 shadow-sm bg-white rounded h-100">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="h3">Year Of Award</h3>
                            </div>
                            <div id="yearChart"></div>
                        </div>
                    </div>
                </div>
            </div>



            <br>
            <br>



            <div class="container-fluid mt-4 mb-4">
                <div class="row g-4">

                    <div class="col-12 col-lg-6">
                        <div class="d-flex flex-column gap-4 h-100">

                            <div class="mb-1 reports-chart-container border p-3 bg-white shadow-sm rounded flex-fill">
                                <h3>Status</h3>
                                <div id="statusChart"></div>
                            </div>



                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="mt-1 reports-chart-container border p-3 bg-white shadow-sm rounded flex-fill">
                            <h3>Schools</h3>
                            <div id="schoolChart"></div>
                        </div>
                    </div>





                </div>
            </div>


            <br>
            <br>





            <div class="container-fluid mt-4 mb-4">
                <div class="row mb-4">
                    <div class="col-12 col-xl-6">
                        <div class="reports-chart-container border p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3>Within Aklan: District 1</h3>
                                <span class="badge bg-secondary fs-6">Total: <?php echo ($inAklanData1stTotal) ?></span>
                            </div>
                            <div id="inAklanMun1stChart" style="height:350px;"></div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
                        <div class="reports-chart-container border p-3 ">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3>Within Aklan: District 2</h3>
                                <span class="badge bg-secondary fs-6">Total: <?php echo ($inAklanData2ndTotal) ?></span>
                            </div>
                            <div id="inAklanMun2ndChart" style="height:350px;"></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-12 col-xl-12`">
                        <div class="reports-chart-container border p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3>Outside Aklan Municipalities</h3>
                                <span class="badge bg-secondary fs-6">Total: <?php echo $outAklanDataTotal ?></span>
                            </div>
                            <div id="outAklanMunChart" style="height:350px;"></div>
                        </div>
                    </div>

                </div>

            </div>











        </div>
    </div>
</div>




<!-- Buffer Render for Charts -->
<!--  
<div id="report-buffer" style="position: absolute; left: -9999px; width: 1200px; background: white;">
    <div id="bufferChart"></div>
    <div id="bufferChart2"></div>
</div>
 -->

<div id="report-buffer" style="position: absolute; left: -9999px; width: 1200px; background: white; padding: 20px;">
    <div id="temp-slot"></div>
</div>




<!-- JS Scripts -->
<script src="vendors/scripts/core.js"></script>
<script src="vendors/scripts/script.min.js"></script>
<script src="vendors/scripts/process.js"></script>
<script src="vendors/scripts/layout-settings.js"></script>
<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="vendors/scripts/dashboard3.js"></script>
<script src="vendors/scripts/jspdf.umd.min.js"></script>





<script>
    // Scholarship Program


    var scholarshipOverallOptions = {
        chart: {
            type: 'bar',
            height: 400,
            stacked: true,
            toolbar: {
                show: true
            },
            width: '100%',
            redrawOnParentResize: true
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                dataLabels: {
                    total: {
                        enabled: true,
                        style: {
                            color: '#373d3f',
                            fontSize: '15px',
                            fontWeight: 900
                        }
                    }
                }
            }
        },
        // Add this to give the 30px text room at the top
        grid: {
            padding: {
                top: 30
            }
        },
        dataLabels: {
            enabled: true,
            style: {
                color: '#00bfff',
                fontSize: '10px',
                fontWeight: 90
            }
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: <?= json_encode($ScholProgFinalSeries) ?>,
        xaxis: {
            categories: <?= json_encode($ScholProgPrograms) ?>,
            labels: {
                rotate: -45,
                rotateAlways: true
            }
        },
        yaxis: {
            title: {
                text: 'Number of Scholars'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: val => val + " records"
            }
        },


        responsive: [{
            breakpoint: 768, // For tablets and phones
            options: {
                plotOptions: {
                    bar: {
                        horizontal: true // Switch to horizontal for better reading
                    }
                },
                legend: {
                    position: 'bottom'
                },
                grid: {
                    padding: {
                        left: 0, // Forces a specific starting point for the chart
                        right: 0
                    }
                },
                yaxis: {
                    labels: {
                        minWidth: 90, // Forces the label area to be at least this wide
                        maxWidth: 90, // Combined with minWidth, this locks the ratio
                        style: {
                            fontSize: '10px'
                        }
                    }
                }
            }
        }, {
            breakpoint: 480, // For small phones
            options: {
                plotOptions: {
                    bar: {
                        horizontal: true // Switch to horizontal for better reading
                    }
                },
                legend: {
                    position: 'bottom'
                },
                grid: {
                    padding: {
                        left: 0, // Forces a specific starting point for the chart
                        right: 0
                    }
                },
                xaxis: {
                    labels: {
                        show: false
                    } // Hide labels if it's way too crowded
                },
                grid: {
                    padding: {
                        left: 0, // Forces a specific starting point for the chart
                        right: 0
                    }
                },
                yaxis: {
                    labels: {
                        minWidth: 70, // Forces the label area to be at least this wide
                        maxWidth: 70 // Combined with minWidth, this locks the ratio
                    }
                }
            }
        }]

    };

    var scholarshipOverallChart = new ApexCharts(document.querySelector("#scholarshipOverallChart"), scholarshipOverallOptions);
    scholarshipOverallChart.render();












    var scholarshipTotalOptions = {
        chart: {
            type: 'bar',
            height: 500,
            toolbar: {
                show: true
            },
            width: '100%',
            redrawOnParentResize: true,
            // Add this to prevent the chart from "jumping" during the resize
            animations: {
                dynamicAnimation: {
                    enabled: true,
                    speed: 350
                }
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRasius: 10
            }
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Records',
            data: <?= json_encode($scholTotal) ?>
        }],
        xaxis: {
            categories: <?= json_encode($scholTotalLabel) ?>,
            labels: {
                rotate: -45,
                rotateAlways: true
            }
        },
        yaxis: {
            title: {
                text: 'Number of Scholars'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: val => val + " records"
            }
        },


        responsive: [{
            breakpoint: 768, // For tablets and phones
            options: {
                plotOptions: {
                    bar: {
                        horizontal: true // Switch to horizontal for better reading
                    }
                },
                legend: {
                    position: 'bottom'
                }
            }
        }, {
            breakpoint: 480, // For small phones
            options: {
                xaxis: {
                    labels: {
                        show: false
                    } // Hide labels if it's way too crowded
                }
            }
        }]

    };

    var scholarshipTotalChart = new ApexCharts(document.querySelector("#scholarshipTotalChart"), scholarshipTotalOptions);
    scholarshipTotalChart.render();








    var scholarshipStandardOptions = {
        chart: {
            type: 'bar',
            height: 200,
            toolbar: {
                show: true
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRasius: 10
            }
        },
        dataLabels: {
            enabled: true,
            style: {
                fontSize: '10px',
                fontWeight: 900

            }
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Records',
            data: <?= json_encode($scholProgUndergradData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($scholProgUndergradLabel) ?>,
            labels: {
                rotate: -45,
                rotateAlways: true
            }
        },
        yaxis: {
            title: {
                text: 'Number of Scholars'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: val => val + " records"
            }
        },


        responsive: [{
            breakpoint: 768, // For tablets and phones
            options: {
                plotOptions: {
                    bar: {
                        horizontal: true // Switch to horizontal for better reading
                    }
                },
                legend: {
                    position: 'bottom'
                }
            }
        }, {
            breakpoint: 480, // For small phones
            options: {
                xaxis: {
                    labels: {
                        show: false
                    } // Hide labels if it's way too crowded
                }
            }
        }]

    };

    var scholarshipStandardChart = new ApexCharts(document.querySelector("#scholarshipStandardChart"), scholarshipStandardOptions);
    scholarshipStandardChart.render();





    var scholarshipJLSSOptions = {
        chart: {
            type: 'bar',
            height: 200,
            toolbar: {
                show: true
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRasius: 10
            }
        },
        dataLabels: {
            enabled: true,
            style: {
                fontSize: '10px',
                fontWeight: 900

            }
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Records',
            data: <?= json_encode($scholProgJLSSData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($scholProgJLSSLabel) ?>,
            labels: {
                rotate: -45,
                rotateAlways: true
            }
        },
        yaxis: {
            title: {
                text: 'Number of Scholars'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: val => val + " records"
            }
        },


        responsive: [{
            breakpoint: 768, // For tablets and phones
            options: {
                plotOptions: {
                    bar: {
                        horizontal: true // Switch to horizontal for better reading
                    }
                },
                legend: {
                    position: 'bottom'
                }
            }
        }, {
            breakpoint: 480, // For small phones
            options: {
                xaxis: {
                    labels: {
                        show: false
                    } // Hide labels if it's way too crowded
                }
            }
        }]

    };

    var scholarshipJLSSChart = new ApexCharts(document.querySelector("#scholarshipJLSSChart"), scholarshipJLSSOptions);
    scholarshipJLSSChart.render();







    // Year Of Award
    var awardYearOptions = {
        chart: {
            type: 'line',
            height: 400,
            zoom: {
                enabled: true
            },
            toolbar: {
                show: true
            }
        },
        stroke: {
            width: 3
        },
        dataLabels: {
            enabled: true
        },
        series: <?= json_encode($yearOfAwardFinalSeries) ?>,
        xaxis: {
            categories: <?= json_encode($yearOfAwardYears) ?>,
            labels: {
                rotate: -45
            }
        },
        yaxis: {
            title: {
                text: 'Number of Scholars'
            }
        },
        tooltip: {
            y: {
                formatter: val => val + " records"
            }
        },
        markers: {
            size: 5,
            hover: {
                size: 8
            }
        }
    };

    var yearLineChart = new ApexCharts(document.querySelector("#yearChart"), awardYearOptions);
    yearLineChart.render();



    // Schools
    var schoolOptions = {
        chart: {
            type: 'bar',
            height: 200,
            toolbar: {
                show: true
            },
            width: '100%',
            redrawOnParentResize: true
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRasius: 10
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Records',
            data: <?= json_encode($schoolData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($schoolLabels) ?>,
            labels: {
                rotate: -45,
                rotateAlways: true
            }
        },
        yaxis: {
            title: {
                text: 'Number of Scholars'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: val => val + " records"
            }
        },

        responsive: [{
            breakpoint: 768, // For tablets and phones
            options: {
                plotOptions: {
                    bar: {
                        horizontal: true // Switch to horizontal for better reading
                    }
                },
                legend: {
                    position: 'bottom'
                }
            }
        }, {
            breakpoint: 480, // For small phones
            options: {
                xaxis: {
                    labels: {
                        show: false
                    } // Hide labels if it's way too crowded
                }
            }
        }]

    };

    var schoolChart = new ApexCharts(document.querySelector("#schoolChart"), schoolOptions);
    schoolChart.render();







    // Status
    var statusOptions = {
        chart: {
            type: 'bar',
            height: 200,
            toolbar: {
                show: true
            },
            width: '100%',
            redrawOnParentResize: true
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRasius: 10
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Records',
            data: <?= json_encode($statusData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($statusLabels) ?>,
            labels: {
                rotate: -45,
                rotateAlways: true
            }
        },
        yaxis: {
            title: {
                text: 'Number of Scholars'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: val => val + " records"
            }
        },


        responsive: [{
            breakpoint: 768, // For tablets and phones
            options: {
                plotOptions: {
                    bar: {
                        horizontal: true // Switch to horizontal for better reading
                    }
                },
                legend: {
                    position: 'bottom'
                }
            }
        }, {
            breakpoint: 480, // For small phones
            options: {
                xaxis: {
                    labels: {
                        show: false
                    } // Hide labels if it's way too crowded
                }
            }
        }]

    };

    var statusChart = new ApexCharts(document.querySelector("#statusChart"), statusOptions);
    statusChart.render();






    // Sets maximum Municipality Chart Height
    var max1stDistrict = <?= json_encode(max($inAklanData1st)) ?>;
    var max2ndDistrict = <?= json_encode(max($inAklanData2nd)) ?>;
    var maxMunChartHeight = Math.max(max1stDistrict, max2ndDistrict);

    maxMunChartHeight = roundUpToNearestTen(maxMunChartHeight) + 10;


    // Municipality
    var inAklanMun1stOptions = {
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: true
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRasius: 10
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Records',
            data: <?= json_encode($inAklanData1st) ?>
        }],
        xaxis: {
            categories: <?= json_encode($inAklanLabel1st) ?>,
            labels: {
                rotate: -45,
                rotateAlways: true
            }
        },
        yaxis: {
            title: {
                text: 'Number of Scholars'
            },
            min: 0,
            max: maxMunChartHeight
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: val => val + " records"
            }
        },



        responsive: [{
            breakpoint: 768, // For tablets and phones
            options: {
                plotOptions: {
                    bar: {
                        horizontal: true // Switch to horizontal for better reading
                    }
                },
                legend: {
                    position: 'bottom'
                }
            }
        }, {
            breakpoint: 480, // For small phones
            options: {
                xaxis: {
                    labels: {
                        show: false
                    } // Hide labels if it's way too crowded
                }
            }
        }]

    };

    var inAklanMun1stChart = new ApexCharts(document.querySelector("#inAklanMun1stChart"), inAklanMun1stOptions);
    inAklanMun1stChart.render();







    var inAklanMun2ndOptions = {
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: true
            },
            width: '100%',
            redrawOnParentResize: true
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRasius: 10
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Records',
            data: <?= json_encode($inAklanData2nd) ?>
        }],
        xaxis: {
            categories: <?= json_encode($inAklanLabel2nd) ?>,
            labels: {
                rotate: -45,
                rotateAlways: true
            }
        },
        yaxis: {
            title: {
                text: 'Number of Scholars'
            },
            min: 0,
            max: maxMunChartHeight
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: val => val + " records"
            }
        },


        responsive: [{
            breakpoint: 768, // For tablets and phones
            options: {
                plotOptions: {
                    bar: {
                        horizontal: true // Switch to horizontal for better reading
                    }
                },
                legend: {
                    position: 'bottom'
                }
            }
        }, {
            breakpoint: 480, // For small phones
            options: {
                xaxis: {
                    labels: {
                        show: false
                    } // Hide labels if it's way too crowded
                }
            }
        }]

    };

    var inAklanMun2ndChart = new ApexCharts(document.querySelector("#inAklanMun2ndChart"), inAklanMun2ndOptions);
    inAklanMun2ndChart.render();






    var outAklanMunOptions = {
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: true
            },
            width: '100%',
            redrawOnParentResize: true
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRasius: 10
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Records',
            data: <?= json_encode($outAklanMunData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($outAklanMunLabel) ?>,
            labels: {
                rotate: -45,
                rotateAlways: true
            }
        },
        yaxis: {
            title: {
                text: 'Number of Scholars'
            },
            min: 0,
            max: maxMunChartHeight
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: val => val + " records"
            }
        },


        responsive: [{
            breakpoint: 768, // For tablets and phones
            options: {
                plotOptions: {
                    bar: {
                        horizontal: true // Switch to horizontal for better reading
                    }
                },
                legend: {
                    position: 'bottom'
                }
            }
        }, {
            breakpoint: 480, // For small phones
            options: {
                xaxis: {
                    labels: {
                        show: false
                    } // Hide labels if it's way too crowded
                }
            }
        }]

    };

    var outAklanMunChart = new ApexCharts(document.querySelector("#outAklanMunChart"), outAklanMunOptions);
    outAklanMunChart.render();


    function roundUpToNearestTen(num) {
        // Divide by 10 to shift the tens place to the ones place (e.g., 23 -> 2.3)
        const divided = num / 10;

        // Use Math.ceil() to round the number up to the next whole integer (e.g., 2.3 -> 3)
        const roundedUp = Math.ceil(divided); // See MDN Web Docs for Math.ceil()

        // Multiply by 10 to shift the number back to its original scale (e.g., 3 -> 30)
        const result = roundedUp * 10;

        return result;
    }


















    // Report Generation

    //HiResGenereation



    // MAIN FUNCTION:
    async function generateFullReport() {
        try {
            //  console.log("Starting report generation...");

            // --- STEP A: CAPTURE YOUR CHARTS ---
            const img1 = await getChartSnapshot(scholarshipTotalOptions);
            const img2 = await getChartSnapshot(scholarshipStandardOptions);
            const img3 = await getChartSnapshot(scholarshipJLSSOptions);
            const img4 = await getChartSnapshot(awardYearOptions);
            const img5 = await getChartSnapshot(schoolOptions);
            const img6 = await getChartSnapshot(statusOptions);
            const img7 = await getChartSnapshot(inAklanMun1stOptions);
            const img8 = await getChartSnapshot(inAklanMun2ndOptions);
            const img9 = await getChartSnapshot(outAklanMunOptions);

            // --- STEP B: OPEN THE PRINT WINDOW ---
            const printWindow = window.open('', '_blank');

            printWindow.document.write(`
            <html>
            <head>
                <title>Scholarship Statistics Report</title>
                <style>
                    body { font-family: 'Segoe UI', Tahoma, sans-serif; padding: 50px; line-height: 1.6; }
                    .header { text-align: center; border-bottom: 2px solid #333; margin-bottom: 30px; }
                    .chart-box { page-break-inside: avoid; margin-bottom: 40px; text-align: center; }
                    img { width: 100%; border: 1px solid #ddd; margin-top: 10px; }
                    h2 { color: #0056b3; text-align: left; }
                </style>
            </head>
            <body>
                <div class="header">
                    <h1>Department Of Science and Technology</h1>
                    <h3>Aklan Field Office</h3>
                    <h3>Scholarship Management System Report</h3>
                    <p>Generated: ${new Date().toLocaleDateString()}</p>
                </div>

                <div class="chart-box">
                    <h2>Overall Scholarship Programs</h2>
                    <img src="${img1}" />
                </div>

                <div class="chart-box">
                    <h2>Undergraduate Programs</h2>
                    <img src="${img2}" />
                </div>

                <div class="chart-box">
                    <h2>JLSS Programs</h2>
                    <img src="${img3}" />
                </div>

                <div class="chart-box">
                    <h2>Year Of Awards</h2>
                    <img src="${img4}" />
                </div>

                <div class="chart-box">
                    <h2>School</h2>
                    <img src="${img5}" />
                </div>

                <div class="chart-box">
                    <h2>Status</h2>
                    <img src="${img6}" />
                </div>

                <div class="chart-box">
                    <h2>Within Aklan: District 1</h2>
                    <img src="${img7}" />
                </div>

                <div class="chart-box">
                    <h2>Within Aklan: District 2</h2>
                    <img src="${img8}" />
                </div>

                <div class="chart-box">
                    <h2>Outside Aklan</h2>
                    <img src="${img9}" />
                </div>

                <script>
                    window.onload = function() {
                        window.print();
                    };
                <\/script>
            </body>
            </html>
        `);

            printWindow.document.close();

        } catch (error) {
            console.error("Report failed:", error);
            alert("There was an error generating the report images.");
        }
    }



    // HELPER: This function turns ANY chart config into a high-res image string
    async function getChartSnapshot(chartOptions) {
        const slot = document.querySelector("#temp-slot");

        // Create high-res settings based on whatever chart we pass in
        const highResOptions = {
            ...chartOptions,
            chart: {
                ...chartOptions.chart,
                width: 1200,
                height: 600,
                animations: {
                    enabled: false
                }
            }
        };

        const tempChart = new ApexCharts(slot, highResOptions);
        await tempChart.render();

        // Give the browser a split second to finish the "paint"
        await new Promise(r => setTimeout(r, 450));

        const data = await tempChart.dataURI();

        tempChart.destroy();
        slot.innerHTML = ''; // Clean the slot for the next chart

        return data.imgURI;
    }




    async function downloadPDFReport() {
        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF('p', 'mm', 'a4'); // Portrait, Millimeters, A4 size

        // Capture the images using your existing helper
        const img1 = await getChartSnapshot(scholarshipTotalOptions);
        const img2 = await getChartSnapshot(scholarshipStandardOptions);
        const img3 = await getChartSnapshot(scholarshipJLSSOptions);
        const img4 = await getChartSnapshot(awardYearOptions);
        const img5 = await getChartSnapshot(schoolOptions);
        const img6 = await getChartSnapshot(statusOptions);
        const img7 = await getChartSnapshot(inAklanMun1stOptions);
        const img8 = await getChartSnapshot(inAklanMun2ndOptions);
        const img9 = await getChartSnapshot(outAklanMunOptions);

        // Add Title
        doc.setFontSize(20);
        doc.text("Scholarship Report", 105, 20, {
            align: "center"
        });

        doc.setFontSize(14);
        doc.text("Overall Scholarship Programs", 20, 40);
        // addImage(data, type, x, y, width, height)
        doc.addImage(img1, 'PNG', 15, 45, 180, 90);

        doc.text("Undergraduate Programs", 20, 150);
        doc.addImage(img2, 'PNG', 15, 155, 180, 90);

        doc.addPage();

        doc.text("JLSS Scholarship Programs", 20, 20);
        doc.addImage(img3, 'PNG', 15, 25, 180, 90);

        doc.text("Year Of Award", 20, 130);
        doc.addImage(img4, 'PNG', 15, 135, 180, 90);
        
        doc.addPage();

        doc.text("Schools", 20, 20);
        doc.addImage(img5, 'PNG', 15, 25, 180, 90);

        doc.text("Status", 20, 130);
        doc.addImage(img6, 'PNG', 15, 135, 180, 90);

        doc.addPage();

        doc.text("Within Aklan: District 1", 20, 20);
        doc.addImage(img7, 'PNG', 15, 25, 180, 90);

        doc.text("Within Aklan: District 2", 20, 130);
        doc.addImage(img8, 'PNG', 15, 135, 180, 90);

        doc.addPage();

        doc.text("Outside Aklan", 20, 20);
        doc.addImage(img9, 'PNG', 15, 25, 180, 90);

        

        // Save the file
        doc.save("Scholarship_Report.pdf");
    }
</script>