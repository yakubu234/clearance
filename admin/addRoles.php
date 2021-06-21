	<?php include "../classes/db.php";  include "../include/library.php";include "../classes/fethcer.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
	include 'geter.php';
	$function = "admin with name  ".$full_name." is about to add new role ";
	LoadUser($userid, $full_name, $admin_email, $function);
	$NoEncode = getRoles();
	$records = base64_encode(json_encode($NoEncode));
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

				<!-- Select-2 Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Add new Offices</h4>
							<p class="mb-30">please kindly fill in detail correctly </p>
							<?php
							if (isset($_SESSION['errors'])) {
								echo '<div class="alert alert-danger" > '.$_SESSION['errors'].'</div>';
							}else if(isset($_SESSION['success'])){
								echo '<div class="alert alert-success" > '.$_SESSION['success'].'</div>';
							}
							?>
						</div>
					</div>
					<form method="POST"  action="../classes/action.php" enctype="multipart/form-data"  > 
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Office(s) Name</label>
									<input  type="text" class="form-control" placeholder="Enter role name" name="role" required="" >
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Select Office Type</label>
									<select class="custom-select2 form-control" required="" name="office" style="width: 100%; height: 38px;">
											<option selected="" disabled="">please select</option>
											<option value="HOD">Departments</option>
											<option value="OTHERS">others</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Select Office(s) Type <span class="text-danger" >( required roles will appear when student is requesting for clearance )</span></label>
									<select class="custom-select2 form-control" required="" name="auth" style="width: 100%; height: 38px;">
											<option selected="" disabled="">please select</option>
											<option value="2">Required</option>
											<option value="">Not Required</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Creators Name</label>
									<input  type="text" class="form-control" placeholder="Enter creator name" name="creator" value="<?php echo $full_name; ?>" required=""  readonly>
								</div>
							</div>
							
						</div>
						<input type="hidden" name="creator_id" value="<?php echo $userid; ?>">
						<div class="row">
							<div class="col-sm-6" >
							<button type="submit" name="add_role" value="add_role" class="btn btn-primary" style="float: right;">Submit</button>
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

</body>
<?php unset($_SESSION['success']); unset($_SESSION['errors']); ?>
</html>