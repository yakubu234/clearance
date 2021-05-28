	<?php include "../classes/db.php";  include "../include/library.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index.php');
	}
	include 'geter.php';
	$uploads = json_decode(GetPostItems($userid,$matric_num));
	$uploads_status = $uploads->status;
	if ($uploads_status >=2) {
		$_SESSION['success'] = "It appears you already make request for clearance";
		header('location:dashboard');die;
	}
	?>
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<?php include "../include/header.php"; ?>
	<div class="main-container">
		<div class="pd-ltr-20">

			<!-- horizontal Basic Forms Start -->
			<div class="pd-20 card-box mb-30">
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-blue h4">Clearance verification request Forms</h4>
						<p class="mb-30">Kindly check the consent box and click apply for clarance</p>
					</div>
				</div>
				<?php
				if (isset($_SESSION['errors'])) {
					echo '<div class="alert alert-danger" > '.$_SESSION['errors'].'</div>';
				}else if(isset($_SESSION['success'])){
					echo '<div class="alert alert-success" > '.$_SESSION['success'].'</div>';
				}
				?>	

				<div class="row" >
					<div class="col-sm-12" >

						<form method="POST" name="form" id="form" action="../classes/action" >
							<div class="form-group">
								<div class="row">

									<div class="col-md-6 col-sm-12">
										<label class="weight-600">below are List of Offices your document will be sent to</label>
										<?php
										$GetOfficeList = json_decode(GetOfficeList());
										foreach ($GetOfficeList as $key => $value) {
											echo '
											<div class="custom-control custom-radio mb-5">
											<input type="radio" id="customRadio4'.$value->name.'" name="customRadio1['.$value->name.']" class="custom-control-input" value="'.$value->name.'|'.$value->id.'" readonly="" onclick="return false;" checked="">
											<label class="custom-control-label" for="customRadio4'.$value->name.'">'.$value->name.'</label>
										</div>
											';
										}

										?>
										<input type="hidden" name="matric" value="<?php echo $matric_num; ?>" readonly>
										<input type="hidden" name="tbl_id" value="<?php echo $userid; ?>" readonly>
										<input type="hidden" name="user_email" value="<?php echo $user_email; ?>" readonly>
										<input type="hidden" name="f_name" value="<?php echo $firstname.' '.$lastname; ?>" readonly>

										<label class="weight-600">Please kindly Check the box to continue</label>

										<div class="custom-control custom-checkbox mb-5">
											<input type="checkbox" class="custom-control-input" name="Agreement" id="customCheck4-1" required="">
											<label class="custom-control-label" for="customCheck4-1">I Agree</label>
										</div>
										<div class="btn-list">
											<button type="submit" class="btn" data-bgcolor="#00CDCA" name="requestClearane" value="requestClearane" data-color="#ffffff"><i class="fa fa-bullhorn"></i> Apply for Clearance</button>
										</div>

									</div>
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
			<!-- horizontal Basic Forms End -->


			<!-- js -->
			<!-- standard js files here -->
			<?php include "../include/footer.php";  ?>
			<!-- standard js files here ended -->
			<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
			<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
			<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
			<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
			<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
			<script src="../vendors/scripts/dashboard.js"></script>
			<script type="text/javascript">
				 delete console.log;
    			 console.log;
				$('#form').click(function(e) {
					e.preventDefault();
					if ($(this).find('input[name="Agreement"]')[0].checked === false) {
						alert("Please check the I agree box");
						return false;
					}else{
						alert('here');
						return false;
						// return true;
					}
				}
			</script>
			<?php unset($_SESSION['success']); unset($_SESSION['errors']);unset($_GET['strings']); ?>
		</body>
		</html>