<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'includes/connection.php';


// Retrieve Everything
$sql = "Select * From scholars where 1";
$allResult = $conn->query($sql);






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
                        <h5 class="h5 mb-3">Currently In Development</h5>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12 col-lg-12">
                        <table class="data-table table no-wrap table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="datatable">#</th>
                                    <th class="datatable">Name</th>
                                    <th class="datatable">Status</th>
                                    <th class="datatable">Action</th>
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
                                                <a href=<?= "monitor_scholar.php?id=". $row["id"]; ?> class='btn btn-sm btn-outline-primary shadow-sm ms-5'>
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