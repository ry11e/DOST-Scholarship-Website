<?php
include_once 'includes/head.php';
include_once 'includes/sidebar.php';
include_once 'includes/connection.php';

// Establish a connection to your database
//$conn = new mysqli("localhost", "root", "", "scholarship_db");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the scholar's ID from the query parameter
$scholar_id = $_GET['id'];

// Fetch the scholar's details from the database
$sql = "SELECT * FROM scholars WHERE id = '$scholar_id'";
$result = $conn->query($sql);
$scholar = $result->fetch_assoc();

// Close the connection
//$conn->close();
?>

<div class="main-container">

    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box pb-10" style="padding: 10px;">
            <div class="h5 pd-20 mb-0">Edit Scholar Details</div>
            <form id="edit_scholar_form" method="POST" action="update-scholar.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $scholar['id']; ?>" />
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $scholar['name']; ?>" />
                    </div>
                    <div class="col-md-6">
                        <label for="year_of_award">Year of Award</label>
                        <input type="text" class="form-control" name="year_of_award" value="<?php echo $scholar['year_of_award']; ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="scholarship_program">Scholarship Program</label>
                        <input type="text" class="form-control" name="scholarship_program" value="<?php echo $scholar['scholarship_program']; ?>" />
                    </div>
                    <div class="col-md-6">
                        <label for="schoolInput">School</label>
                        <input list="schoolsListDatalist" id="schoolsInput" name="school" class="form-control" value="<?php echo $scholar['school']; ?>">
                        <datalist id="schoolsListDatalist">
                            <?php
                            $schoolsSql = "SELECT fld_schoolName FROM tbl_schools where fld_status='active' ORDER BY fld_schoolName ASC";
                            $schoolsRes = $conn->query($schoolsSql);

                            while ($row = $schoolsRes->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['fld_schoolName']) . "'>" . htmlspecialchars($row['fld_schoolName']) . "</option>";
                            }
                            ?>
                        </datalist>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="course">Course</label>
                        <input type="text" class="form-control" name="course" value="<?php echo $scholar['course']; ?>" />
                    </div>
                    <div class="col-md-6">
                        <label for="contact_no">Contact No.</label>
                        <input type="text" class="form-control" name="contact_no" value="<?php echo $scholar['contact_no']; ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="municipality">Municipality</label>
                        <input list="municipalityDatalist" class="form-control" id="municipality" name="municipality" value="<?php echo $scholar['municipality']; ?>" required>
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
                    <div class="col-md-6">
                        <label for="district">District</label>
                        <input type="text" class="form-control" name="district" value="<?php echo $scholar['district']; ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="statusList">Status <span style="font-size: 9px; color:red; background-color:antiquewhite ;"> Note: (Last status before graduation)</span></label>
                        <input list="statusOptions" id="statusList" class="form-control" name="status" placeholder="Search by Status" value="<?php echo $scholar['status']; ?>" />
                        <datalist id="statusOptions">
                            <?php
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            // Fetch distinct statuses from the database for the datalist
                            $statusSql = "SELECT fld_scholarshipStatus FROM tbl_scholar_status WHERE fld_status='active'";
                            $statusRes = $conn->query($statusSql);
                            while ($row = $statusRes->fetch_assoc()) {
                                echo "<option value='" . htmlspecialchars($row['fld_scholarshipStatus']) . "'>";
                            }
                            ?>
                        </datalist>
                    </div>
                    <div class="col-md-6">
                        <label for="periodic_requirements">Periodic Requirements&nbsp; &nbsp;<span style="font-size: 12px; color:red; background-color:antiquewhite ;"> Note: (Filenames should not have commas(,))</span></label>
                        <?php if (!empty($scholar['periodic_requirements'])): ?>
                            <?php
                            $files = explode(',', $scholar['periodic_requirements']);
                            foreach ($files as $file):
                                list($filename, $upload_date) = explode('|', $file);
                            ?>
                                <p style="font-size: 14px; background-color:beige;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 424 511.543">
                                        <path fill="#262626" fill-rule="nonzero" d="M86.371 413.439c-11.766 0-11.766-17.89 0-17.89h102.733a129.853 129.853 0 00-.316 8.945c0 3.008.112 5.99.316 8.945H86.371zm179.438-389.18v29.103c0 65.658 15.314 69.469 69.082 69.469h22.031l-91.113-98.572zm94.336 115.919h-21.48c-61.025 0-90.202-4.092-90.202-86.277V17.347H56.817c-21.693 0-39.47 17.778-39.47 39.472v264.794h201.856a128.538 128.538 0 00-12.518 17.541H17.347v89.824c0 21.622 17.85 39.47 39.47 39.47h149.048a128.452 128.452 0 0012.01 17.347H56.817C25.626 485.795 0 460.171 0 428.978V56.819C0 25.553 25.55 0 56.817 0h206.336a8.656 8.656 0 016.926 3.454l105.073 113.675c2.191 2.367 2.339 4.663 2.339 7.517v166.861a127.423 127.423 0 00-17.346-7.709v-143.62z" />
                                        <path fill="#262626" fill-rule="nonzero" d="M123.665 246.354h-17.178v19.953H80.059v-82.589h41.624c18.941 0 28.41 10.175 28.41 30.526 0 11.188-2.467 19.468-7.4 24.841-1.849 2.026-4.405 3.746-7.663 5.154-3.259 1.411-7.048 2.115-11.365 2.115zm-17.178-41.493v20.35h6.079c3.171 0 5.484-.329 6.938-.991 1.453-.661 2.179-2.18 2.179-4.558v-9.25c0-2.379-.726-3.9-2.179-4.559-1.454-.661-3.767-.992-6.938-.992h-6.079zm51.536 61.446v-82.589h36.998c14.889 0 25.107 3.172 30.657 9.516 5.551 6.341 8.326 16.934 8.326 31.779 0 14.844-2.775 25.437-8.326 31.78-5.55 6.344-15.768 9.514-30.657 9.514h-36.998zm37.395-61.446H184.45v40.303h10.968c3.612 0 6.233-.417 7.862-1.254 1.63-.838 2.446-2.753 2.446-5.748v-26.297c0-2.995-.816-4.91-2.446-5.747-1.629-.838-4.25-1.257-7.862-1.257zm96.729 30.789h-22.465v30.657h-26.428v-82.589h54.178l-3.304 21.143h-24.446v11.1h22.465v19.689z" />
                                        <path fill="red" d="M316.953 297.447c59.119 0 107.047 47.93 107.047 107.049 0 59.118-47.928 107.047-107.047 107.047-59.12 0-107.049-47.929-107.049-107.047 0-59.119 47.929-107.049 107.049-107.049z" />
                                        <path fill="#fff" fill-rule="nonzero" d="M334.136 399.617l17.346 6.065c11.471 4.405 23.271-3.713 14.378-13.819-10.821-12.445-27.258-29.548-39.216-40.938-7.427-7.423-11.734-7.488-19.187-.061-13.237 12.997-26.232 27.437-39.17 40.871-9.254 10.06 2.291 18.552 14.272 13.947l17.166-6.004c-1.258 16.274-2.825 31.833-3.775 48.096 0 2.994 2.503 5.388 5.425 5.613 10.31 0 20.837.242 31.12 0 2.918-.225 5.422-2.622 5.422-5.613l-3.781-48.157z" />
                                    </svg>

                                    <a href="uploads/<?php echo $filename; ?>" target="_blank"><?php echo $filename; ?></a>
                                    <a href="uploads/<?php echo $filename; ?>"
                                        class="btn btn-primary btn-sm"
                                        target="_blank"
                                        download>
                                        Download
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeFile('<?php echo $filename; ?>')">X</button>
                                    <br>
                                    (Uploaded on: <?php echo date('m/d/Y', strtotime($upload_date)); ?>)
                                </p>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="periodic_requirements[]" accept=".pdf,.doc,.docx" multiple />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="summer">Summer</label>
                        <input type="text" class="form-control" name="summer" value="<?php echo $scholar['summer']; ?>" />
                    </div>
                    <div class="col-md-6">
                        <label for="Updated COG">Updated COG&nbsp; &nbsp;<span style="font-size: 12px; color:red; background-color:antiquewhite ;"> Note: (Filenames should not have commas(,))</span></label>
                        <?php if (!empty($scholar['updated_cog_filename'])): ?>
                            <?php
                            $files = explode(',', $scholar['updated_cog_filename']);
                            foreach ($files as $file):
                                //list($filename, $upload_date) = explode('|', $file);

                                if (strpos($file, '|') !== false) {
                                    list($filename, $upload_date) = explode('|', $file);
                                } else {
                                    // Fallback if the data is malformed or old
                                    $filename = $file;
                                    $upload_date = null;
                                }
                            ?>
                                <p style="font-size: 14px; background-color:beige;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 424 511.543">
                                        <path fill="#262626" fill-rule="nonzero" d="M86.371 413.439c-11.766 0-11.766-17.89 0-17.89h102.733a129.853 129.853 0 00-.316 8.945c0 3.008.112 5.99.316 8.945H86.371zm179.438-389.18v29.103c0 65.658 15.314 69.469 69.082 69.469h22.031l-91.113-98.572zm94.336 115.919h-21.48c-61.025 0-90.202-4.092-90.202-86.277V17.347H56.817c-21.693 0-39.47 17.778-39.47 39.472v264.794h201.856a128.538 128.538 0 00-12.518 17.541H17.347v89.824c0 21.622 17.85 39.47 39.47 39.47h149.048a128.452 128.452 0 0012.01 17.347H56.817C25.626 485.795 0 460.171 0 428.978V56.819C0 25.553 25.55 0 56.817 0h206.336a8.656 8.656 0 016.926 3.454l105.073 113.675c2.191 2.367 2.339 4.663 2.339 7.517v166.861a127.423 127.423 0 00-17.346-7.709v-143.62z" />
                                        <path fill="#262626" fill-rule="nonzero" d="M123.665 246.354h-17.178v19.953H80.059v-82.589h41.624c18.941 0 28.41 10.175 28.41 30.526 0 11.188-2.467 19.468-7.4 24.841-1.849 2.026-4.405 3.746-7.663 5.154-3.259 1.411-7.048 2.115-11.365 2.115zm-17.178-41.493v20.35h6.079c3.171 0 5.484-.329 6.938-.991 1.453-.661 2.179-2.18 2.179-4.558v-9.25c0-2.379-.726-3.9-2.179-4.559-1.454-.661-3.767-.992-6.938-.992h-6.079zm51.536 61.446v-82.589h36.998c14.889 0 25.107 3.172 30.657 9.516 5.551 6.341 8.326 16.934 8.326 31.779 0 14.844-2.775 25.437-8.326 31.78-5.55 6.344-15.768 9.514-30.657 9.514h-36.998zm37.395-61.446H184.45v40.303h10.968c3.612 0 6.233-.417 7.862-1.254 1.63-.838 2.446-2.753 2.446-5.748v-26.297c0-2.995-.816-4.91-2.446-5.747-1.629-.838-4.25-1.257-7.862-1.257zm96.729 30.789h-22.465v30.657h-26.428v-82.589h54.178l-3.304 21.143h-24.446v11.1h22.465v19.689z" />
                                        <path fill="red" d="M316.953 297.447c59.119 0 107.047 47.93 107.047 107.049 0 59.118-47.928 107.047-107.047 107.047-59.12 0-107.049-47.929-107.049-107.047 0-59.119 47.929-107.049 107.049-107.049z" />
                                        <path fill="#fff" fill-rule="nonzero" d="M334.136 399.617l17.346 6.065c11.471 4.405 23.271-3.713 14.378-13.819-10.821-12.445-27.258-29.548-39.216-40.938-7.427-7.423-11.734-7.488-19.187-.061-13.237 12.997-26.232 27.437-39.17 40.871-9.254 10.06 2.291 18.552 14.272 13.947l17.166-6.004c-1.258 16.274-2.825 31.833-3.775 48.096 0 2.994 2.503 5.388 5.425 5.613 10.31 0 20.837.242 31.12 0 2.918-.225 5.422-2.622 5.422-5.613l-3.781-48.157z" />
                                    </svg>

                                    <a href="uploads/<?php echo $filename; ?>" target="_blank"><?php echo $filename; ?></a>
                                    <a href="uploads/<?php echo $filename; ?>"
                                        class="btn btn-primary btn-sm"
                                        target="_blank"
                                        download>
                                        Download
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeCOGFile('<?php echo $filename; ?>')">X</button>
                                    <br>
                                    (Uploaded on: <?php echo date('m/d/Y', strtotime($upload_date)); ?>)
                                </p>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <input type="file" class="form-control" name="updated_cog[]" accept=".pdf,.doc,.docx" multiple />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="year_graduated">Year Graduated <span style="font-size: 9px; color:red; background-color:antiquewhite ;"> Note: (Remain blank if not yet graduated)</span></label>
                        <input type="number" class="form-control" name="year_graduated" value="<?php echo $scholar['year_graduated']; ?>" />
                    </div>
                    <div class="col-md-6">
                        <label for="lacking_requirements">Lacking Requirements</label>
                        <input type="text" class="form-control" name="lacking_requirements" value="<?php echo $scholar['lacking_requirements']; ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="remarks">Remarks</label>
                        <input type="text" class="form-control" name="remarks" value="<?php echo $scholar['remarks']; ?>" />
                    </div>
                    <div class="col-md-6">
                        <label for="delayed_requirements">Delayed Requirements</label>
                        <input type="text" class="form-control" name="delayed_requirements" value="<?php echo $scholar['delayed_requirements']; ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <!-- <a href="dashboard.php" class="btn btn-secondary">Cancel</a> -->
                        <a href="dashboard.php?action=reloadLastQuery" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Result -->
    <div id="result" class="mt-3"></div>

    <?php
    include "notification.php";
    ?>


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
    function removeFile(filename) {
        if (confirm('Are you sure you want to delete this file?')) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'remove-file.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert('File removed successfully');
                    location.reload();
                }
            };
            xhr.send('filename=' + encodeURIComponent(filename));
        }
    }

    function removeCOGFile(filename) {
        if (confirm('Are you sure you want to delete this file?')) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'remove-file.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    location.reload();
                }
            };
            xhr.send('filename=' + encodeURIComponent(filename) + '&field=updated_cog_filename');
        }
    }


    // Prevents Page Reload from Form Submission
    document.getElementById('edit_scholar_form').addEventListener('submit', async function(e) {
        e.preventDefault(); // ← stops the page reload

        const form = e.target;
        const formData = new FormData(form);
        const resultDiv = document.getElementById('result');

        try {
            const response = await fetch('update-scholar.php', { // ← your PHP handler
                method: 'POST',
                body: formData
            });
            const data = await response.json(); // assuming PHP returns JSON

            if (data.success) {
                //resultDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                //alert("Update Success");
                form.reset(); // optional: clear form

                showNotification("Success", "success");
            } else {
                //resultDiv.innerHTML = `<div class="alert alert-danger">${data.message || 'Error'}</div>`;
                showNotification(`Error${data.message || 'Error'}`, "error");
            }
        } catch (error) {
            //resultDiv.innerHTML = `<div class="alert alert-danger">Network error: ${error.message}</div>`;
            showNotification(`Network Error:  ${error.message}`, "error");
        }
    });

    function showNotification(msg, status) {

        const box = document.getElementById('notification-box');


        console.log(box);
        if (status = "success") {
            box.style.color = 'green';
            box.style.background = 'rgb(230, 255, 238)';
        } else if (status = "error") {
            box.style.color = 'red';
            box.style.background = '#ffd7d7';
        }


        if (msg != null || msg != "") {
            box.innerHTML = msg;
        }

        if (box) {
            // Fade in
            setTimeout(() => {
                box.style.opacity = '1';
            }, 100);

            // Fade out after 4 seconds
            setTimeout(() => {
                box.style.opacity = '0';
                location.reload();
                // Optional: remove from DOM after fade
                setTimeout(() => box.remove(), 500);
            }, 1500);
        }

    }
</script>
<?php
$conn->close();
?>
</body>

</html>