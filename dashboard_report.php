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


    $schoolProgNormData = [];
    $schoolProgNormLabel = [];

    $schoolProgJLSSData = [];
    $schoolProgJLSSLabel = [];



    $sqlScholarshipPrograms = "
        SELECT `scholarship_program`, COUNT(`scholarship_program`) AS total FROM `scholars` GROUP BY `scholarship_program`
    ";
    $resultBar = $conn->query($sqlScholarshipPrograms);

    while ($row = $resultBar->fetch_assoc()) {
        
        if(  stripos($row["scholarship_program"], "JLSS") !== false  ){
            $schoolProgJLSSLabel[] = $row['scholarship_program'];
            $schoolProgJLSSData[]   = (int)$row['total'];
        }
        else{
            $schoolProgNormLabel[] = $row['scholarship_program'];
            $schoolProgNormData[]   = (int)$row['total'];
        }


        //$scholProgLabels[] = $row['scholarship_program'];
        //$scholProgData[]   = (int)$row['total'];
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

    $inAklanMunData = [];
    $inAklanMunLabel = [];

    $outAklanMunData = [];
    $outAklanMunLabel = [];



    $inAklanData1st = [];
    $inAklanLabel1st = [];

    $inAklanData2nd = [];
    $inAklanLabel2nd = [];



    $municipalityTableSql = "select fld_municipality, fld_district from tbl_municipalities";
    $munTableResult = $conn->query($municipalityTableSql);

    $aklanMunicipalities = array_column($munTableResult->fetch_all(MYSQLI_ASSOC), "fld_municipality");
    $aklanMunicipalitiesDistrict = array_column($munTableResult->fetch_all(MYSQLI_ASSOC), "fld_district");

    
    $municipalitySql = "Select `district`,`municipality`, COUNT(municipality) as total from `scholars` Group By `municipality`";
    $resultMunicipality = $conn->query($municipalitySql);


    while($row = $resultMunicipality->fetch_assoc()){
        if( isInAklan($row["municipality"]) ){
            //$inAklanMunData[] = $row["total"];
            //$inAklanMunLabel[] = $row["municipality"];

            if( $row["district"] == "1st"){
                $inAklanData1st[] = $row["total"];
                $inAklanLabel1st[] = $row["municipality"];
            }
            else if($row["district"] == "2nd"){
                $inAklanData2nd[] = $row["total"];
                $inAklanLabel2nd[] = $row["municipality"];
            }
        }
        else{
            $outAklanMunData[] = $row["total"];
            $outAklanMunLabel[] = $row["municipality"];
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



    


    function isInAklan($municipality){
        global $aklanMunicipalities;


        if(in_array($municipality, $aklanMunicipalities)){
            return true;
        }
        else{
            return false;
        }
    }

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
                        <div id="scholarshipNormChart" style="height:350px;"></div>
                    </div>
                </div>
                <div class="col">
                    <div class="chart-container">
                        <h2>JLSS Scholarship Programs</h2>
                        <div id="scholarshipJLSSChart" style="height:350px;"></div>
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

            <div class="row" style="gap: 50px;">
                <div class = "col">
                    <div class="reports-chart-container">
                        <h2>Year Of Program</h2>
                        <div id="yearChart" style="height:350px;"></div>
                    </div>
                </div>  
                <div class = "col">
                    <div class="reports-chart-container">
                        <h2>Out Of Aklan Municipalities</h2>
                        <div id="outAklanMunChart" style="height:350px;"></div>
                    </div>
                </div>  
                
            </div>

            <div class= "row" style="gap: 50px;">
                <div class = "col">
                    <div class="reports-chart-container">
                        <h2>Within Aklan: District 1</h2>
                        <div id="inAklanMun1stChart" style="height:350px;"></div>
                    </div>
                </div>
                <div class = "col">
                    <div class="reports-chart-container">
                        <h2>Within Aklan: District 2</h2>
                        <div id="inAklanMun2ndChart" style="height:350px;"></div>
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
    var scholarshipNormOptions = {
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
            data: <?= json_encode($schoolProgNormData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($schoolProgNormLabel) ?>,
            labels: { rotate: -45, rotateAlways: true }
        },
        yaxis: { title: { text: 'Number of Scholars' } },
        fill: { opacity: 1 },
        tooltip: { y: { formatter: val => val + " records" } },
        
    };

    var scholarshipNormChart = new ApexCharts(document.querySelector("#scholarshipNormChart"), scholarshipNormOptions);
    scholarshipNormChart.render();


    var scholarshipJLSSOptions = {
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
            data: <?= json_encode($schoolProgJLSSData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($schoolProgJLSSLabel) ?>,
            labels: { rotate: -45, rotateAlways: true }
        },
        yaxis: { title: { text: 'Number of Scholars' } },
        fill: { opacity: 1 },
        tooltip: { y: { formatter: val => val + " records" } },
        
    };

    var scholarshipJLSSChart = new ApexCharts(document.querySelector("#scholarshipJLSSChart"), scholarshipJLSSOptions);
    scholarshipJLSSChart.render();



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






    // Sets maximum Municipality Chart Height
    var max1stDistrict = <?= json_encode( max($inAklanData1st) ) ?>;
    var max2ndDistrict = <?= json_encode( max($inAklanData2nd) ) ?>;
    var maxMunChartHeight = Math.max(max1stDistrict, max2ndDistrict);

    maxMunChartHeight = roundUpToNearestTen(maxMunChartHeight) + 10;


    // Municipality
    var inAklanMun1stOptions = {
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
            data: <?= json_encode($inAklanData1st) ?>
        }],
        xaxis: {
            categories: <?= json_encode($inAklanLabel1st) ?>,
            labels: { rotate: -45, rotateAlways: true }
        },
        yaxis: { title: { 
            text: 'Number of Scholars' },   
            min: 0,
            max: maxMunChartHeight
        },
        fill: { opacity: 1 },
        tooltip: { y: { formatter: val => val + " records" } },
        
    };

    var inAklanMun1stChart = new ApexCharts(document.querySelector("#inAklanMun1stChart"), inAklanMun1stOptions);
    inAklanMun1stChart.render();







    var inAklanMun2ndOptions = {
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
            data: <?= json_encode($inAklanData2nd) ?>
        }],
        xaxis: {
            categories: <?= json_encode($inAklanLabel2nd) ?>,
            labels: { rotate: -45, rotateAlways: true }
        },
        yaxis: { 
            title: { text: 'Number of Scholars' },
            min: 0,
            max: maxMunChartHeight
         },
        fill: { opacity: 1 },
        tooltip: { y: { formatter: val => val + " records" } },
        
    };

    var inAklanMun2ndChart = new ApexCharts(document.querySelector("#inAklanMun2ndChart"), inAklanMun2ndOptions);
    inAklanMun2ndChart.render();






    var outAklanMunOptions = {
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
            data: <?= json_encode($outAklanMunData) ?>
        }],
        xaxis: {
            categories: <?= json_encode($outAklanMunLabel) ?>,
            labels: { rotate: -45, rotateAlways: true }
        },
        yaxis: { 
            title: { text: 'Number of Scholars' },
            min: 0,
            max: maxMunChartHeight
         },
        fill: { opacity: 1 },
        tooltip: { y: { formatter: val => val + " records" } },
        
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

</script>


