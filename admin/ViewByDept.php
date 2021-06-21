<?php include "../classes/db.php";  include "../include/library.php";include "../classes/fethcer.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
	include 'geter.php';
	$function = "admin with name  ".$full_name." is viewing student by department ";
	LoadUser($userid, $full_name, $admin_email, $function);
	$getVal = getstudentByDept();
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
							<h4 class="text-blue h4">View by Department</h4>
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
							<div class="col-md-6">
								<div class="form-group">
									<label>Choose Department</label>
									<select class="custom-select2 form-control" name="department" required="" style="width: 100%; height: 38px;">
											<option selected disabled >Select Department</option>
											<?php 
											if (!empty($getVal)) {											
											foreach ($getVal as $key => $value) {
											if(!empty($departments))
											{
											if($departments === $value["department"]){
											echo '<option value="'.$value["department"].'">'.$value["department"].'</option>';
												}
											}else{
											echo '<option value="'.$value["department"].'">'.$value["department"].'</option>';
											}
											
											}
											}
											?>
											
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6" >
							<button type="submit" name="view_by_department" value="view_by_department" class="btn btn-primary" style="float: right;">Submit</button>
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