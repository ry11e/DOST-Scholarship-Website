<?php 
include_once 'includes/head.php'; 
include_once 'includes/sidebar.php';
?>


		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="title">
									<h4>Profile</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="dashboard.php">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Profile
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
							<div class="pd-20 card-box height-100-p">
								<div class="profile-photo">
									
									<img
										src="vendors/images/admin.png"
										alt=""
										class="avatar-photo"
									/>
								
								</div>
								<h5 class="text-center h5 mb-0"><?php echo htmlspecialchars($admin['fullname']); ?></h5>
								<p class="text-center text-muted font-14">
									ADMINISTRATOR
								</p>
								<div class="profile-info">
									<h5 class="mb-20 h5 text-blue">Contact Information</h5>
									<ul>
										<li>
											<span>Email Address:</span>
											<?php echo htmlspecialchars($admin['email']); ?>
										</li>
										<li>
											<span>Phone Number:</span>
											<?php echo htmlspecialchars($admin['phone']); ?>
										</li>
										
										<li>
											<span>Address:</span>
											<?php echo htmlspecialchars($admin['address']); ?>
										</li>
									</ul>
								</div>
								
							
							</div>
						</div>
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
							<div class="card-box height-100-p overflow-hidden">
								<div class="profile-tab height-100-p">
									<div class="tab height-100-p">
										<ul class="nav nav-tabs customtab" role="tablist">
											<li class="nav-item">
												<a
													class="nav-link active"
													data-toggle="tab"
													href="#timeline"
													role="tab"
													>Profile Settings</a
												>
											</li>
										
										</ul>
										<div class="tab-content">
											<!-- Timeline Tab start -->
											<div
												class="tab-pane fade show active"
												id="timeline"
												role="tabpanel"
											>
                                            <div class="profile-setting">
													<form method="POST" action="profile.php">
														<ul class="profile-edit-list row">
															<li class="weight-500 col-md-6">
																<h4 class="text-blue h5 mb-20">
																	Edit Your Personal Information
																</h4>
																<div class="form-group">
																	<label>Full Name</label>
																	<input
																		name="fullName"
                                                                        value="<?php echo htmlspecialchars($admin['fullname']); ?>"
																		class="form-control form-control-lg"
																		type="text"
																	/>
																</div>
																
																<div class="form-group">
																	<label>Email</label>
																	<input
																		name="email"
																		value="<?php echo htmlspecialchars($admin['email']); ?>"
																		class="form-control form-control-lg"
																		type="email"
																	/>
																</div>
																
																
															
																
																
																<div class="form-group">
																	<label>Phone Number</label>
																	<input
																		name="phone"
                                                                        value="<?php echo htmlspecialchars($admin['phone']); ?>"
																		class="form-control form-control-lg"
																		type="text"
																	/>
																</div>
																<div class="form-group">
																	<label>Address</label>
																	<input type="text" name="address"
																	class="form-control" value="<?php echo htmlspecialchars($admin['address']); ?>" />
																</div>
																
																
																<div class="form-group mb-0">
																	<input
																		name="update_profile"
																		type="submit"
																		class="btn btn-primary"
																		value="Update Information"
																	/>
																</div>
															</li>
															</form>
															
															<li class="weight-500 col-md-6">
																<h4 class="text-blue h5 mb-20">
																	Edit Login Information
																</h4>
																<form action="profile.php" method="POST">
																<div class="form-group">
																	<label>Current Password:</label>
																	<input
																		name="password"
                                                                        value=""
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="Password" 
																	/>
																</div>
																<div class="form-group">
																	<label>New Password:</label>
																	<input
																		name="newpassword"
                                                                        value=""
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="New Password"
																	/>
																</div>
																<div class="form-group">
																	<label>Confirm Password:</label>
																	<input
																		name="renewpassword"
                                                                        value=""
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="Confirm Password"
																	/>
																</div>
																<div class="form-group mb-0">
																	<input
																		name="change_password"
																		type="submit"
																		class="btn btn-primary"
																		value="Update Credentials"
																	/>
																</div>
															    <?php if (isset($password_message)) : ?>
                                            <div class="mt-2 alert alert-info">
                                                <?php echo htmlspecialchars($password_message); ?>
                                            </div>
                                        <?php endif; ?>
																</div>
																
															</li>
														</ul>
													</form>
												</div>
											</div>
											<!-- Setting Tab End -->
											</div>
											<!-- Timeline Tab End -->
											
											<!-- Setting Tab start -->
											<div
												class="tab-pane fade height-100-p"
												id="setting"
												role="tabpanel"
											>
												
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/cropperjs/dist/cropper.js"></script>
		<script>
			window.addEventListener("DOMContentLoaded", function () {
				var image = document.getElementById("image");
				var cropBoxData;
				var canvasData;
				var cropper;

				$("#modal")
					.on("shown.bs.modal", function () {
						cropper = new Cropper(image, {
							autoCropArea: 0.5,
							dragMode: "move",
							aspectRatio: 3 / 3,
							restore: false,
							guides: false,
							center: false,
							highlight: false,
							cropBoxMovable: false,
							cropBoxResizable: false,
							toggleDragModeOnDblclick: false,
							ready: function () {
								cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
							},
						});
					})
					.on("hidden.bs.modal", function () {
						cropBoxData = cropper.getCropBoxData();
						canvasData = cropper.getCanvasData();
						cropper.destroy();
					});
			});
		</script>
		
	</body>
</html>
