<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'includes/connection.php';


$task=$_GET['task'] ?? "";
if($task == "resetSearch"){
    resetSearchQueries();
}

$initialStatus = "";
$defaultStatus = "";
$status = $defaultStatus;
$sql = "SELECT * FROM scholars WHERE status = '$defaultStatus'";

$name ="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Reset SQL to a base query
    $sql = "SELECT * FROM scholars WHERE 1";

    $_SESSION['monitor_scholar_status_search'] = $_POST['status'] ?? null;
    $_SESSION['monitor_scholar_name_search'] = $_POST['name'] ?? null;

    if (!empty($_POST['status'])) {
        if( strtolower($_SESSION['monitor_scholar_status_search'])  == "graduated" ){
            $sql .= " AND year_graduated IS NOT NULL";
        }  
        else{
            $status = $_POST['status'];
            $sql .= " AND status = '$status'";
        }
        
    }
    if(!empty($_POST['name'])){
        $name = $_POST['name'];
        $sql.= " AND name LIKE '%$name%'";
    }
}
else if((!empty($_SESSION['monitor_scholar_status_search'])) || (!empty($_SESSION['monitor_scholar_name_search']))) {
    $sql = "SELECT * FROM scholars WHERE 1";
    if(!empty($_SESSION['monitor_scholar_status_search'])){
        if( strtolower($_SESSION['monitor_scholar_status_search'])  == "graduated"){
            $sql .= " AND year_graduated IS NOT NULL";
        }
        else{
            $status = $_SESSION['monitor_scholar_status_search'];
            $sql .= " AND status = '$status'";
        }
        
    }
    if(!empty($_SESSION['monitor_scholar_name_search'])){
        $name = $_SESSION['monitor_scholar_name_search'];
        $sql.= " AND name LIKE '%$name%'";
    }  
}
else{
    $sql = "SELECT * FROM scholars WHERE 1 Order by status";
}


$currentStatus = $_SESSION['monitor_scholar_status_search'] ?? $defaultStatus;
$searchedStatus = $_SESSION['monitor_scholar_status_search'] ?? $initialStatus;

$currentName = $name;
$allResult = $conn->query($sql);


$monitorScholarSql = "SELECT scholar_id, count(*) as total FROM `monitor_scholars` where status = 'active' group by scholar_id";
$stmt = $conn->query($monitorScholarSql);
$monitorScholarArray = $stmt->fetch_all(MYSQLI_ASSOC);





$searchStatusClass = "";
switch($currentStatus){
    case "Problematic":
        $searchStatusClass = " bg-danger-subtle-1";
    break;
    case "Graduated":
        $searchStatusClass = " bg-success-subtle-1";
    break;
    case "Updated":
        $searchStatusClass = " bg-info-subtle-1";
    break;
    default:
        $searchStatusClass = " bg-secondary-subtle";

}

function resetSearchQueries(){
    unset($_SESSION['monitor_scholar_status_search']);
    unset($_SESSION['monitor_scholar_name_search']);
}


