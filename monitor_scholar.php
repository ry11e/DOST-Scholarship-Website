<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'includes/connection.php';



$scholarId = $_GET['id'] ?? null;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action_type'] ?? "";
    $scholarId = $_POST['scholar_id'] ?? null;
    $entryId = $_POST['entry_id'] ?? null;

    if (!$scholarId) {
        die("Error: No scholar ID provided. Please go back to the dashboard.");
    }

    switch($action){
        case "delete":
            $deleteSql = "Update monitor_scholars Set status = 'inactive' where id = ? AND scholar_id = ?";
            $stmt = $conn->prepare($deleteSql);
            $stmt->bind_param("ii", $entryId, $scholarId);
            $stmt->execute();

            $message = $stmt->affected_rows > 0 ? "Entry Deleted." : "No changes or entry not found.";
            $stmt->close();

            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $scholarId . "?msg=" . urlencode($message));
            exit;
        break;

        case"add_new_entry":
            $addSql = "Insert Into monitor_scholars(scholar_id) value(?)";
            $stmt = $conn->prepare($addSql);
            $stmt->bind_param("i", $scholarId);
            $stmt->execute();

            $message = $stmt->affected_rows > 0 ? "Entry Added." : "No changes or entry inserted.";
            $stmt->close();

            header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $scholarId . "?msg=" . urlencode($message));
        break;

        default:

    }
}


// Retrieve Everything
// Ensure scholarId exists before querying
if ($scholarId) {
    // Use Prepared Statements here too for safety!
    $sql = "SELECT * FROM monitor_scholars WHERE scholar_id = ? AND status = 'active'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $scholarId);
    $stmt->execute();
    $allResult = $stmt->get_result();
} else {
    // Fallback if no ID is found
    die("Invalid Scholar ID.");
}



echo $scholarId;

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
                            <h1 class="h1">Monitoring</h1>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-6 col-lg-6">
                    </div>
                    <div class="col-6 col-lg-6 text-end">
                        <form action="monitor_scholar.php" method="POST">
                            <input type="text" name="action_type" value="add_new_entry" hidden>
                            <input type="number" name="scholar_id" value="<?= $scholarId ?>" hidden>
                            <input type="submit" value="Add New Entry" class="btn btn-success">
                        </form>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12 col-lg-12">
                        <table  class="data-table table no-wrap table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="datatable">Date</th>
                                    <th class="datatable">Details</th>
                                    <th class="datatable">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $allResult->fetch_assoc()): // While Loop A?>
                                    <tr>
                                        <td><?= $row['date'] ?></td>
                                        <td><?= $row['details'] ?></td>
                                        <td>
                                            <form action="monitor_scholar.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this scholar?');">
                                                <input type="text" name="action_type"  value="delete" hidden>
                                                <input type="number" name="scholar_id"  value="<?= $scholarId?>" hidden>
                                                <input type="number" name="entry_id" value="<?= htmlspecialchars($row['id']) ?>" hidden>
                                                <input type="submit" class="button is-danger" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile; // While Loop A?>
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