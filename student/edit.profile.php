<?php include "../classes/db.php";  include "../include/library.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
	include 'geter.php';
	$GetDepartments = GetDepartments();
	?>
	<!-- switchery css -->
	<link rel="stylesheet" type="text/css" href="../src/plugins/switchery/switchery.min.css">
	<!-- bootstrap-tagsinput css -->
	<link rel="stylesheet" type="text/css" href="../src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
	<!-- bootstrap-touchspin css -->
	<link rel="stylesheet" type="text/css" href="../src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<?php include "../include/header.php"; ?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">

				<!-- Select-2 Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Update your Profile</h4>
							<p class="mb-30">please kindly fill in details correctly and upload your picture </p>
							<?php
							if (isset($_SESSION['errors'])) {
								echo '<div class="alert alert-danger" > '.$_SESSION['errors'].'</div>';
							}else if(isset($_SESSION['success'])){
								echo '<div class="alert alert-success" > '.$_SESSION['success'].'</div>';
							}
							?>
						</div>
					</div>
					<form method="POST"  action="update.php" enctype="multipart/form-data"  > 

						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Surname</label>
									<input  type="text" class="form-control" placeholder="Enter Surname" name="lastname" value="<?php echo $lastname;?>" required="" readonly >
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Firstname</label>
									<input  type="text" class="form-control" placeholder="Enter firstname" name="firstname" value="<?php echo $firstname ; ?>" required="" readonly >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Matric Number</label>
									<input  type="text" class="form-control" placeholder="Enter Matric Number" name="matric_num" value="<?php echo $matric_num; ?>" required="" readonly >
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>email</label>
									<input  type="email" class="form-control" placeholder="Enter email" name="email" value="<?php echo $user_email; ?>" required="" readonly >
								</div>
							</div>
							
						</div>
						<div class="row">

							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label> Department</label>
									<input  type="text" class="form-control" placeholder="Enter email" name="department" value="<?php echo $dept; ?>" required="" readonly >
								</div>
							</div>

                            <div class="col-md-6">
								<div class="form-group">
									<label>Gender</label>
									<select class=" form-control" name="gender" required="">
											<?php if(empty($gender)){
												echo '<option value="" selected disabled>Select Gender</option>';
											}else{
												echo '<option value="'.$gender.'" selected disabled>'.$gender.'</option>';
											}
										?>
											<option value="Male">Male</option>
											<option value="Female">Female</option>
									</select>
								</div>
							</div>
						</div>

                        <div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Phone Number</label>
									<input  type="text" class="form-control" placeholder="Enter Phone Number" name="phone_number" value="<?php echo $phone; ?>" required="" >
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Profile Image</label>
									<input  type="file" class="form-control" placeholder="Enter img" name="img" value="<?php echo $img; ?>" required="" >
								</div>
							</div>							
						</div>
                                                
                        <div class="row">
						<div class="col-sm-12" style="float: right;" ><br>
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