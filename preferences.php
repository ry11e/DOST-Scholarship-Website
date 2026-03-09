<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'includes/connection.php';

$message = '';
$action = $_POST['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formType = $_POST['form_type'] ?? '';
    // Formtype is from a hidden input to manage mutliple forms in this page.
    // So far, only edit_school and edit_municipality exists 


    switch ($formType) {

        case 'edit_school':
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
                $stmt = $conn->prepare("Update tbl_schools set fld_status = 'inactive' WHERE fld_ID = ?");
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
            break;


        //Copy Pasted from edit_school 
        case 'edit_municipality':

            $message = $action;

            if ($action === 'add') {
                $municipality = trim($_POST['municipalityName'] ?? '');
                $district    = trim($_POST['district'] ?? '');

                if ($municipality !== '' && $district !== '') {
                    $stmt = $conn->prepare("
                        INSERT INTO tbl_municipalities (fld_municipality, fld_district)
                        VALUES (?, ?)
                    ");
                    $stmt->bind_param("ss", $municipality, $district);
                    $stmt->execute();
                    $message = $stmt->affected_rows > 0 ? "Municipality added successfully." : "Error adding Municipality.";
                    $stmt->close();
                } else {
                    $message = "Municipality name and district are required.";
                }
            } elseif ($action === 'delete' && !empty($_POST['id'])) {
                $id = (int)$_POST['id'];
                $stmt = $conn->prepare("Update tbl_municipalities set fld_status = 'inactive' WHERE fld_ID = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $message = $stmt->affected_rows > 0 ? "Municipality deleted." : "Municipality not found.";
                $stmt->close();
            } elseif ($action === 'update' && !empty($_POST['id'])) {

                $id         = (int)$_POST['id'];
                $municipalityName = trim($_POST['municipalityName'] ?? '');
                $district    = trim($_POST['district'] ?? '');

                if ($municipalityName !== '' && $district !== '') {
                    $stmt = $conn->prepare("
                        UPDATE tbl_municipalities 
                        SET fld_municipality = ?, fld_district = ?
                        WHERE fld_ID = ?
                    ");
                    $stmt->bind_param("ssi", $municipalityName, $district, $id);
                    $stmt->execute();
                    $message = $stmt->affected_rows > 0 ? "Municipality updated." : "No changes or municipality not found.";
                    $stmt->close();
                } else {
                    $message = "Municipality name and district are required.";
                }
            }

            // PRG pattern - prevent resubmit on refresh
            header("Location: " . $_SERVER['PHP_SELF'] . "?msg=" . urlencode($message));
            exit;
            break;
        

        case 'edit_scholarship':
            
            $message = $action;

            if ($action === 'add') {
                $scholarshipCode = trim($_POST['scholarshipCode'] ?? '');
                $scholarshipName    = trim($_POST['scholarshipName'] ?? '');

                if ($scholarshipCode !== '' && $scholarshipName !== '') {
                    $stmt = $conn->prepare("
                        INSERT INTO tbl_scholarship_programs (fld_scholarshipCode, fld_scholarshipName)
                        VALUES (?, ?)
                    ");
                    $stmt->bind_param("ss", $scholarshipCode, $scholarshipName);
                    $stmt->execute();
                    $message = $stmt->affected_rows > 0 ? "Scholarship Programs added successfully." : "Error adding Programs.";
                    $stmt->close();
                } else {
                    $message = "Scholarship Code and Name are required.";
                }
            } elseif ($action === 'delete' && !empty($_POST['id'])) {
                $id = (int)$_POST['id'];
                $stmt = $conn->prepare("Update tbl_scholarship_programs set fld_status = 'inactive' WHERE fld_ID = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $message = $stmt->affected_rows > 0 ? "Scholarship deleted." : "Scholarship not found.";
                $stmt->close();
            } elseif ($action === 'update' && !empty($_POST['id'])) {

                $id         = (int)$_POST['id'];
                $scholarshipCode = trim($_POST['scholarshipCode'] ?? '');
                $scholarshipName    = trim($_POST['scholarshipName'] ?? '');

                if ($municipalityName !== '' && $district !== '') {
                    $stmt = $conn->prepare("
                        UPDATE tbl_scholarship_programs 
                        SET fld_scholarshipCode = ?, fld_scholarshipName = ?
                        WHERE fld_ID = ?
                    ");
                    $stmt->bind_param("ssi", $scholarshipCode, $scholarshipName, $id);
                    $stmt->execute();
                    $message = $stmt->affected_rows > 0 ? "Scholarship updated." : "No changes or Scholarship not found.";
                    $stmt->close();
                } else {
                    $message = "Scholarship Code and Name are required.";
                }
            }

            // PRG pattern - prevent resubmit on refresh
            header("Location: " . $_SERVER['PHP_SELF'] . "?msg=" . urlencode($message));
            exit;
            break;



        default:
            $message = "Invalid form type.";
            break;
    }
}


/**
 *@Potato
 *Potato
 */
//Test function
function potato()
{
    echo "potato";
}

// Show message from redirect. Uses URL parameter to store the message sent BEFORE reloading(which comes after a form submission)
if (isset($_GET['msg'])) {
    $message = htmlspecialchars($_GET['msg']);
}

// Load schools
$result = $conn->query("SELECT * FROM tbl_schools where fld_status='active' ORDER BY fld_schoolName");
$schoolItems = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Load municipalities
$result = $conn->query("SELECT * FROM tbl_municipalities where fld_status='active' ORDER BY fld_municipality");
$municipalityItems = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Load Scholarship PRograms
$result = $conn->query("Select * From tbl_scholarship_programs where fld_status='active' Order by fld_scholarshipCode");
$scholarshipItems = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];




// The includes are at the end of the script because they load too early and break the page for some reason
include_once 'includes/head.php';
include_once 'includes/sidebar.php';
?>

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box pd-30">

            <div class="container-fluid mt-4 mb-4">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center  pl-4">
                            <h1 class="h1">Preferences</h1>
                        </div>
                        <?php if ($message): ?>
                            <div class="alert alert-info"><?= $message ?></div>
                        <?php endif; ?>
                    </div>
                </div>




                <!-- 1st Row -->
                <div class="row">
                    <div class="col-md-6">
                        <!--Manage Schools Suggestions -->
                        <div class="container py-5">
                            <div class="row">
                                <div class="col-md-7">
                                    <h4 class="mb-4">Manage Schools</h4>
                                </div>
                                <div class="col-md-5 text-right">
                                    <button class="btn btn-lg btn-outline-success me-1  add-school-btn">
                                        + Add Schools
                                    </button>
                                </div>
                            </div>




                            <!-- Schools list -->
                            <div class="card">
                                <div class="card-header">All Schools (<?= count($schoolItems) ?>)</div>
                                <div class="card-body p-0">
                                    <?php if (empty($schoolItems)): ?>
                                        <div class="p-4 text-muted">No schools found.</div>
                                    <?php else: ?>
                                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                            <table class="table table-hover mb-0 align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>School Name</th>
                                                        <th>Address</th>
                                                        <th style="width: 33%;">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($schoolItems as $row): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($row['fld_schoolName']) ?></td>
                                                            <td><?= htmlspecialchars($row['fld_address']) ?></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-primary me-1 edit-school-btn"
                                                                    data-id="<?= $row['fld_ID'] ?>"
                                                                    data-schoolname="<?= htmlspecialchars($row['fld_schoolName']) ?>"
                                                                    data-address="<?= htmlspecialchars($row['fld_address']) ?>">
                                                                    Edit
                                                                </button>

                                                                <form method="post" style="display:inline;"
                                                                    onsubmit="return confirm('Really delete this school?');">
                                                                    <input type="hidden" name="form_type" value="edit_school">
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


                    <!-- Manage Municipalities-->
                    <div class="col-md-6">
                        <div class="container py-5">
                            <div class="row">
                                <div class="col-md-7">
                                    <h4 class="mb-4">Manage Municipalities</h4>
                                </div>
                                <div class="col-md-5 text-right">
                                    <button class="btn btn-lg btn-outline-success me-1 add-municipality-btn">
                                        + Add Municipality
                                    </button>
                                </div>
                            </div>



                            <!-- Add new municipality -->


                            <!-- Municipalities list -->
                            <div class="card">
                                <div class="card-header">All Municipalities (<?= count($municipalityItems) ?>)</div>
                                <div class="card-body p-0">
                                    <?php if (empty($municipalityItems)): ?>
                                        <div class="p-4 text-muted">No municipalities found.</div>
                                    <?php else: ?>
                                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                            <table class="table table-hover mb-0 align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Municipality Name</th>
                                                        <th>District</th>
                                                        <th style="width: 33%;">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($municipalityItems as $row): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($row['fld_municipality']) ?></td>
                                                            <td><?= htmlspecialchars($row['fld_district']) ?></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-primary me-1 edit-municipality-btn"
                                                                    data-id="<?= $row['fld_ID'] ?>"
                                                                    data-municipality="<?= htmlspecialchars($row['fld_municipality']) ?>"
                                                                    data-district="<?= htmlspecialchars($row['fld_district']) ?>">
                                                                    Edit
                                                                </button>
                                                                <form method="post" style="display:inline;"
                                                                    onsubmit="return confirm('Really delete this municipality?');">
                                                                    <input type="hidden" name="form_type" value="edit_municipality">
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
                


                <!-- 2nd Row -->
                <div class="row">
                    <div class="col-md-6">
                        <!--Manage Scholarships Table -->
                        <div class="container py-5">
                            <div class="row">
                                <div class="col-md-7">
                                    <h4 class="mb-4">Manage Scholarships</h4>
                                </div>
                                <div class="col-md-5 text-right">
                                    <button class="btn btn-lg btn-outline-success me-1  add-scholarship-btn">
                                        + Add Scholarship
                                    </button>
                                </div>
                            </div>




                            <!-- Schools list -->
                            <div class="card">
                                <div class="card-header">All Scholarship (<?= count($schoolItems) ?>)</div>
                                <div class="card-body p-0">
                                    <?php if (empty($schoolItems)): ?>
                                        <div class="p-4 text-muted">No Programs found.</div>
                                    <?php else: ?>
                                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                            <table class="table table-hover mb-0 align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Scholarahip Code</th>
                                                        <th>Scholarship Name</th>
                                                        <th style="width: 33%;">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($scholarshipItems as $row): ?>
                                                        <tr>
                                                            <td><?= htmlspecialchars($row['fld_scholarshipCode']) ?></td>
                                                            <td><?= htmlspecialchars($row['fld_scholarshipName']) ?></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-primary me-1 edit-scholarship-btn"
                                                                    data-id="<?= $row['fld_ID'] ?>"
                                                                    data-scholarship-code="<?= htmlspecialchars($row['fld_scholarshipCode']) ?>"
                                                                    data-scholarship-name="<?= htmlspecialchars($row['fld_scholarshipName']) ?>">
                                                                    Edit
                                                                </button>

                                                                <form method="post" style="display:inline;"
                                                                    onsubmit="return confirm('Really delete this school?');">
                                                                    <input type="hidden" name="form_type" value="edit_scholarship">
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
</div>



<!-- add Modal For Schools -->
<!-- Add new school -->
<div class="modal fade" id="addSchoolModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New School</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post">
                <input type="hidden" name="form_type" value="edit_school">
                <input type="hidden" name="action" value="add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">School Name</label>
                        <input type="text" name="schoolName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add School</button>
                </div>
            </form>
        </div>
    </div>
</div>






<!-- Add Municipality -->
<div class="modal fade" id="addMunicipalityModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Municipality</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post">
                <input type="hidden" name="form_type" value="edit_municipality">
                <input type="hidden" name="action" value="add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Municipality Name</label>
                        <input type="text" name="municipalityName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">District</label>
                        <input type="text" name="district" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Municipality</button>
                </div>
            </form>
        </div>
    </div>
</div>








<!-- Add Scholarship -->
<div class="modal fade" id="addScholarshipModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Scholarship</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post">
                <input type="hidden" name="form_type" value="edit_scholarship">
                <input type="hidden" name="action" value="add">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Scholarship Code</label>
                        <input type="text" name="scholarshipCode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Scholarship Name</label>
                        <input type="text" name="scholarshipName" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add Municipality</button>
                </div>
            </form>
        </div>
    </div>
</div>









<!-- Edit Modal for schools (using Bootstrap-like classes) -->
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
                <input type="hidden" name="form_type" value="edit_school">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_school_id">

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



<!-- Edit Modal for Municipaliyes -->
<div class="modal fade" id="editMunicipalityModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Municipality</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post">
                <input type="hidden" name="form_type" value="edit_municipality">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_municipality_id">

                    <div class="mb-3">
                        <label class="form-label">Municipality Name</label>
                        <input type="text" name="municipalityName" id="edit_municipality_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">District</label>
                        <input type="text" name="district" id="edit_district" class="form-control" required>
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




<!-- Edit Modal for Scholarship -->
<div class="modal fade" id="editScholarshipModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Scholarship</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post">
                <input type="hidden" name="form_type" value="edit_scholarship">
                <div class="modal-body">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="edit_scholarship_id">

                    <div class="mb-3">
                        <label class="form-label">Scholarship Code</label>
                        <input type="text" name="scholarshipCode" id="edit_scholarship_code" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Scholarship Name</label>
                        <input type="text" name="scholarshipName" id="edit_scholarship_name" class="form-control" required>
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




<!-- vendor scripts -->
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

//--------------------------------------------------------------------------------------------------------------------

// ADD MODALS
    // Add School Modal
    document.addEventListener('DOMContentLoaded', function() {
        const addModalEl = document.getElementById('addSchoolModal');
        const addButtons = document.querySelectorAll('.add-school-btn');

        addButtons.forEach(btn => {
            btn.addEventListener('click', function() {

                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $('#addSchoolModal').modal('show');
                } else {
                    // Fallback: manual show if no jQuery modal
                    addModalEl.classList.add('show');
                    addModalEl.style.display = 'block';
                    document.body.classList.add('modal-open');
                }
            });
        });

        // Close modal buttons
        const closeButtons = editModalEl.querySelectorAll('[data-dismiss="modal"]');
        closeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $('#addSchoolModal').modal('hide');
                } else {
                    editModalEl.classList.remove('show');
                    editModalEl.style.display = 'none';
                    document.body.classList.remove('modal-open');
                }
            });
        });
    });


    // Add MUnicipa;ity Modal
    document.addEventListener('DOMContentLoaded', function() {
        const addModalEl = document.getElementById('addMunicipalityModal');
        const addButtons = document.querySelectorAll('.add-municipality-btn');

        addButtons.forEach(btn => {
            btn.addEventListener('click', function() {

                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $('#addMunicipalityModal').modal('show');
                } else {
                    // Fallback: manual show if no jQuery modal
                    addModalEl.classList.add('show');
                    addModalEl.style.display = 'block';
                    document.body.classList.add('modal-open');
                }
            });
        });

        // Close modal buttons
        const closeButtons = addModalEl.querySelectorAll('[data-dismiss="modal"]');
        closeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $('#addMunicipalityModal').modal('hide');
                } else {
                    editModalEl.classList.remove('show');
                    editModalEl.style.display = 'none';
                    document.body.classList.remove('modal-open');
                }
            });
        });
    });


    // Add SCholarship Modal
    document.addEventListener('DOMContentLoaded', function() {
        const addModalEl = document.getElementById('addScholarshipModal');
        const addButtons = document.querySelectorAll('.add-scholarship-btn');

        addButtons.forEach(btn => {
            btn.addEventListener('click', function() {

                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $('#addScholarshipModal').modal('show');
                } else {
                    // Fallback: manual show if no jQuery modal
                    addModalEl.classList.add('show');
                    addModalEl.style.display = 'block';
                    document.body.classList.add('modal-open');
                }
            });
        });

        // Close modal buttons
        const closeButtons = addModalEl.querySelectorAll('[data-dismiss="modal"]');
        closeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $('#addScholarshipModal').modal('hide');
                } else {
                    editModalEl.classList.remove('show');
                    editModalEl.style.display = 'none';
                    document.body.classList.remove('modal-open');
                }
            });
        });
    });






