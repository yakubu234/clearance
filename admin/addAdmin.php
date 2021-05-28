	<?php include "../classes/db.php";  include "../include/library.php";include "../classes/fethcer.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
	include 'geter.php';
	$function = "admin with name  ".$full_name." is about to add new admin ";
	LoadUser($userid, $full_name, $admin_email, $function);
	$NoEncode = getRoles();
	$getDepartment = getDepartment();
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
							<h4 class="text-blue h4">Add new Admin</h4>
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
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Select Role</label>
									<select class="custom-select2 form-control" name="role" required=""  id="getrole" style="width: 100%; height: 38px;" onchange="run()">
											<option value="">Select roles</option>
											<?php
											foreach ($NoEncode as $key => $value) {
												echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
											}
											?>
									</select>
								</div>
							</div>
							<div class="col-md-6" id="enableDisable" style="display: none;">
								<div class="form-group">
									<label>Select Department</label>
									<select class="custom-select2 form-control" id="depart" name="departments"  style="width: 100%; height: 38px;" >
											<option value="">Select Department</option>
											<?php
											foreach ($getDepartment as $key => $value) {
												echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
											}
											?>
									</select>
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
	<?php include "../include/footer.php";  ?>
	<!-- standard js files here ended -->
	<script src="../src/plugins/switchery/switchery.min.js"></script>
	<!-- bootstrap-tagsinput js -->
	<script src="../src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
	<!-- bootstrap-touchspin js -->
	<script src="../src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
	<script src="../vendors/scripts/advanced-components.js"></script>
	<script type="text/javascript">
		function run() {
		var item = $("#getrole :selected").val();
		var oldData = '<?php echo $records; ?>';
        data = $.parseJSON(atob(oldData));
        var newData = data.filter(p => p.name == item);
        if(newData[0].office == 'HOD'){
        	$("#depart").prop('required',true);
        	$("#enableDisable").show();
        }else{
        	$("#enableDisable ").hide();
        	$("#depart").prop('required',false);
        }
		$("#fetchItem").val(newData[0].id);		
	}
	</script>
</body>
<?php unset($_SESSION['success']); unset($_SESSION['errors']); ?>
</html>