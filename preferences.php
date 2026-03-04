<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'includes/connection.php';

$message = '';
$action = $_POST['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'add') {
        $schoolName = trim($_POST['schoolName'] ?? '');
        $address    = trim($_POST['address'] ?? '');

        if ($schoolName !== '' && $address !== '') {
            $stmt = $conn->prepare("
                INSERT INTO tbl_schools (fld_schoolName, fld_address)
                VALUES (?, ?)
            ");
            $stmt->bind_param("ss", $schoolName, $address);
            $stmt->execute();
            $message = $stmt->affected_rows > 0 ? "School added successfully." : "Error adding school.";
            $stmt->close();
        } else {
            $message = "School name and address are required.";
        }
    } elseif ($action === 'delete' && !empty($_POST['id'])) {
        $id = (int)$_POST['id'];
        $stmt = $conn->prepare("DELETE FROM tbl_schools WHERE fld_ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $message = $stmt->affected_rows > 0 ? "School deleted." : "School not found.";
        $stmt->close();
    } elseif ($action === 'update' && !empty($_POST['id'])) {
        $id         = (int)$_POST['id'];
        $schoolName = trim($_POST['schoolName'] ?? '');
        $address    = trim($_POST['address'] ?? '');

        if ($schoolName !== '' && $address !== '') {
            $stmt = $conn->prepare("
                UPDATE tbl_schools 
                SET fld_schoolName = ?, fld_address = ?
                WHERE fld_ID = ?
            ");
            $stmt->bind_param("ssi", $schoolName, $address, $id);
            $stmt->execute();
            $message = $stmt->affected_rows > 0 ? "School updated." : "No changes or school not found.";
            $stmt->close();
        } else {
            $message = "School name and address are required.";
        }
    }

    // PRG pattern - prevent resubmit on refresh
    header("Location: " . $_SERVER['PHP_SELF'] . "?msg=" . urlencode($message));
    exit;
}

// Show message from redirect
if (isset($_GET['msg'])) {
    $message = htmlspecialchars($_GET['msg']);
}

// Load schools
$result = $conn->query("SELECT * FROM tbl_schools ORDER BY fld_schoolName");
$items = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

include_once 'includes/head.php';
include_once 'includes/sidebar.php';
?>

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box pb-10 pd-10">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center  pl-4 pt-3">
                        <h1 class="h1">Preferences</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="container py-5">
                        <h3 class="mb-4">Manage Schools</h3>

                        <?php if ($message): ?>
                            <div class="alert alert-info"><?= $message ?></div>
                        <?php endif; ?>

                        <!-- Add new school -->
                        <div class="card mb-4">
                            <div class="card-header">Add New School</div>
                            <div class="card-body">
                                <form method="post">
                                    <input type="hidden" name="action" value="add">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">School Name</label>
                                            <input type="text" name="schoolName" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Add School</button>
                                </form>
                            </div>
                        </div>

                        <!-- Schools list -->
                        <div class="card">
                            <div class="card-header">All Schools (<?= count($items) ?>)</div>
                            <div class="card-body p-0">
                                <?php if (empty($items)): ?>
                                    <div class="p-4 text-muted">No schools found.</div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0 align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>School Name</th>
                                                    <th>Address</th>
                                                    <th style="width:140px">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($items as $row): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($row['fld_schoolName']) ?></td>
                                                        <td><?= htmlspecialchars($row['fld_address']) ?></td>
                                                        <td>
                                                            <button class="btn btn-sm btn-outline-primary me-1 edit-btn"
                                                                    data-id="<?= $row['fld_ID'] ?>"
                                                                    data-schoolname="<?= htmlspecialchars($row['fld_schoolName']) ?>"
                                                                    data-address="<?= htmlspecialchars($row['fld_address']) ?>">
                                                                Edit
                                                            </button>

                                                            <form method="post" style="display:inline;" 
                                                                onsubmit="return confirm('Really delete this school?');">
                                                                <input type="hidden" name="action" value="delete">
                                                                <input type="hidden" name="id" value="<?= $row['fld_ID'] ?>">
                                                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Edit Modal (using Bootstrap-like classes your template seems to support) -->
<div class="modal fade" id="editSchoolModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit School</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_id">

                    <div class="mb-3">
                        <label class="form-label">School Name</label>
                        <input type="text" name="schoolName" id="edit_school_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" id="edit_address" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- Your existing vendor scripts -->
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




<!-- Modal handling with pure JS (no Bootstrap modal plugin needed) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editModalEl = document.getElementById('editSchoolModal');
    const editButtons = document.querySelectorAll('.edit-btn');

    editButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const id         = this.dataset.id;
            const schoolName = this.dataset.schoolname;
            const address    = this.dataset.address || '';

            document.getElementById('edit_id').value         = id;
            document.getElementById('edit_school_name').value = schoolName;
            document.getElementById('edit_address').value    = address;

            // Show modal (using Bootstrap 4 style classes your template likely supports)
            if (typeof $ !== 'undefined' && $.fn.modal) {
                $('#editSchoolModal').modal('show');
            } else {
                // Fallback: manual show if no jQuery modal
                editModalEl.classList.add('show');
                editModalEl.style.display = 'block';
                document.body.classList.add('modal-open');
            }
        });
    });

    // Close modal buttons
    const closeButtons = editModalEl.querySelectorAll('[data-dismiss="modal"]');
    closeButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            if (typeof $ !== 'undefined' && $.fn.modal) {
                $('#editSchoolModal').modal('hide');
            } else {
                editModalEl.classList.remove('show');
                editModalEl.style.display = 'none';
                document.body.classList.remove('modal-open');
            }
        });
    });
});
</script>





<?php
$conn->close();
?>