//------------------------------------------------------------------------------------------------------------------

//Edit MODALS
 // Edit Modal for Schools
    document.addEventListener('DOMContentLoaded', function() {
        const editModalEl = document.getElementById('editSchoolModal');
        const editButtons = document.querySelectorAll('.edit-school-btn');

        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const schoolName = this.dataset.schoolname;
                const address = this.dataset.address || '';

                document.getElementById('edit_school_id').value = id;
                document.getElementById('edit_school_name').value = schoolName;
                document.getElementById('edit_address').value = address;

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
            btn.addEventListener('click', function() {
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



    // FOr Municipality Modal
    document.addEventListener('DOMContentLoaded', function() {
        const editModalEl = document.getElementById('editMunicipalityModal');
        const editButtons = document.querySelectorAll('.edit-municipality-btn');

        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const municipalityName = this.dataset.municipality;
                const district = this.dataset.district || '';

                document.getElementById('edit_municipality_id').value = id;
                document.getElementById('edit_municipality_name').value = municipalityName;
                document.getElementById('edit_district').value = district;

                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $('#editMunicipalityModal').modal('show');
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
            btn.addEventListener('click', function() {
                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $('#editMunicipalityModal').modal('hide');
                } else {
                    editModalEl.classList.remove('show');
                    editModalEl.style.display = 'none';
                    document.body.classList.remove('modal-open');
                }
            });
        });
    });




    // FOr Scholarship Modal
    document.addEventListener('DOMContentLoaded', function() {
        const editModalEl = document.getElementById('editScholarshipModal');
        const editButtons = document.querySelectorAll('.edit-scholarship-btn');

        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const scholarshipCode = this.dataset.scholarshipCode;
                const scholarshipName = this.dataset.scholarshipName || '';

                document.getElementById('edit_scholarship_id').value = id;
                document.getElementById('edit_scholarship_code').value = scholarshipCode;
                document.getElementById('edit_scholarship_name').value = scholarshipName;

                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $('#editScholarshipModal').modal('show');
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
            btn.addEventListener('click', function() {
                if (typeof $ !== 'undefined' && $.fn.modal) {
                    $('#editScholarshipModal').modal('hide');
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
// Close Db COnnection+
$conn->close();
?>