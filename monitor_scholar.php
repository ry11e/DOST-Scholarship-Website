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
    $date = $_POST['date'] ?? "";
    $details = $_POST['details'] ?? "";

    if (!$scholarId) {
        die("Error: No scholar ID provided. Please go back to the dashboard.");
    }

    switch ($action) {

        case "save":

            if (!$entryId) {
                die("Entry Id is Nonexistent");
            }
            if (!$scholarId) {
                die("Error: No scholar ID provided.");
            }

            $saveSql = "Update monitor_scholars SET date = ?, details = ? Where id = ? AND scholar_id = ?";
            $stmt = $conn->prepare($saveSql);
            $stmt->bind_param("ssii", $date, $details, $entryId, $scholarId);
            $stmt->execute();

            $message = $stmt->affected_rows > 0 ? "Entry Saved." : "Changes not saved. EntryID" . $entryId . "ScholarID" . $scholarId;
            $stmt->close();

            header("Location: {$_SERVER['PHP_SELF']}?id={$scholarId}&msg=" . urlencode($message));
            exit;
            break;
        case "delete":
            $deleteSql = "Update monitor_scholars Set status = 'inactive' where id = ? AND scholar_id = ?";
            $stmt = $conn->prepare($deleteSql);
            $stmt->bind_param("ii", $entryId, $scholarId);
            $stmt->execute();

            $message = $stmt->affected_rows > 0 ? "Entry Deleted." : "No changes or entry not found.";
            $stmt->close();

            header("Location: {$_SERVER['PHP_SELF']}?id={$scholarId}&msg=" . urlencode($message));
            exit;
            break;

        case "add_new_entry":
            $addSql = "Insert Into monitor_scholars(scholar_id) value(?)";
            $stmt = $conn->prepare($addSql);
            $stmt->bind_param("i", $scholarId);
            $stmt->execute();

            $message = $stmt->affected_rows > 0 ? "Entry Added." : "No changes or entry inserted.";
            $stmt->close();

            header("Location: {$_SERVER['PHP_SELF']}?id={$scholarId}&msg=" . urlencode($message));
            break;
        case "add_new_record":
            $addRecSql = "Insert Into monitor_scholars(scholar_id, date, details) Values(?, ? , ?);";
            $stmt = $conn->prepare($addRecSql);
            $stmt->bind_param("iss", $scholarId, $date, $details);
            $stmt->execute();

            $message = $stmt->affected_rows > 0 ? "Entry Added." : "No changes or entry inserted.";
            $stmt->close();

            header("Location: {$_SERVER['PHP_SELF']}?id={$scholarId}&msg=" . urlencode($message));
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


// Use Prepared Statements here too for safety!
$sql = "SELECT * FROM scholars WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $scholarId);
$stmt->execute();
$scholar = $stmt->get_result();
$scholarArray = $scholar->fetch_all(MYSQLI_ASSOC);


//echo $scholarId;

include_once 'includes/head.php';
include_once 'includes/sidebar.php';
?>

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box pd-30">



            <div id="report-area" class="container-fluid mt-4 mb-4">
                <div class="row mb-4">
                    <div class="col-9">
                        <div class="d-flex justify-content-between align-items-center  pl-3">
                            <h1 class="h1"><?= $scholarArray[0]['name'] ?></h1>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-6 col-lg-6">
                        <a href="monitoring.php" class="btn btn-secondary mon-schol-no-pdf">Back</a>
                    </div>
                    <div class="col-6 col-lg-6 text-end">
                        <button type="button"
                            class="btn btn-success mon-schol-no-pdf"
                            data-bs-toggle="modal"
                            data-bs-target="#addModal"
                            data-bs-scholar-id="<?= $scholarId ?>">

                            Add New Entry
                        </button>
                        <button onclick="downloadPDF()" class="btn btn-outline-success mon-schol-no-pdf">
                            Download PDF
                        </button>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-12 col-lg-12">
                        <table id="monitorTable" class="data-table table no-wrap table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="datatable" style="width: 15%">Date</th>
                                    <th class="datatable" style="width: 65%">Details</th>
                                    <th class="datatable mon-schol-no-pdf" style="width: 20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $allResult->fetch_assoc()): // While Loop A
                                ?>
                                    <tr>
                                        <td><?= $row['date'] ?></td> <!--Edit Form-->
                                        <td><?= $row['details'] ?></td> <!--Edit Form-->
                                        <td class="mon-schol-no-pdf">
                                            <div class="row">
                                                <div class="col-6 text-center">
                                                    <button type="button"
                                                        class="btn btn-primary btn-sm edit-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editModal"
                                                        data-bs-id="<?= $row['id'] ?>"
                                                        data-bs-date="<?= $row['date'] ?>"
                                                        data-bs-details="<?= htmlspecialchars($row['details']) ?>">
                                                        Edit
                                                    </button>
                                                </div>

                                                <div class="col-6 text-center">
                                                    <form action="monitor_scholar.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this scholar?');">
                                                        <input type="text" name="action_type" value="delete" hidden>
                                                        <input type="number" name="scholar_id" value="<?= $scholarId ?>" hidden>
                                                        <input type="number" name="entry_id" value="<?= htmlspecialchars($row['id']) ?>" hidden>
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; // While Loop A
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Monitoring Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="monitor_scholar.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action_type" value="save">
                    <input type="hidden" name="scholar_id" value="<?= $scholarId ?>">
                    <input type="hidden" id="modal_entry_id" name="entry_id">

                    <div class="mb-3">
                        <label for="modal_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="modal_date" name="date">
                    </div>

                    <div class="mb-3">
                        <label for="modal_details" class="form-label">Details</label>
                        <textarea class="form-control" id="modal_details" name="details" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Monitoring Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="monitor_scholar.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action_type" value="add_new_record">
                    <input type="hidden" name="scholar_id" value="<?= $scholarId ?>">
                    <input type="hidden" id="add_modal_entry_id" name="entry_id">

                    <div class="mb-3">
                        <label for="modal_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="add_modal_date" name="date">
                    </div>

                    <div class="mb-3">
                        <label for="modal_details" class="form-label">Details</label>
                        <textarea class="form-control" id="add_modal_details" name="details" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>






<!-- JS Scripts -->
<script src="vendors/scripts/core.js"></script>
<script src="vendors/scripts/script.min.js"></script>
<script src="vendors/scripts/bootstrap.min.js"></script>
<script src="vendors/scripts/process.js"></script>
<script src="vendors/scripts/layout-settings.js"></script>
<script src="vendors/scripts/html2pdf.bundle.min.js"></script>
<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="vendors/scripts/dashboard3.js"></script>





<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editModal = document.getElementById('editModal');

        // Bootstrap event that fires right before the modal is shown
        editModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            const button = event.relatedTarget;

            // Extract info from data-bs-* attributes
            const id = button.getAttribute('data-bs-id');
            const date = button.getAttribute('data-bs-date');
            const details = button.getAttribute('data-bs-details');

            // Update the modal's content
            const modalEntryId = editModal.querySelector('#modal_entry_id');
            const modalDate = editModal.querySelector('#modal_date');
            const modalDetails = editModal.querySelector('#modal_details');

            modalEntryId.value = id;
            modalDate.value = date;
            modalDetails.value = details;
        });
    });




    $(document).ready(function() {
        // Check if the table exists on this page to avoid errors
        if ($('#monitorTable').length > 0) {

            // Destroy the default initialization if it was already created by script.min.js
            if ($.fn.DataTable.isDataTable('#monitorTable')) {
                $('#monitorTable').DataTable().destroy();
            }

            // Re-initialize with your custom settings
            $('#monitorTable').DataTable({
                "paging": false, // This completely removes the "Next/Previous" buttons
                "info": false, // "Showing 1 of X entries" text
                "responsive": true, // Keeps it mobile friendly
                "searching": false, // Search bar
                "lengthChange": false, // Hides the "Show X entries" dropdown
                // OR if you want to keep paging but just show a lot of rows:
                // "pageLength": 100 
            });
        }
    });






    function downloadPDF() {
        const element = document.getElementById('report-area');
        const actionElements = document.querySelectorAll('.mon-schol-no-pdf');

        // 1. Temporarily hide the elements on the screen
        actionElements.forEach(el => {
            el.style.display = 'none';
            console.log('Hiding element:', el);
        });

        const opt = {
            margin: 0.5,
            filename: 'Scholar_Report.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2,
                useCORS: true
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };

        // 2. Generate the PDF
        html2pdf().set(opt).from(element).save().then(() => {
            // 3. Bring them back after the PDF is generated!
            actionElements.forEach(el => el.style.display = '');
        });
    }
</script>







<?php
$conn->close();
?>