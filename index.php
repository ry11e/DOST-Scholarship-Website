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

	<title>AKSIS: Aklan Scholars' Information System</title>
	<link rel="icon" type="image/x-icon" href="assets/images/AKSIS Icon.ico">
	<link href="src/styles/bootstrap.min.css" rel="stylesheet">
	<style>
		body,
		html {
			height: 100%;
			margin: 0;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}

		/* The "Rio" Gradient */
		.rio-bg {
			background: linear-gradient(-225deg, #32f4e4, #0783cb, #f54387);
			background-size: 400% 200%;
			/* 2. Attach the animation */
			animation: gradientShift 13s ease infinite;

			min-height: 100vh;
			color: white;

		}

		/* 3. Define the movement */
		@keyframes gradientShift {
			0% {
				background-position: 0% 50%;
			}

			50% {
				background-position: 100% 50%;
			}

			100% {
				background-position: 0% 50%;
			}
		}

		.navbar-brand img {
			height: 50px;
			/* Adjust logo size here */
		}

		.hero-section {
			padding-top: 100px;
		}

		.btn-outline-light:hover {
			color: #1aafff;
		}

		/* Define the "Floating" animation */
		@keyframes subtleBounce {
			0% {
				transform: translateY(0);
			}

			50% {
				transform: translateY(-7px);
				/* Moves up by 10 pixels */
			}

			100% {
				transform: translateY(0);
			}
		}

		/* Create a class to apply it */
		.floating-logo {
			animation: subtleBounce 5s ease-in-out infinite;
		}
	</style>

	<!-- Basic Page Info -->
	<meta charset="utf-8" />

	<!-- Site favicon -->
	<link
		rel="apple-touch-icon"
		sizes="180x180"
		href="scholarship.png" />
	<link
		rel="icon"
		type="image/png"
		sizes="32x32"
		href="scholarship.png" />
	<link
		rel="icon"
		type="image/png"
		sizes="16x16"
		href="scholarship.png" />

	<!-- Mobile Specific Metas -->
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1, maximum-scale=1" />

	<!-- Google Font -->
	<link
		href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
		rel="stylesheet" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
	<link
		rel="stylesheet"
		type="text/css"
		href="vendors/styles/icon-font.min.css" />
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />


</head>

<body class="login-page rio-bg">


	<div class="d-flex flex-coloumn align-items-center justify-content-center" style="min-height:100%;">
		<div class="hero-section container py-5">
			<div class="row align-items-center ">

				<div class="col-5  text-center">
					<img src="assets/images/AKSIS.png"
						alt="Site Logo"
						class="img-fluid floating-logo"
						style="max-width: 75%;">
				</div>

				<div class="col-7 d-flex flex-column justify-content-center text-center align-items-center">
					<h1 class="display-2 fw-bold mb-2 ">AKSIS</h1>
					<p class="lead fs-3 mb-4 ">
						Aklan Scholars' Information System
					</p>

					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Login</h2>
						</div>
						<?php if (isset($error_message)): ?>
							<div class="alert alert-danger" role="alert">
								<?php echo htmlspecialchars($error_message); ?>
							</div>
						<?php endif; ?>

						<form novalidate method="POST" action="index.php" autocomplete="off">

							<div class="input-group custom">
								<input
									name="username"
									type="text"
									class="form-control form-control-lg"
									placeholder="Username" />
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input
									name="password"
									type="password"
									class="form-control form-control-lg"
									placeholder="Password" />
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
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