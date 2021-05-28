	<?php include "../classes/db.php";  include "../include/library.php";include "../classes/fethcer.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
	include 'geter.php';
	$function = "admin with name  ".$full_name." is about to add new individual student ";
	LoadUser($userid, $full_name, $admin_email, $function);
	$NoEncode = getDepartment();
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
							<h4 class="text-blue h4">Add new Individual Student</h4>
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
					<form method="POST"  action="../classes/action.php" enctype="multipart/form-data"  > 

						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Surname</label>
									<input  type="text" class="form-control" placeholder="Enter Surname" name="lastname" required="" >
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Firstname</label>
									<input  type="text" class="form-control" placeholder="Enter firstname" name="firstname" required="" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Matric Number</label>
									<input  type="text" class="form-control" placeholder="Enter Username" name="matric_num" required="" >
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>email</label>
									<input  type="email" class="form-control" placeholder="Enter email" name="email" required="" >
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Select Department</label>
									<select class="custom-select2 form-control" name="department" required=""  style="width: 100%; height: 38px;" onchange="run()">
											<option value="">Select Department</option>
											<?php
											foreach ($NoEncode as $key => $value) {
												echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
											}
											?>
									</select>
								</div>
							</div>

							<div class="col-sm-6" ><br>
							<button type="submit" name="add_individual_student" value="add_individual_student" class="btn btn-primary" style="float: right;">Submit</button>
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