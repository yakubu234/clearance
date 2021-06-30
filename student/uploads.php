	<?php include "../classes/db.php";  include "../include/library.php"; 
	include 'geter.php';
	if (!isset($_SESSION["PData"])) {
		$_SESSION['errors'] = "Please login first";
		header('location:../index');
	}
	if ($status > '1') {
		$_SESSION['errors'] = "you cant upload anymore. Try delete existing upload to make new one";
		header('location:dashboard');
	}
	
	?>
	<link rel="stylesheet" type="text/css" href="../src/plugins/dropzone/src/dropzone.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">	
	<link rel="stylesheet" type="text/css" href="../vendors/styles/load-uploader.css">
	<style type="text/css">
		.loading-overlay {
			display: none;
			background: rgba(255, 255, 255, 0.7);
			position: fixed;
			bottom: 0;
			left: 0;
			right: 0;
			top: 0;
			z-index: 9998;
			align-items: center;
			justify-content: center;
		}

		.loading-overlay.is-active {
			display: flex;
		}

		.code {
			font-family: monospace;
			/*   font-size: .9em; */
			color: #dd4a68;
			background-color: rgb(238, 238, 238);
			padding: 0 3px;
		} 
	</style>

	<?php include "../include/header.php"; ?>

	<!--  -->
	<div class="loading-overlay adding-loader">
		<span class="fas fa-spinner fa-3x fa-spin"></span>
		&nbsp;Uploading
	</div>
	<!--  -->

	<div class="main-container">

		<!--  -->
		<div class="modal fade" id="success-modal-a" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body text-center font-18">
						<h3 class="mb-20">Document Uploaded!</h3>
						<div class="mb-30 text-center"><img src="../vendors/images/success.png"></div>
						Your document has been uploaded, you will be redirected to dashboard in3 seconds
					</div>
					<div class="modal-footer justify-content-center">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
					</div>
				</div>
			</div>
		</div>
		<!--  -->
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Image Dropzone</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Image Dropzone</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="image-dropzone.html#" role="button" data-toggle="dropdown">
									January 2018
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="image-dropzone.html#">Export List</a>
									<a class="dropdown-item" href="image-dropzone.html#">Policies</a>
									<a class="dropdown-item" href="image-dropzone.html#">View Assets</a>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix mb-20">
						<div class="pull-left">
							<h4 class="text-blue h4">Dropzone</h4>
						</div>
						<div id="analys" ></div>
					</div>
					<form class="dropzone" action="<?php echo $urlServer; ?>uploads/uploadHandler.php" enctype="multipart/form-data" method="POST" id="my-awesome-dropzone">
						<div class="fallback">
							<input type="file" name="file" />
						</div>
					</form>
				</div>
			</div>
			
			<!-- standard js files here -->
			<?php include "../include/footer.php";  ?>
			<!-- standard js files here ended -->

			<script src="../src/plugins/dropzone/src/dropzone.js"></script>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js" ></script>
			<script type="text/javascript" src="student.min.js"></script>
		</body>
		</html>