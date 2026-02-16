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

    $sqlScholarshipPrograms = "
        SELECT `scholarship_program`, COUNT(`scholarship_program`) AS total FROM `scholars` GROUP BY `scholarship_program`
    ";
    $resultBar = $conn->query($sqlScholarshipPrograms);

    while ($row = $resultBar->fetch_assoc()) {
        $scholProgLabels[] = $row['scholarship_program'];
        $scholProgData[]   = (int)$row['total'];
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
    while($row = $statusResult->fetch_assoc()){

        $status = "AAA";
        if(empty($row['status']) || $row['status'] == " "){
            $status = "<blank>";
        }
        else{
            $status = $row['status'];
        }
        
        $statusLabels[] = $status;
        $statusData[] = (int)$row['total'];
    }




    $municipalityData = [];
    $muncipalityLabel = [];
    
    $municipalitySql = "Select `municipality`, COUNT(municipality) as total from `scholars` Group By `municipality`";

    $resultMunicipality = $conn->query($municipalitySql);

    while($row = $resultMunicipality->fetch_assoc()){
        $municipalityData[] = $row['total'];
        $municipalityLabel[] =  $row['municipality'];
    }




    $totalScholars = 0;
    $totalSql = "select * from `scholars`";
    $totalResult = $conn->query($totalSql);
    $totalScholars = mysqli_num_rows($totalResult);

    //echo $totalScholars;



    $conn->close();

?>

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box pb-10" style="padding: 40px;">

        <div class="row" style="padding-bottom: 30px;" hidden>
            <div class="col" style="display: flex;
                                    justify-content: center;
                                    
                                    ;
                                    ">
                <div id = "reports-total-records" style="width: fit-content;
                                                        border: 1px solid #8edbddc7;
                                                        border-radius: 10px;
                                                        background-color: #e5ffff85;
                                                        padding: 30px;
                                                        font-size: 1.1rem;
                                                        ">
                    Number Of Scholars: <?php echo $totalScholars?>
                </div>
            </div>
        </div>

            <div class="row" style="gap: 50px;">
                <div class="col">
                    <div class="reports-chart-container">
                        <h2>Scholarship Programs</h2>
                        <div id="scholarshipChart" style="height:350px;"></div>
                    </div>
                </div>
                <div class="col">
                    <div class="chart-container">
                        <h2>Year Of Awards</h2>
                        <div id="yearChart" style="height:350px;"></div>
                    </div>
                </div>
            </div>
            <div class="row" style="gap: 50px;">
                <div class = "col">
                    <div class="reports-chart-container">
                        <h2>Schools</h2>
                        <div id="schoolChart" style="height:350px;"></div>
                    </div>
                </div>  
                <div class = "col">
                    <div class="reports-chart-container">
                        <h2>Status</h2>
                        <div id="statusChart" style="height:350px;"></div>
                    </div>
                </div>  
                
            </div>
            <div class= "row" style="gap: 50px;">
                <div class = "col">
                    <div class="reports-chart-container">
                        <h2>Municipalities</h2>
                        <div id="municipalityChart" style="height:350px;"></div>
                    </div>
                </div>

            </div>
        








        </div>
    </div>
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





<script>
    // Scholarship Program
    var scholarshipOptions = {
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: true }
        },
        plotOptions: {
            bar: { horizontal: false, columnWidth: '55%', borderRasius: 10 }
        },
        dataLabels: { enabled: false },
        stroke: { show: true, width: 2, colors: ['transparent'] },
        series: [{
            name: 'Records',
            data: <?= json_encode($scholProgData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($scholProgLabels) ?>,
            labels: { rotate: -45, rotateAlways: true }
        },
        yaxis: { title: { text: 'Number of Scholars' } },
        fill: { opacity: 1 },
        tooltip: { y: { formatter: val => val + " records" } },
        
    };

    var barChart = new ApexCharts(document.querySelector("#scholarshipChart"), scholarshipOptions);
    barChart.render();



    // Year Of Award
    var awardYearOptions = {
        chart: {
            type: 'line',
            height: 350,
            zoom: { enabled: true },
            toolbar: { show: true }
        },
        stroke: { width: 3 },
        series: [{
            name: 'Records',
            data: <?= json_encode($awardYearData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($awardYearLabels) ?>,
            labels: { rotate: -45 }
        },
        yaxis: { title: { text: 'Number of Scholars' } },
        tooltip: { y: { formatter: val => val + " records" } },
        markers: { size: 5, hover: { size: 8 } }
    };

    var lineChart = new ApexCharts(document.querySelector("#yearChart"), awardYearOptions);
    lineChart.render();



    // Schools
    var schoolOptions = {
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: true }
        },
        plotOptions: {
            bar: { horizontal: false, columnWidth: '55%', borderRasius: 10 }
        },
        dataLabels: { enabled: false },
        stroke: { show: true, width: 2, colors: ['transparent'] },
        series: [{
            name: 'Records',
            data: <?= json_encode($schoolData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($schoolLabels) ?>,
            labels: { rotate: -45, rotateAlways: true }
        },
        yaxis: { title: { text: 'Number of Scholars' } },
        fill: { opacity: 1 },
        tooltip: { y: { formatter: val => val + " records" } },
        
    };

    var schoolChart = new ApexCharts(document.querySelector("#schoolChart"), schoolOptions);
    schoolChart.render();







     // Status
    var statusOptions = {
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: true }
        },
        plotOptions: {
            bar: { horizontal: false, columnWidth: '55%', borderRasius: 10 }
        },
        dataLabels: { enabled: false },
        stroke: { show: true, width: 2, colors: ['transparent'] },
        series: [{
            name: 'Records',
            data: <?= json_encode($statusData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($statusLabels) ?>,
            labels: { rotate: -45, rotateAlways: true }
        },
        yaxis: { title: { text: 'Number of Scholars' } },
        fill: { opacity: 1 },
        tooltip: { y: { formatter: val => val + " records" } },
        
    };

    var statusChart = new ApexCharts(document.querySelector("#statusChart"), statusOptions);
    statusChart.render();















    // Municipality
    var municipalityOptions = {
        chart: {
            type: 'bar',
            height: 350,
            toolbar: { show: true }
        },
        plotOptions: {
            bar: { horizontal: false, columnWidth: '55%', borderRasius: 10 }
        },
        dataLabels: { enabled: false },
        stroke: { show: true, width: 2, colors: ['transparent'] },
        series: [{
            name: 'Records',
            data: <?= json_encode($municipalityData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($municipalityLabel) ?>,
            labels: { rotate: -45, rotateAlways: true }
        },
        yaxis: { title: { text: 'Number of Scholars' } },
        fill: { opacity: 1 },
        tooltip: { y: { formatter: val => val + " records" } },
        
    };

    var municipalityChart = new ApexCharts(document.querySelector("#municipalityChart"), municipalityOptions);
    municipalityChart.render();




</script>