include_once 'includes/head.php';
include_once 'includes/sidebar.php';
?>

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box pd-30">



            <div class="container-fluid mt-4 mb-4">
                <div class="row mb-4">
                    <div class="col-9">
                        <div class="d-flex justify-content-between align-items-center  pl-3">
                            <h1 class="h1">Monitoring Dashboard</h1>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12 col-lg-12">
                        <form method="POST" action="monitoring.php">
                            <!-- Status Selector -->
                            <div class="row d-flex px-5">
                                <div class=" d-flex col-4 align-items-center">
                                    <input id="statusField" list="statusOptions" class="form-control ms-2 " name="status" placeholder="Search by Status" value="<?= $searchedStatus ?? '' ?>"/>
                                    <datalist id="statusOptions">
                                        <?php
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }
                                        // Fetch distinct statuses from the database for the datalist
                                        $statusSql = "SELECT fld_scholarshipStatus FROM tbl_scholar_status";
                                        $statusRes = $conn->query($statusSql);
                                        while ($row = $statusRes->fetch_assoc()) {
                                            echo "<option value='" . htmlspecialchars($row['fld_scholarshipStatus']) . "'>";
                                        }
                                        ?>
                                    </datalist>
                                    
                                </div>
                                <div class="col-5">
                                    <input type="text" class="form-control" name="name" placeholder="Search By Name" value="<?= $currentName ?? $name ?>">
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="monitoring.php?task=resetSearch" class="btn btn-secondary">Reload</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12 col-lg-12">
                        <div class="bg-secondary-subtle border rounded-top-2 pb-2 mt-3 ">

                            <div class="mt-2 mx-2 fs-7 d-flex align-items-center">
                                Status: 
                                <div id="monitor-table-status-display" class=" <?= htmlspecialchars($searchStatusClass) ?> px-1 rounded-2">
                                    <?= $currentStatus ?? $defaultStatus ?>
                                </div>
                            </div>
                            
                            <table id="monitoring-table" class="data-table table no-wrap table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="datatable" style="width: 5%">#</th>
                                        <th class="datatable" style="width: 9%">ID</th>
                                        <th class="datatable" style="width: 50">Name</th>
                                        <th class="datatable" style="width: 15%">Status</th>
                                        <th class="datatable" style="width: 10%">Entries</th>
                                        <th class="datatable" style="width: 11%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $tableCounter = 1;
                                    // start of table loop A
                                    while ($row = $allResult->fetch_assoc()):
                                    ?>

                                    <?php
                                        $statusClass = "";
                                        switch ($row["status"]) {
                                            case "Updated":
                                                $statusClass = "bg-info-subtle-1 text-info";
                                                break;
                                            case "Graduated":
                                                $statusClass = "bg-success-subtle-1 text-success";
                                                break;
                                            case "Problematic":
                                                if(!empty($row['year_graduated'])){
                                                    $statusClass = "bg-warning-subtle-1 text-warning";
                                                }
                                                else{
                                                    $statusClass = "bg-danger-subtle-1 text-danger";
                                                }
                                                
                                                break;
                                            default:
                                                $statusClass = "bg-secondary-subtle text-secondary";
                                        }
                                        if($row['year_graduated']){
                                            $statusClass = "bg-success-subtle-1 text-success";
                                        }
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($tableCounter) ?></td>
                                            <td class="text-center">
                                                <div class="bg-success-subtle-1 d-flex justify-content-center px-2 rounded-2">
                                                    <?= htmlspecialchars($row['id']) ?> 
                                                </div>

                                                
                                            </td>
                                            <td><?= htmlspecialchars($row["name"]) ?></td>
                                            <td>
                                                <div class="<?= $statusClass ?> d-flex justify-content-center px-2 rounded-2">
                                                    <?= htmlspecialchars( $row['year_graduated'] ? 'Graduated' : $row["status"]) ?> 
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="bg-info-subtle-1 d-flex justify-content-center px-2 rounded-2 ">
                                                    <?php
                                                        foreach($monitorScholarArray as $row2){
                                                            if($row2['scholar_id'] == $row['id']){
                                                                echo htmlspecialchars($row2['total']);
                                                            }
                                                        };
                                                    ?>
                                                </div>
                                            </td>
                                            <td >
                                                <div class='table-actions d-flex gap-2 '>
                                                    <a href=<?= "monitor_scholar.php?id=" . $row["id"]; ?> class='btn btn-sm btn-outline-primary shadow-sm ms-5'>
                                                        <i class='icon-copy dw dw-edit2'></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php
                                        $tableCounter++;
                                        endwhile; // End of table loop A
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







<!-- JS Scripts -->
<script src="vendors/scripts/core.js"></script>
<script src="src/scripts/custom_scripts.js"></script>
<script src="vendors/scripts/script.min.js"></script>
<script src="vendors/scripts/process.js"></script>
<script src="vendors/scripts/layout-settings.js"></script>
<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="vendors/scripts/dashboard3.js"></script>




<?php
$conn->close();
?>