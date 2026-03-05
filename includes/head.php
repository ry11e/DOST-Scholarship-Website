<?php
if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }


include_once 'includes/connection.php';

// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}

// Fetch admin details
$username = $_SESSION['admin_username'];
$stmt = $conn->prepare("SELECT * FROM admin_tbl WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

// Update profile
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $fullName = $_POST['fullName'];
    
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Update the database
    $stmt = $conn->prepare("UPDATE admin_tbl SET fullname = ?, address = ?, phone = ?, email = ? WHERE username = ?");
    $stmt->bind_param("sssss", $fullName, $address, $phone, $email, $username);
    $stmt->execute();

    // Redirect to the same page to see the changes
    header("Location: profile.php");
    exit();
}

// Change password
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $currentPassword = $_POST['password'];
    $newPassword = $_POST['newpassword'];
    $renewPassword = $_POST['renewpassword'];

    // Check if the current password matches
    if ($admin['password'] === $currentPassword) {
        if ($newPassword === $renewPassword) {
            // Update the password
            $stmt = $conn->prepare("UPDATE admin_tbl SET password = ? WHERE username = ?");
            $stmt->bind_param("ss", $newPassword, $username);
            $stmt->execute();
            $password_message = "Password changed successfully.";
        } else {
            $password_message = "New passwords do not match.";
        }
    } else {
        $password_message = "Current password is incorrect.";
    }
}
?>



<?php

include_once 'includes/connection.php';

// Check if the user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}

// Fetch admin details
$username = $_SESSION['admin_username'];
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>SCHOLARSHIP - Admin Dashboard </title>

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
		
		<link
			rel="stylesheet"
			type="text/css"
			href="vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>

		<!-- For these last three, Bootstrap was loaded first as to not overwrite the custom style sheets -->
		<link rel="stylesheet"
			href="src/styles/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
		

	</head>
	<!--<style>
@keyframes rainbowGlow {
    0% { border-color: red; box-shadow: 0 0 5px red; }
    14% { border-color: orange; box-shadow: 0 0 5px orange; }
    28% { border-color: yellow; box-shadow: 0 0 5px yellow; }
    42% { border-color: green; box-shadow: 0 0 5px green; }
    57% { border-color: blue; box-shadow: 0 0 5px blue; }
    71% { border-color: indigo; box-shadow: 0 0 5px indigo; }
    85% { border-color: violet; box-shadow: 0 0 5px violet; }
    100% { border-color: red; box-shadow: 0 0 5px red; }
}

@keyframes fireAnimation {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
}

input:focus, textarea:focus, select:focus {
    outline: none;
    border: 2px solid;
    animation: rainbowGlow 2s linear infinite, fireAnimation 1s linear infinite;
    background: url('https://img1.picmix.com/output/stamp/normal/1/0/4/8/2468401_270a6.gif') center center / cover;
}
</style> -->
	<body>
	

		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
			
				<div class="header-search">
				
				</div>
			</div>
			<div class="header-right">
			
				
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<img src="vendors/images/admin.png" alt="" />
							</span>
							<span class="user-name"><?php echo htmlspecialchars($admin['fullname']); ?></span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="profile.php"
								><i class="dw dw-user1"></i> Profile</a
							>
							<a
							class="dropdown-item no-arrow"
							href="javascript:;"
							data-toggle="right-sidebar"
						>
							<i class="dw dw-settings2"></i>
						</i> Setting</a
							>
							
							<a class="dropdown-item" href="includes/logout.php"
								><i class="dw dw-logout"></i> Log Out</a
							>
						</div>
					</div>
				</div>
				
			</div>
		</div>