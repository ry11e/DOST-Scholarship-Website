<?php
include_once 'includes/head.php';
include_once 'includes/sidebar.php';
include_once "includes/connection.php";


?>

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">

        <div class="card-box pd-20">
            <div class="row mb-10">
                <div class="col-lg-8 col-md-12 h5 pd-20 mb-0 d-flex ">
                    LIST OF DOST-SEI SCHOLARS IN THE PROVINCE OF AKLAN
                </div>
                <div class="col-lg-4 col-md-12 pd-10">
                    <!-- Add Button -->
                    <div class="text-right">
                        <!-- Trigger the modal -->
                        <div class="d-inline-flex gap-2 p-2 rounded" style="gap: 10px;">
                            <button type="button" class="btn btn-success px-4" data-toggle="modal" data-target="#addScholarModal">
                                <i class="bi bi-plus-lg"></i> Add Scholar
                            </button>

                            <button onclick="exportToExcel()" class="btn btn-light border text-success" title="Export to Excel">
                                <i class="bi bi-download"></i> Export To Excel
                            </button>
                        </div>
                    </div>
                </div>
            </div>





            <!-- Display Alert Message -->
            <?php
            if (isset($_SESSION['message'])) {
                echo "<div class='alert alert-" . $_SESSION['message_type'] . "'>" . $_SESSION['message'] . "</div>";
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>

            <!-- Search Form -->
            <form method="GET" action="">
                <div class="row g-3 row-cols-1 row-cols-md-3 row-cols-lg-5">

                    <!-- Name, School, Address Selector -->
                    <div class="col-md-auto">
                        <input type="text" id="nameSchoolAddressInput" class="form-control" name="search_name" placeholder="Search Name, School, or Municipality" value="<?php echo isset($_GET['search_name']) ? $_GET['search_name'] : ''; ?>" />
                    </div>

                    <!-- Scholarship Selector -->
                    <div class="col-md-auto">
                        <input list="scholarshipPrograms" class="form-control" name="search_scholarprog" placeholder="Search by Scholarship Program" value="<?php echo isset($_GET['search_scholarprog']) ? $_GET['search_scholarprog'] : ''; ?>" />
                        <datalist id="scholarshipPrograms">
                            <?php
                            // Fetch scholarship programs from the database
                            //$conn = new mysqli("localhost", "root", "", "scholarship_db");
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            $sql = "SELECT DISTINCT scholarship_program FROM scholars";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['scholarship_program'] . "'>";
                            }
                            //$conn->close();
                            ?>
                        </datalist>
                    </div>


                    <!-- Status Selector -->
                    <div class="col-md-auto">

                        <input list="statusOptions" class="form-control" name="status" placeholder="Search by Status" />
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



                    <!-- Year Selector of Award-->
                    <div class="col-md-auto">
                        <input list="years" name="selected_year" id="year-input" class="form-control" placeholder="Search By Year Of Award" value="<?php echo isset($_GET['selected_year']) ? $_GET['selected_year'] : ''; ?>">

                    </div>
                    <!-- Year Selector for Graduated Scholars -->
                    <div class="col-md-auto">
                        <input list="years" name="graduated_year" id="graduated-year-input" class="form-control" placeholder="Search By Graduate Year" value="<?php echo isset($_GET['graduated_year']) ? $_GET['graduated_year'] : ''; ?>">

                    </div>

                    <!-- Datalist for Year Selectors -->
                    <datalist id="years">
                        <?php
                        $currentYear = date("Y");
                        $startYear   = $currentYear - 20;

                        for ($year = $currentYear; $year >= $startYear; $year--) {
                            echo "<option value=\"$year\">";
                        }
                        ?>
                    </datalist>



                    <script>
                        document.getElementById('statusSelect').addEventListener('change', function() {
                            if (this.value === 'others') {
                                var input = document.createElement('input');
                                input.type = 'text';
                                input.name = 'status';
                                input.className = 'form-control';
                                input.placeholder = 'Enter custom status';
                                input.id = 'statusInput';
                                this.parentNode.replaceChild(input, this);
                            }
                        });
                    </script>

                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a style="background-color: rgba(0, 0, 0, 0.29);" onclick="resetScholarTable()" class="btn " href="dashboard.php"><svg width="20" height="20" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 119.4 122.88">
                                <title>reload</title>
                                <path d="M83.91,26.34a43.78,43.78,0,0,0-22.68-7,42,42,0,0,0-24.42,7,49.94,49.94,0,0,0-7.46,6.09,42.07,42.07,0,0,0-5.47,54.1A49,49,0,0,0,30,94a41.83,41.83,0,0,0,18.6,10.9,42.77,42.77,0,0,0,21.77.13,47.18,47.18,0,0,0,19.2-9.62,38,38,0,0,0,11.14-16,36.8,36.8,0,0,0,1.64-6.18,38.36,38.36,0,0,0,.61-6.69,8.24,8.24,0,1,1,16.47,0,55.24,55.24,0,0,1-.8,9.53A54.77,54.77,0,0,1,100.26,108a63.62,63.62,0,0,1-25.92,13.1,59.09,59.09,0,0,1-30.1-.25,58.45,58.45,0,0,1-26-15.17,65.94,65.94,0,0,1-8.1-9.86,58.56,58.56,0,0,1,7.54-75,65.68,65.68,0,0,1,9.92-8.09A58.38,58.38,0,0,1,61.55,2.88,60.51,60.51,0,0,1,94.05,13.3l-.47-4.11A8.25,8.25,0,1,1,110,7.32l2.64,22.77h0a8.24,8.24,0,0,1-6.73,9L82.53,43.31a8.23,8.23,0,1,1-2.9-16.21l4.28-.76Z" />
                            </svg></a>
                    </div>
                </div>
            </form>



            <!-- Table displaying scholars -->
            <table class="data-table table no-wrap table-hover table-bordered table-striped">
                <thead>
                    <tr style="background-color: rgba(0, 0, 0, 0.39);">
                        <th class="table-plus">#</th>
                        <th class="datatable">YEAR OF AWARD</th>
                        <th class="datatable">SCHOLARSHIP PROGRAM</th>
                        <th class="datatable">NAME OF SCHOLAR</th>
                        <th class="datatable">SCHOOL</th>
                        <th class="datatable">COURSE</th>
                        <th class="datatable-nosort">CONTACT NO.</th>
                        <th class="datatable">STATUS</th>
                        <th class="datatable">YEAR GRADUATED</th>
                        <th class="datatable">MUNICIPALITY</th>
                        <th class="datatable-nosort">PERIODIC REQUIREMENTS</th>

                        <th class="datatable-nosort">SUMMER</th>
                        <th class="datatable-nosort">Updated COG</th>
                        <th class="datatable-nosort">Delayed Requirements</th>
                        <th class="datatable-nosort">Lacking Requirements</th>
                        <th class="datatable-nosort">Remarks</th>
                        <th class="datatable-nosort">District</th>
                        <th class="datatable-nosort">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['message'])) {
                        if ($_GET['message'] == 'deleted') {
                            echo "<div class='alert alert-success'>Scholar details deleted successfully!</div>";
                        } elseif ($_GET['message'] == 'error') {
                            echo "<div class='alert alert-danger'>An error occurred while deleting the scholar details.</div>";
                        }
                    }
                    ?>

                    <?php
                    // Establish a connection to your database
                    // $conn = new mysqli("localhost", "root", "", "scholarship_db");

                    // Check if the connection was successful
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Build the query based on search inputs
                    $sql = "SELECT * FROM scholars Where 1 ";


                    // Filters
                    if (isset($_GET['search_name']) && $_GET['search_name'] != "") {
                        $search_name = $conn->real_escape_string($_GET['search_name']);
                        $sql .= " AND (name LIKE '%$search_name%' OR school LIKE '%$search_name%' OR municipality LIKE '%$search_name%')";
                    }

                    if (isset($_GET['search_scholarprog']) && $_GET['search_scholarprog'] != "") {
                        $search_scholarprog = $conn->real_escape_string($_GET['search_scholarprog']);
                        $sql .= " AND (scholarship_program LIKE '%$search_scholarprog%')";
                    }

                    if (isset($_GET['status']) && $_GET['status'] != "") {
                        $status = $conn->real_escape_string($_GET['status']);
                        $sql .= " AND status = '$status'";
                    }

                    if (isset($_GET['selected_year']) && $_GET['selected_year'] != "") {
                        $year = (int)$_GET['selected_year'];
                        $sql .= " AND year_of_award = $year";
                        $_SESSION['currentYear'] = $year;
                    }

                    if (isset($_GET['graduated_year']) && $_GET['graduated_year'] != "") {
                        $year = (int)$_GET['graduated_year'];
                        $sql .= " AND year_graduated = $year";
                        $_SESSION['currentYear'] = $year;
                    }


                    // appends a sort query
                    $sql = $sql . " AND record_status = 'active' ORDER BY YEAR(year_of_award) DESC";





                    // ------------------------------------------------------------//
                    // This function is called by the 'Cancel' button in 'update-scholar.php'
                    if (isset($_GET['action']) && $_GET['action'] === 'reloadLastQuery') {
                        reloadLastQuery();

                        //echo  "<pre>" . "Last Query Reloaded" . "</pre>";
                        //exit;
                    }
                    function reloadLastQuery()
                    {
                        global $sql;
                        $sql = $_SESSION['lastSearchQuery'];
                    }
                    // ---------------------------------------------------------//




                    $_SESSION['lastSearchQuery'] = $sql;
                    //echo  "<pre>" . htmlspecialchars($_SESSION['lastSearchQuery']) . "</pre>"; // Debugger




                    // Execute the query and get the result
                    $result = $conn->query($sql);




                    // Display the results in the table
                    $count = 1;
                    while ($row = $result->fetch_assoc()) {

                        //status
                        $statusClass = '';
                        if ($row['year_graduated']) {
                            $statusClass = 'bg-success';
                        } else if ($row['status'] == 'Ongoing') {
                            $statusClass = 'bg-info';
                        } elseif ($row['status'] == 'Problematic') {
                            $statusClass = 'bg-danger';
                        } elseif ($row['status'] == 'Updated') {
                            $statusClass = 'bg-info';
                        } else {
                            $statusClass = 'bg-secondary';
                        }

                        //year graduated
                        $yearGraduatedClass = '';
                        if (!empty($row['year_graduated'])) {
                            $yearGraduatedClass = 'bg-success';
                        }

                        echo "<tr>";
                        echo "<td class='table-plus'>" . $count . "</td>";
                        echo "<td>" . $row['year_of_award'] . "</td>";
                        echo "<td>" . $row['scholarship_program'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['school'] . "</td>";
                        echo "<td>" . $row['course'] . "</td>";
                        echo "<td>" . $row['contact_no'] . "</td>";
                        echo "<td class='$statusClass'>" . ($row['year_graduated'] ? "Graduated" : $row['status']) . "</td>";
                        echo "<td class='$yearGraduatedClass'>" . $row['year_graduated'] ?? "" . "</td>";
                        echo "<td>" . $row['municipality'] . "</td>";
                        echo "<td>";
                        if (!empty($row['periodic_requirements'])) {
                            $files = explode(',', $row['periodic_requirements']);
                            foreach ($files as $file) {
                                list($filename, $upload_date) = explode('|', $file);
                                echo "<p style='font-size: 12px; background-color:beige;'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' shape-rendering='geometricPrecision' text-rendering='geometricPrecision' image-rendering='optimizeQuality' fill-rule='evenodd' clip-rule='evenodd' viewBox='0 0 424 511.543'><path fill='#262626' fill-rule='nonzero' d='M86.371 413.439c-11.766 0-11.766-17.89 0-17.89h102.733a129.853 129.853 0 00-.316 8.945c0 3.008.112 5.99.316 8.945H86.371zm179.438-389.18v29.103c0 65.658 15.314 69.469 69.082 69.469h22.031l-91.113-98.572zm94.336 115.919h-21.48c-61.025 0-90.202-4.092-90.202-86.277V17.347H56.817c-21.693 0-39.47 17.778-39.47 39.472v264.794h201.856a128.538 128.538 0 00-12.518 17.541H17.347v89.824c0 21.622 17.85 39.47 39.47 39.47h149.048a128.452 128.452 0 0012.01 17.347H56.817C25.626 485.795 0 460.171 0 428.978V56.819C0 25.553 25.55 0 56.817 0h206.336a8.656 8.656 0 016.926 3.454l105.073 113.675c2.191 2.367 2.339 4.663 2.339 7.517v166.861a127.423 127.423 0 00-17.346-7.709v-143.62z'/><path fill='#262626' fill-rule='nonzero' d='M123.665 246.354h-17.178v19.953H80.059v-82.589h41.624c18.941 0 28.41 10.175 28.41 30.526 0 11.188-2.467 19.468-7.4 24.841-1.849 2.026-4.405 3.746-7.663 5.154-3.259 1.411-7.048 2.115-11.365 2.115zm-17.178-41.493v20.35h6.079c3.171 0 5.484-.329 6.938-.991 1.453-.661 2.179-2.18 2.179-4.558v-9.25c0-2.379-.726-3.9-2.179-4.559-1.454-.661-3.767-.992-6.938-.992h-6.079zm51.536 61.446v-82.589h36.998c14.889 0 25.107 3.172 30.657 9.516 5.551 6.341 8.326 16.934 8.326 31.779 0 14.844-2.775 25.437-8.326 31.78-5.55 6.344-15.768 9.514-30.657 9.514h-36.998zm37.395-61.446H184.45v40.303h10.968c3.612 0 6.233-.417 7.862-1.254 1.63-.838 2.446-2.753 2.446-5.748v-26.297c0-2.995-.816-4.91-2.446-5.747-1.629-.838-4.25-1.257-7.862-1.257zm96.729 30.789h-22.465v30.657h-26.428v-82.589h54.178l-3.304 21.143h-24.446v11.1h22.465v19.689z'/><path fill='red' d='M316.953 297.447c59.119 0 107.047 47.93 107.047 107.049 0 59.118-47.928 107.047-107.047 107.047-59.12 0-107.049-47.929-107.049-107.047 0-59.119 47.929-107.049 107.049-107.049z'/><path fill='#fff' fill-rule='nonzero' d='M334.136 399.617l17.346 6.065c11.471 4.405 23.271-3.713 14.378-13.819-10.821-12.445-27.258-29.548-39.216-40.938-7.427-7.423-11.734-7.488-19.187-.061-13.237 12.997-26.232 27.437-39.17 40.871-9.254 10.06 2.291 18.552 14.272 13.947l17.166-6.004c-1.258 16.274-2.825 31.833-3.775 48.096 0 2.994 2.503 5.388 5.425 5.613 10.31 0 20.837.242 31.12 0 2.918-.225 5.422-2.622 5.422-5.613l-3.781-48.157z'/></svg>
                
                                            <a href='uploads/$filename' target='_blank'>$filename</a>
                                            <br>(Uploaded on: " . date('m/d/Y', strtotime($upload_date)) . ")
                                        </p>";
                            }
                        }
                        echo "</td>";
                        echo "<td>" . $row['summer'] . "</td>";
                        echo "<td>";
                        if (!empty($row['updated_cog_filename'])) {
                            $cogFiles = explode(',', $row['updated_cog_filename']);
                            foreach ($cogFiles as $cogFile) {
                                // Check if the separator exists
                                if (strpos($cogFile, '|') !== false) {
                                    list($filename, $upload_date) = explode('|', $cogFile);
                                } else {
                                    // Fallback if the data is malformed or old
                                    $filename = $cogFile;
                                    $upload_date = null;
                                }

                                echo "<p style='font-size: 12px; background-color:beige;'>
                                    <svg>...</svg>
                                    <a href='uploads/$filename' target='_blank'>$filename</a>
                                    <br>";

                                // Only show the date if it actually exists
                                if ($upload_date) {
                                    echo "(Uploaded on: " . date('m/d/Y', strtotime($upload_date)) . ")";
                                } else {
                                    echo "(Date unavailable)";
                                }

                                echo "</p>";
                            }
                        }
                        echo "</td>";

                        echo "<td>" . $row['delayed_requirements'] . "</td>";
                        echo "<td>" . $row['lacking_requirements'] . "</td>";
                        echo "<td>" . $row['remarks'] . "</td>";
                        echo "<td>" . $row['district'] . "</td>";
                        echo "<td>
                                <div class='table-actions d-flex gap-2 '>
                                    <a href='edit-scholar.php?id=" . $row['id'] . "' 
                                        class='btn btn-sm btn-outline-primary shadow-sm ms-5'>
                                        <i class='icon-copy dw dw-edit2'></i>
                                    </a>
                                    
                                    <a onclick='return confirmDelete()' 
                                        href='delete_scholar.php?id=" . $row['id'] . "' 
                                            class='btn btn-sm btn-outline-danger shadow-sm'>
                                        <i class='icon-copy dw dw-delete-3'></i>
                                    </a>
                                </div>
                            </td>";
                        echo "</tr>";
                        $count++;
                    }

                    // Close the connection
                    // $conn->close();
                    ?>
                </tbody>
                <?php
                // Display the number of results
                echo "<div class='mb-2 mt-2'>Number of results: " . $result->num_rows . "</div>";
                ?>
                <script>
                    function confirmDelete() {
                        return confirm("Are you sure you want to delete this scholar?");
                    }
                </script>

            </table>
        </div>
    </div>
</div>



<!-- Add Scholar Modal -->
<div class="modal fade" id="addScholarModal" tabindex="-1" role="dialog" aria-labelledby="addScholarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addScholarModalLabel">Add New Scholar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="add_scholar.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="year_of_award">Year of Award</label>
                            <input type="number" class="form-control" id="year_of_award" name="year_of_award" min="2000" max="2099" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="scholarship_program">Scholarship Program</label>
                            <input type="text" class="form-control" id="scholarship_program" name="scholarship_program" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="schoolsInput">School</label>
                            <input list="schoolsListDatalist" id="schoolsInput" name="school" class="form-control" required>
                            <datalist id="schoolsListDatalist">
                                <?php
                                $schoolsSql = "SELECT fld_schoolName FROM tbl_schools where fld_status='active' ORDER BY  fld_schoolName ASC";
                                $schoolsRes = $conn->query($schoolsSql);

                                while ($row = $schoolsRes->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['fld_schoolName']) . "'>" . htmlspecialchars($row['fld_schoolName']) . "</option>";
                                }
                                ?>
                            </datalist>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="course">Course</label>
                            <input type="text" class="form-control" id="course" name="course" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="contact_no">Contact No.</label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="municipality">Municipality</label>
                            <input list="municipalityDatalist" class="form-control" id="municipality" name="municipality" required>
                            <datalist id="municipalityDatalist">
                                <?php
                                $muniSql = "SELECT fld_municipality FROM tbl_municipalities where fld_status='active' ORDER BY  fld_municipality ASC";
                                $muniRes = $conn->query($muniSql);

                                while ($row = $muniRes->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['fld_municipality']) . "'>" . htmlspecialchars($row['fld_municipality']) . "</option>";
                                }
                                ?>
                            </datalist>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="district">District</label>
                            <input type="text" class="form-control" id="district" name="district" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <?php

                                $scholStatSql = "SELECT * FROM tbl_scholar_status WHERE fld_status = 'active'";
                                $scholStatRes = $conn->query($scholStatSql);

                                while ($row = $scholStatRes->fetch_assoc()) {
                                    $value = $row['fld_scholarshipStatus'];
                                    $display = $row['fld_scholarshipStatus'];

                                    // Check if this option should be selected
                                    $is_selected = ($selected_status === $value) ? 'selected' : '';

                                    echo "<option value=\"$value\" $is_selected>$display</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="periodic_requirements">Periodic Requirements&nbsp;<span style="font-size: 9px; color:red; background-color:antiquewhite ;"> Note: (Filenames should not have commas(,))</span></label>
                            <input type="file" class="form-control" id="periodic_requirements" name="periodic_requirements[]" accept=".pdf,.doc,.docx" multiple>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="summer">Year Graduated&nbsp;<span style="font-size: 9px; color:red; background-color:antiquewhite ;"> Note: (Remain blank if not yet graduated)</span></label>
                            <input type="text" class="form-control" id="year-graduated" name="year_graduated">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="updated_cog">Updated COG</label>
                            <input type="file" class="form-control" id="updated_cog" name="updated_cog" accept=".pdf,.doc,.docx">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="summer">Summer</label>
                            <input type="text" class="form-control" id="summer" name="summer">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="lacking_requirements">Lacking Requirements</label>
                            <input type="text" class="form-control" id="lacking_requirements" name="lacking_requirements">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="delayed_requirements">Delayed Requirements</label>
                            <input type="text" class="form-control" id="delayed_requirements" name="delayed_requirements">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="remarks">Remarks</label>
                            <input type="text" class="form-control" id="remarks" name="remarks">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add_scholar">Save Scholar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Add Scholar Modal -->

<script>
    // Export to Excel Function
    function exportToExcel() {
        window.location.href = 'export_scholars.php';
    }

    // Resets the table to its original state
    function resetScholarTable(tableId = 'data-table') {
        const table = $('.' + tableId).DataTable();

        table.state.clear(); // 1. Clear any saved state (if stateSave is on)
        table.search('').columns().search(''); // 2. Reset search/filter
        table.order(table.settings()[0].oInit.order || [
            [0, 'asc']
        ]); // 3. Reset ordering to initial
        table.page(0); // 4. Reset paging to page 1
        table.page.len(table.settings()[0].oInit.pageLength || 10); // 5. Reset length menu to default

        // 6. Redraw the table (applies all changes)
        table.draw(false); // false = reset paging, true = keep current page
    }



    // Handle status field
    var statusSelect = document.getElementById('edit_status');
    if (status.startsWith('others:')) {
        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'status';
        input.className = 'form-control';
        input.value = status;
        input.id = 'edit_status';
        statusSelect.parentNode.replaceChild(input, statusSelect);
    } else {
        statusSelect.value = status;
    }

    document.getElementById('edit_status').addEventListener('change', function() {
        if (this.value === 'others') {
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'status';
            input.className = 'form-control';
            input.placeholder = 'Enter custom status';
            input.id = 'edit_status';
            this.parentNode.replaceChild(input, this);
        }
    });
</script>
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
unset($conn);
?>
</body>

</html>