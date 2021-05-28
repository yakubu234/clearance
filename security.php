<?php
include "classes/db.php";

try {
		$stmt = $conn->prepare('SELECT * FROM admin WHERE usert_type=? ');
		$stmt->execute(['5']);
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$user = $stmt->fetchAll();
		if ($stmt->rowCount() >= 2) {
		$_SESSION['errors'] = ' sorry you can only add two super admin ';
		header('location:home?strings='.time());
		}
		
	} catch(PDOException $e) {
		echo $e->getMessage();
	}

	
if (isset($_POST['add_admin']) && $_POST['add_admin']=='add_admin') {
	$username = $_POST['username'];
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$user_type = '5';
	$role = 'Super Admin';	
	$role_id = '';
	$departments = '';
	$passwordH = MD5(strtoupper($_POST['password']));
	$password = crypt($passwordH,$passwordH);	
	try {
		$data = [
		'username' => $username,
		'password' => $password,
		'full_name' => $fullname,
		'email' => $email,
		'usert_type' => $user_type,
		'role' => $role,
		'departments' => $departments,
		'role_id' => $role_id,
		'status' => '1',
		];
		$ins = "INSERT INTO admin (username,password,full_name,email,usert_type,role,departments,role_id,status) VALUES (:username, :password, :full_name, :email, :usert_type,:role,:departments,:role_id,:status)";
		$stmt = $conn->prepare($ins);
		if ($stmt->execute($data) > 0) {
		$_SESSION['success'] = ' success!. '.$fullname.' has been added as admin ';
		}else{
		$_SESSION['errors'] = ' an error has occured , please retry adding '.$fullname;
		}
		header('Refresh: 0; url=home?strings='.time());
	} catch(PDOException $e) {
		// echo $sql . "<br>" . $e->getMessage();die;
		$_SESSION['errors'] = ' an error has occured , please retry adding '.$fullname;
		header('location:home');
	}
	# code...
}
?>
	<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>FUNAAB</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../img/FUNAAB-Logo.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../img/FUNAAB-Logo.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../img/FUNAAB-Logo.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
	<!-- switchery css -->
	<link rel="stylesheet" type="text/css" href="src/plugins/switchery/switchery.min.css">
	<!-- bootstrap-tagsinput css -->
	<link rel="stylesheet" type="text/css" href="src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
	<!-- bootstrap-touchspin css -->
	<link rel="stylesheet" type="text/css" href="src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
	</head>
<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="img/FUNAAB-Logo.png" alt="" width="100"></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>

	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw d fas fa-bars"></div>
			<div class="search-toggle-icon dw d fas fa-search-plus" data-toggle="header_search"></div>
			<div class="header-search">
				<form>
					<div class="form-group mb-0">
						<i  class="fas fa-search search-icon"></i>
						<input type="text" class="form-control search-input" placeholder="Search Here">
						<div class="dropdown">
							<a class="dropdown-toggle no-arrow" href="index.html#" role="button" data-toggle="dropdown">
								<i class="far fa-arrow-alt-circle-down"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">From</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">To</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-12 col-md-2 col-form-label">Subject</label>
									<div class="col-sm-12 col-md-10">
										<input class="form-control form-control-sm form-control-line" type="text">
									</div>
								</div>
								<div class="text-right">
									<button class="btn btn-primary" >Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="header-right">
			
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="index.html#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="vendors/images/photo1.jpg" alt="">
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">

						<p style="margin-left: 40px;margin-top: 10px; margin-bottom: -5px;" >Oluwatosin</p>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
						<a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a>
						<a class="dropdown-item" href="../logout.php"><i class=" fas fa-sign-out-alt"></i> Log Out</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="right-sidebar">
		<div class="sidebar-title">
			<h3 class="weight-600 font-16 text-blue">
				Layout Settings
				<span class="btn-block font-weight-400 font-12">User Interface Settings</span>
			</h3>
			<div class="close-sidebar" data-toggle="right-sidebar-close">
				<i class="icon-copy ion-close-round"></i>
			</div>
		</div>
		<div class="right-sidebar-body customscroll">
			<div class="right-sidebar-body-content">
				<h4 class="weight-600 font-18 pb-10">Header Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
				<div class="sidebar-btn-group pb-30 mb-10">
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light ">White</a>
					<a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
				<div class="sidebar-radio-group pb-10 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="">
						<label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2">
						<label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3">
						<label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
					</div>
				</div>

				<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
				<div class="sidebar-radio-group pb-30 mb-10">
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="">
						<label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2">
						<label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3">
						<label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="">
						<label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5">
						<label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6">
						<label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
					</div>
				</div>

				<div class="reset-options pt-30 text-center">
					<button class="btn btn-danger" id="reset-settings">Reset Settings</button>
				</div>
			</div>
		</div>
	</div>

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="dashboard.php">
				<img src="img/FUNAAB-Logo.png" alt="" width="100" class="dark-logo" style="margin: 0px auto;">
				<img src="img/FUNAAB-Logo.png" alt="" width="100" class="light-logo" style="margin: 0px auto;">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					
					<li>
						<a href="logout" class="dropdown-toggle no-arrow">
							<span class="micon fas fa-sign-out-alt"></span><span class="mtext">Log out</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">

				<!-- Select-2 Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Add new Super Admin</h4>
							<p class="mb-30">please kindly fill in details correctly </p>
							<?php
							if (isset($_SESSION['errors'])) {
								echo '<div class="alert alert-danger" > '.$_SESSION['errors'].'</div>';
							}else if(isset($_SESSION['success'])){
								echo '<div class="alert alert-success" > '.$_SESSION['success'].'</div>';
							}
							?>
						</div>
					</div>
					<form method="POST"  action="#" enctype="multipart/form-data"  > 
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Username</label>
									<input  type="text" class="form-control" placeholder="Enter Username" name="username" required="" >
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>fullname</label>
									<input  type="text" class="form-control" placeholder="Enter fullname" name="fullname" required="" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>email</label>
									<input  type="email" class="form-control" placeholder="Enter email" name="email" required="" >
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>password</label>
									<input  type="password" class="form-control" placeholder="Enter password" name="password" required="" >
								</div>
							</div>
						</div>
						
						<input type="hidden" name="role_id" id="fetchItem">
						<div class="row">
							
							<div class="col-sm-12" >
							<button type="submit" name="add_admin" value="add_admin" class="btn btn-primary" style="float: right;">Submit</button>
							</div>
						</div>
					</form>
				</div>
				<!-- Select-2 end -->
				

			</div>
			<!-- standard js files here -->
	
			<div class="footer-wrap pd-20 mb-20 card-box">
				FUNAAB <a href="mailto:+2347035925124" target="_blank">OLUWATOSIN</a>
			</div>
		</div>
	</div>
	<!-- scripts -->
<script src="vendors/scripts/core.js"></script>
<script src="vendors/scripts/script.min.js"></script>
<script src="vendors/scripts/process.js"></script>
<script src="vendors/scripts/layout-settings.js"></script>
	<!-- standard js files here ended -->
	<script src="src/plugins/switchery/switchery.min.js"></script>
	<!-- bootstrap-tagsinput js -->
	<script src="src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
	<!-- bootstrap-touchspin js -->
	<script src="src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
	<script src="vendors/scripts/advanced-components.js"></script>
</body>
<?php unset($_SESSION['success']); unset($_SESSION['errors']); ?>
</html>