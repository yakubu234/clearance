	<?php 
	include "../classes/db.php"; 
	include "../include/library.php"; 
	include 'geter.php';
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index');
	}
	?>
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">	
	<link rel="stylesheet" type="text/css" href="../vendors/styles/load-uploader.css">
	<style>
		
	</style>
	<?php include "../include/header.php"; ?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>blank</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">tracker</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="blank.html#" role="button" data-toggle="dropdown">
									button
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<?php
							if (isset($_SESSION['errors'])) {
								echo '<div class="alert alert-danger" > '.$_SESSION['errors'].'</div>';
							}else if(isset($_SESSION['success'])){
								echo '<div class="alert alert-success" > '.$_SESSION['success'].'</div>';
							}
							?>	
					<!--  -->
					<div class="wrapper-progress col-md-6">
						<br>
						<ul class="StepProgress">
						<?php $dataFromTrack = GetUpload_Status($matric_num,$userid); 
						$dataFromTrack = json_decode($dataFromTrack);
						$err ='';
						if (!empty($dataFromTrack)) {	
							foreach ($dataFromTrack as $key => $value) {
								$value->status == 2 ? $style ='is-done':($value->status == 1 ? $style ='current': $style ='');
							echo '<li class="StepProgress-item '.$style.'"><strong>'.$value->roles.'</strong></li>';
							}
						}else{
							$err = "<b class='text-danger' >sorry you have not requested for clearance </b>";
						}
						?>							
							<!-- <li class="StepProgress-item current"><strong>Provide feedback</strong></li>
							<li class="StepProgress-item"><strong>Provide feedback 2</strong></li> -->
						</ul>
						<br>
					</div>
					<?php echo $err; ?>
					<!-- https://codepen.io/erwinquita/pen/ZWzVRE -->
				</div>

				<!-- js -->
				<!-- standard js files here -->
				<?php include "../include/footer.php";  ?>
				<!-- standard js files here ended -->
			</body>
			</html>