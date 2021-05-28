	<?php include "../classes/db.php";  include "../include/library.php";include "../classes/fethcer.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
	include 'geter.php';
	$function = "admin with name  ".$full_name." is about to add a department  ";
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

				<!-- Select-2 Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Add new Department</h4>
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
									<label>Department Name</label>
									<input  type="text" class="form-control" placeholder="Enter Dept. name" name="dept" required="" >
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
							<button type="submit" name="add_dept_from_form" value="add_dept_from_form" class="btn btn-primary" style="float: right;">Submit</button>
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