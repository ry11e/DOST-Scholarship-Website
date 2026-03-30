<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'includes/connection.php';


$task=$_GET['task'];
if($task == "resetSearch"){
    resetSearchQueries();
}

$defaultStatus = "Problematic";
$sql = "SELECT * FROM scholars WHERE status = '$defaultStatus'";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Reset SQL to a base query
    $sql = "SELECT * FROM scholars WHERE 1";

    $_SESSION['monitor_scholar_status_search'] = $_POST['status'] ?? null;

    if (!empty($_POST['status'])) {
        $status = $_POST['status'];
        // Override the default with the user's selection
        $sql .= " AND status = '$status'";
    }
}
else if(!empty($_SESSION['monitor_scholar_status_search'])){
    $sql = "SELECT * FROM scholars WHERE 1";
    $status = $_SESSION['monitor_scholar_status_search'];
    $sql .= " AND status = '$status'";
}


$currentStatus = $status;
$allResult = $conn->query($sql);



function resetSearchQueries(){
    unset($_SESSION['monitor_scholar_status_search']);
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
                    <div class="col-12 col-lg-7">
                        <form method="POST" action="monitoring.php">
                            <!-- Status Selector -->
                            <div class="row">
                                <div class="col-6">
                                    <input list="statusOptions" class="form-control" name="status" placeholder="Search by Status" value="<?= $currentStatus ?? $defaultStatus ?>"/>
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
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <a href="monitoring.php?task=resetSearch" class="btn btn-secondary">Reload</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12 col-lg-12">
                        <table class="data-table table no-wrap table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="datatable" style="width: 15%">#</th>
                                    <th class="datatable" style="width: 35%">Name</th>
                                    <th class="datatable" style="width: 35%">Status</th>
                                    <th class="datatable" style="width: 15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // start of table loop A
                                while ($row = $allResult->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row["id"]) ?></td>
                                        <td><?= htmlspecialchars($row["name"]) ?></td>
                                        <td><?= htmlspecialchars($row["status"]) ?></td>
                                        <td>
                                            <div class='table-actions d-flex gap-2 '>
                                                <a href=<?= "monitor_scholar.php?id=" . $row["id"]; ?> class='btn btn-sm btn-outline-primary shadow-sm ms-5'>
                                                    <i class='icon-copy dw dw-edit2'></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endwhile; // End of table loop A
                                ?>
                            </tbody>
                        </table>
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




<?php
$conn->close();
?>