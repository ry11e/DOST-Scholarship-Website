
<?php
session_start();
include('includes/connection.php');

// Login processing
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM admin_tbl WHERE username = ? AND password = ?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();
  $admin = $result->fetch_assoc();

  if ($admin) {
      $_SESSION['admin_logged_in'] = true;
      $_SESSION['admin_username'] = $username;
      header("Location:dashboard.php"); 
      exit();
  } else {
      $error_message = "Invalid username or password.";
  }
}

?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Scholar - Admin Dashboard </title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="scholarship.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="scholarship.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="scholarship.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="vendors/styles/icon-font.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />

	
	</head>
	<body class="login-page">
		<div class="login-header box-shadow">
			<div
				class="container-fluid d-flex justify-content-between align-items-center"
			>
				<div class="brand-logo">
				<h4 style="margin-top: 20px;" >ADMINISTRATOR</h4>
				</div>
			
			</div>
		</div>
		<div
			class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
		>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-7">
						<img src="scholarship.png" alt="" />
					</div>
					<div class="col-md-6 col-lg-5">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<h2 class="text-center text-primary">Login</h2>
							</div>
							<?php if (isset($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                      <?php echo htmlspecialchars($error_message); ?>
                    </div>
                  <?php endif; ?>

							<form  novalidate method="POST" action="index.php" autocomplete="off" >
								
								<div class="input-group custom">
									<input
										name="username"
										type="text"
										class="form-control form-control-lg"
										placeholder="Username"
									/>
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="icon-copy dw dw-user1"></i
										></span>
									</div>
								</div>
								<div class="input-group custom">
									<input
										name="password"
										type="password"
										class="form-control form-control-lg"
										placeholder="Password"
									/>
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="dw dw-padlock1"></i
										></span>
									</div>
								</div>
								
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											
										
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Login">
								
									
										</div>
										
									</div>
								</div>
							</form>
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
		
	</body>
</html>
