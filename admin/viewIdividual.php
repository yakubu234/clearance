	<?php include "../classes/db.php";  include "../include/library.php";include "../classes/fethcer.php"; 
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../home');
	}
	include 'geter.php';
	$function = "user with name ".$username." viewed student details ";
	$ua = LoadUser($userid,$username, $admin_email,$function);

	?>
	<link rel="stylesheet" type="text/css" href="../src/plugins/cropperjs/dist/cropper.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">

	<?php include "../include/admin_header.php"; ?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="row">
					<?php 
					$GPIfile_name =''; 
					if (isset($_SESSION['studentJoin'])) {
						$GetPostItems = json_decode(GetPostItems($_SESSION['studentJoin']['id'],$_SESSION['studentJoin']['matric_num']));
						$_SESSION['GPI'] = $GetPostItems;
						$GPIstudentMatric = $GetPostItems->student_matric !=''?$GetPostItems->student_matric:'';
						$GPIfile_name = $GetPostItems->file_name !=''?$GetPostItems->file_name:'';
						$GPIstatus = $GetPostItems->status !=''?$GetPostItems->status:'';
					}else{
						header('location:viewAllStudent');
					}
					?>
					<div class="col-xl-12 col-lg-8 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<h5 class="text-center h5 mb-0"><?php echo $_SESSION['studentJoin']['lastname']. " ".$_SESSION['studentJoin']['firstname']; ?></h5>
							<p class="text-center text-muted font-14"><?php echo $_SESSION['studentJoin']['department']; ?></p>

							<!-- social links deleted here  -->
							<div class="profile-social">
								<?php
							if (isset($_SESSION['errors'])) {
								echo '<div class="alert alert-danger" > '.$_SESSION['errors'].'</div>';
							}else if(isset($_SESSION['success'])){
								echo '<div class="alert alert-success" > '.$_SESSION['success'].'</div>';
							}
							?>

								<div class="row" >
									<br><br>
									<?php    
									// if(file_exists('../uploads/student/'.$GPIfile_name)){
									if(!empty($GPIfile_name)){
										echo '<iframe src="'.$urlServer.'pdf/web/viewer.html?file='.$urlServer.'uploads/student/'.$GPIfile_name.'" width="100%" height="600" allowfullscreen webkitallowfullscreen></iframe>';
									}else{
										echo "<b class='text-danger'> User has not upload any document</b>";
									}

									?>
									<br><br>
								</div>

								<div class="row" >
									<a href="  <?php echo $urlServer.'classes/action?params=ClearStudent&data='.$_SESSION['studentJoin']['id'].'&strings='.time() ?>"><button class="btn btn-success" > Clear Student</button></a>&nbsp;
									<a href="<?php echo $_SESSION['studentJoin']['id']; ?>"><button class="btn btn-danger" > Disable Request</button></a>
									<ul class="clearfix">
										<li><a href="<?php echo $_SESSION['studentJoin']['id']; ?>" class="btn" data-bgcolor="#3b5998" data-color="#ffffff" title="chat student"><i class="fa fa-comment"></i></a></li>
										<li><a href="TEL:<?php echo $_SESSION['studentJoin']['phone_number']; ?>" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff" title="contact phone" target="_blank"><i class="fa fa-phone"></i></a></li>
										<li><a href="delete?checker=<?php echo $_SESSION['studentJoin']['id']; ?>&val=<?php echo rand(); ?>" class="btn" data-bgcolor="#007bb5" data-color="#ffffff" title="delete student"><i class="fa fa-trash"></i></a></li>
									</ul>
								</div>
							</div>
							<!-- progress bar deleted here -->
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Student's Information</h5>
								<ul>
									<div class="row" >

										<div class="col-sm-6" >
											<li>
												<span>Firstname: <b style="color:black" > <?php echo $_SESSION['studentJoin']['firstname']; ?></b></span>										
											</li>
										</div>
										<div class="col-sm-6" >
											<li>
												<span>Lastname: <b style="color:black" > <?php echo $_SESSION['studentJoin']['lastname']; ?></b></span>
											</li>
										</div>

										<div class="col-sm-6" >
											<li>
												<span>Username: <b style="color:black" > <?php echo $_SESSION['studentJoin']['username']; ?></b> </span>
											</li>
										</div>
										<div class="col-sm-6" >
											<li>
												<span>Email: <b style="color:black" > <?php echo $_SESSION['studentJoin']['email']; ?></b> </span>
											</li>
										</div>

										<div class="col-sm-6" >
											<li>
												<span>Matric num: <b style="color:black" > <?php echo $_SESSION['studentJoin']['matric_num']; ?></b></span>
											</li>
										</div>
										<div class="col-sm-6" >
											<li>
												<span>Department: <b style="color:black" > <?php echo $_SESSION['studentJoin']['department']; ?></b> </span>
											</li>
										</div>

										<div class="col-sm-6" >
											<li>
												<span>Gender:  <b style="color:black" > <?php echo $_SESSION['studentJoin']['gender']; ?></b> </span>
											</li>
										</div>
										<div class="col-sm-6" >
											<li>
												<span>Phone number:  <b style="color:black" > <?php echo $_SESSION['studentJoin']['phone_number']; ?></b> </span>
											</li>
										</div>

									</div>
								</ul>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			

			<!-- standard js files here -->
			<?php include "../include/footer.php";  ?>
			<!-- standard js files here ended -->
			<script src="../src/plugins/cropperjs/dist/cropper.js"></script>
			<script>
				window.addEventListener('DOMContentLoaded', function () {
					var image = document.getElementById('image');
					var cropBoxData;
					var canvasData;
					var cropper;

					$('#modal').on('shown.bs.modal', function () {
						cropper = new Cropper(image, {
							autoCropArea: 0.5,
							dragMode: 'move',
							aspectRatio: 3 / 3,
							restore: false,
							guides: false,
							center: false,
							highlight: false,
							cropBoxMovable: false,
							cropBoxResizable: false,
							toggleDragModeOnDblclick: false,
							ready: function () {
								cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
							}
						});
					}).on('hidden.bs.modal', function () {
						cropBoxData = cropper.getCropBoxData();
						canvasData = cropper.getCanvasData();
						cropper.destroy();
					});
				});
			</script>

			<?php unset($_SESSION['success']); unset($_SESSION['errors']); unset($_SESSION['studentJoin']);?>
		</body>
		</html>