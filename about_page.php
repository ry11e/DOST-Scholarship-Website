<?php


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
                            <h1 class="h1">About</h1>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="d-flex justify-content-center pd-20">
                        <div>
                            <h2 class="text-blue h2">AKSIS: Aklan Scholars Information System</h2>
                            <p class="mb-0">Aklan Field Office</p>
                        </div>
                    </div>
                    <div class="pb-20 pd-20">
                        <div class="row">
                            <!-- Left Side: Mandate and System Intent -->
                            <div class="col-md-6 mb-20">
                                <h4 class="h4 text-blue mb-10"><span class="bi bi-shield-check"></span> System Purpose</h4>
                                <p>This software serves as a central repository and analytics dashboard for DOST academic grants within the Province of Aklan. The platform accelerates record search, scholar tracking and monitoring, and provides critical reports to support data-driven decisions.</p>

                                <h4 class="h4 text-blue mt-30 mb-10"><span class="bi bi-cpu"></span> Core Architecture</h4>
                                <p>Built on a secure, relational database backend (PHP/MySQL Engine).</p>
                            </div>


                            <div class="col-md-6 mb-20">
                                <div class="p-3 border rounded bg-light">
                                    <h5 class="h5 text-blue mb-10"><span class="bi bi-code-slash"></span> System Engineering Registry</h5>
                                    <p class="small text-muted mb-2"></p>

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item bg-transparent px-0">
                                            <div class="m-0"><strong>Platform Initialization (V1.0)</strong></div>
                                            <div class="m-0"><small class="text-secondary">Core Database Design and Critical System Features</small></div>
                                            <ul class="list-unstyled text-muted lh-sm">
                                                <li class="mb-1"><i class="fa-solid fa-circle-notch fa-xs me-1"></i>- Chavron T. Jaravata</li>
                                                <li class="mb-1"><i class="fa-solid fa-circle-notch fa-xs me-1"></i>- Limuel S. Ganal Jr.</li>
                                                <li class="mb-1"><i class="fa-solid fa-circle-notch fa-xs me-1"></i>- John Bernie C. Samonte</li>
                                                <li class="mb-1"><i class="fa-solid fa-circle-notch fa-xs me-1"></i>- Von Razi G. Gillegao</li>
                                            </ul>
                                            
                                        </li>
                                        
                                        <li class="list-group-item bg-transparent px-0">
                                            <strong>Systems Debugging, Optimization &amp; Maintenance (V2.0 - Active) (Feb-May 2026)</strong><br>
                                            <small class="text-secondary">Bug Fixing · Database Redesign · Scholars Monitoring · Report Generation</small>
                                            <ul class="list-unstyled text-muted lh-sm">
                                                <li class="mb-1"><i class="fa-solid fa-circle-notch fa-xs me-1"></i>- Rylle G. Panganonong</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>

                <div class="row g-4">

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