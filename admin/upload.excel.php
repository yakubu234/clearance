	<?php include "../classes/db.php";  include "../include/library.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../home');
	}
	include 'geter.php';
	$function = "admin with name  ".$full_name." is about to add new students to the system through excel upload";
	LoadUser($userid, $full_name, $admin_email, $function);
	?>
	<!-- switchery css -->
	<link rel="stylesheet" type="text/css" href="../src/plugins/switchery/switchery.min.css">
	<!-- bootstrap-tagsinput css -->
	<link rel="stylesheet" type="text/css" href="../src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
	<!-- bootstrap-touchspin css -->
	<link rel="stylesheet" type="text/css" href="../src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<?php include "../include/admin_header.php"; ?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Upload Student Record</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Upload Student Record</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<a href="sample upload.xlsx" download=""><button class="btn btn-primary">Download Format</button></a>
						</div>
					</div>
				</div>

				<!-- Select-2 Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Upload excel here</h4>
							<!-- <p class="mb-30">Select2 for custom search and select</p> -->
						</div>
					</div>
					<form method="POST"  action="Uploader" enctype="multipart/form-data"  > 
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Choose file</label>
									<input  type="file" class="form-control" placeholder="Upload Excel" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6" >
							<button type="submit" name="upload" class="btn btn-primary" style="float: right;">Submit</button>
							</div>
						</div>
					</form>
				</div>
				<!-- Select-2 end -->

			</div>
			<!-- standard js files here -->
	<?php include "../include/footer.php";  ?>
	<!-- standard js files here ended -->
	<script src="../src/plugins/switchery/switchery.min.js"></script>
	<!-- bootstrap-tagsinput js -->
	<script src="../src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
	<!-- bootstrap-touchspin js -->
	<script src="../src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
	<script src="../vendors/scripts/advanced-components.js"></script>
		<?php unset($_SESSION['success']); unset($_SESSION['errors']); ?>
</body>
</html>